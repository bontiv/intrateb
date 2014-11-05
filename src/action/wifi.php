<?php

function _wifi_getToken() {
    global $pdo;

    if (isset($_SESSION['user']) && $_SESSION['user']) {
        $alreadyToken = $pdo->prepare('SELECT * FROM wifi_tokens LEFT JOIN wifi_tokenGroup ON wt_group = wtg_id WHERE wt_assign = ? AND wt_date + INTERVAL wtg_duration MINUTE > NOW()');
        $alreadyToken->bindValue(1, $_SESSION['user']['user_id']);
        $alreadyToken->execute();
        if ($token = $alreadyToken->fetch()) {
            return $token['wt_token'];
        } else {
            $countStmt = $pdo->query('SELECT COUNT(*) FROM wifi_tokens WHERE wt_assign IS NULL');
            $countRslt = $countStmt->fetch();

            $tokenStmt = $pdo->prepare('SELECT * FROM wifi_tokens WHERE wt_assign IS NULL LIMIT 10, 1');
            //$tokenStmt->bindValue(1, rand(0, $countRslt[0] - 1));
            $tokenStmt->execute();

            $token = $tokenStmt->fetch();
            if ($token != null) {
                $mdl = new Modele('wifi_tokens');
                $mdl->fetch($token['wt_id']);
                $mdl->modFrom(array(
                    'wt_assign' => $_SESSION['user']['user_id'],
                    'wt_date' => date('Y-m-d H:i:s'),
                        ), false);
                return $mdl->wt_token;
            } else {
                echo 'aucun tocken';
                return false; //Plus aucun token.
            }
        }
    } else {
        echo 'not logged';
        return false;
    }
}

/**
 * Fichier administration du wifi
 */
function wifi_index() {
    global $pdo, $tpl;

    $mdl = new Modele('wifi_tokenGroup');
    $mdl->find();

    while ($mdl->next()) {
        $line = $mdl->toArray();

        $stmt = $pdo->prepare('SELECT COUNT(*) FROM wifi_tokens WHERE wt_group = ? AND wt_assign IS NULL');
        $stmt->bindValue(1, $mdl->wtg_id);
        $stmt->execute();
        $rst = $stmt->fetch();
        $line['sum'] = $rst[0];

        $stmt = $pdo->prepare('SELECT COUNT(*) FROM wifi_tokens WHERE wt_group = ? AND wt_assign IS NOT NULL');
        $stmt->bindValue(1, $mdl->wtg_id);
        $stmt->execute();
        $rst = $stmt->fetch();
        $line['used'] = $rst[0];

        $tpl->append("lines", $line);
    }

    display();
}

function wifi_add() {
    global $tpl;

    if (isset($_POST['save'])) {
        $f = fopen($_FILES['file']['tmp_name'], 'r');
        $tokens = array();
        $roll = null;

        while (!feof($f)) {
            $l = fgets($f);
            if (preg_match('`# Voucher Tickets [0-9]*..[0-9]* for Roll ([0-9]*)`', $l, $pmatch)) {
                $roll = $pmatch[1];
            } elseif ($l[0] != "#") {
                $token = trim($l, "\t\n\r\0\x0B\" ");
                if (strlen($token)) {
                    $tokens[] = $token;
                }
            }
        }

        fclose($f);
        unlink($_FILES['file']['tmp_name']);

        if (count($tokens) == 0 || $roll == null) {
            echo "Erreur de parsing";
            $tpl->assign('hsuccess', false);
        } else {
            $mdl = new Modele('wifi_tokenGroup');
            if ($mdl->addFrom(array(
                        'wtg_roll' => $roll,
                        'wtg_duration' => $_POST['duration'],
                        'wtg_date' => date('Y-m-d'),
                    ))) {
                $id = $mdl->getKey();
                $tkn = new Modele('wifi_tokens');
                foreach ($tokens as $token) {
                    $tkn->addFrom(array(
                        'wt_token' => $token,
                        'wt_group' => $id,
                    ));
                }
                $tpl->assign('hsuccess', true);
            } else {
                echo 'Erreur insertion WTG.';
                $tpl->assign('hsuccess', false);
            }
        }
    }

    display();
}

function wifi_del() {
    global $pdo, $tpl;

    $stmt1 = $pdo->prepare('DELETE FROM wifi_tokens WHERE wt_group = ?');
    $stmt2 = $pdo->prepare('DELETE FROM wifi_tokenGroup WHERE wtg_id = ?');

    $stmt1->bindValue(1, $_GET['roll']);
    $stmt2->bindValue(1, $_GET['roll']);

    $tpl->assign('hsuccess', $stmt1->execute() && $stmt2->execute());

    modexec('wifi');
}

function wifi_login() {
    global $tpl;
    $redirect = $_GET['url'];

    if (isset($_POST['login'])) {
        $tpl->assign('hsuccess', login_user($_POST['login'], $_POST['password']));
    }

    if (isset($_SESSION['user']) && $_SESSION['user']) {
        echo 'OK';
        header('Location: ' . $redirect . '#' . _wifi_getToken());
        quit();
    }

    $tpl->assign('redirect', $redirect);
    display();
}

function wifi_getToken() {
    echo _wifi_getToken();
    quit();
}
