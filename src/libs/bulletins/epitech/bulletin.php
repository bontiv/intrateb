<?php

function bulletin_add($period_id) {
    global $pdo, $srcdir;

    include_once $srcdir . '/libs/bocal.php';

    $req = 'SELECT * '
            . 'FROM marks '
            . 'LEFT JOIN participations ON mark_participation = part_id '
            . 'LEFT JOIN users ON mark_user = user_id '
            . 'WHERE part_status = \'ACCEPTED\' '
            . 'AND mark_period = ?';

    $sql = $pdo->prepare($req);
    $sql->bindValue(1, $period_id);
    $sql->execute();

    $users = array();
    $bocal = new Bocal();

    while ($mark = $sql->fetch()) {

        if ($mark['user_login'] == "") {
            continue;
        }

        $buser = $bocal->getUser($mark['user_login']);
        if ($buser['school'] != "epitech" || $buser['promo'] < date('Y')) {
            continue; //Skip no Epitech students and old promotions
        }

        isset($users[$mark['mark_user']]) || $users[$mark['mark_user']] = array();
        $users[$mark['mark_user']][] = array(
            "label" => $mark['part_title'],
            "duration" => $mark['part_duration'] * $mark['mark_mark'] / 20,
        );
    }

    $ins = $pdo->prepare('INSERT INTO bulletin_user '
            . '(bu_period, bu_user, bu_data) '
            . 'VALUES (?, ?, ?)');
    $ins->bindValue(1, $period_id);

    foreach ($users as $userid => $details) {
        $ins->bindValue(2, $userid);
        $ins->bindValue(3, serialize($details));
        $ins->execute();
    }
}

function bulletin_toTemplate($period_id) {
    global $tpl;


    $mdl = new Modele('bulletin_user');
    $mdl->find(array('bu_period' => $period_id));

    $colums = array();

    while ($mdl->next()) {
        $marks = unserialize($mdl->bu_data);
        $line = array(
            'user' => $mdl->bu_user,
            'school' => '',
            'spice' => 0,
        );

        foreach ($marks as $mark) {
            if (!in_array($mark['label'], $colums)) {
                $colums[] = $mark['label'];
            }
            if (isset($line[$mark['label']])) {
                $line[$mark['label']] += $mark['duration'];
            } else {
                $line[$mark['label']] = $mark['duration'];
            }
            $line['spice'] += $mark['duration'];
        }

        $tpl->append('marks', $line);
    }

    $tpl->assign('colums', $colums);
}

function bulletin_view($period_id) {
    global $tpl, $root;

    bulletin_toTemplate($period_id);

    $tpl->display($root . 'libs/bulletins/epitech/view.tpl');
}

function bulletin_edit($period_id) {
    global $tpl, $root;

    if (isset($_POST['send'])) {
        foreach ($_POST as $key => $value) {
            $parsed = explode(';', $key, 2);
            if (count($parsed) == 2) {
                list($user, $field) = $parsed;
                $usrblt = new Modele('bulletin_user');
                $usrblt->find(array(
                    'bu_period' => $period_id,
                    'bu_user' => $user,
                ));
                if ($usrblt->next()) {
                    $data = unserialize($usrblt->bu_data);
                    foreach ($data as &$mark) {
                        if ($mark['label'] == $field) {
                            $mark['duration'] = $value;
                        }
                    }
                    $usrblt->bu_data = serialize($data);
                }
            }
        }
        redirect("admin_note", "viewbulletin", array("id" => $period_id, "hsuccess" => 1));
    }

    bulletin_toTemplate($period_id);

    $tpl->display($root . 'libs/bulletins/epitech/edit.tpl');
}

function bulletin_download($period_id) {
    global $tpl, $root;

    header('Content-Type: text/csv;charset=UTF-8');
    header("Content-Disposition: attachment; filename=\"Period$period_id-$_GET[format].csv\"");

    bulletin_toTemplate($period_id);

    if ($_GET['format'] == 'hoarau') {
        $tpl->display($root . 'libs/bulletins/epitech/download_hoarau.tpl');
    } else {
        $tpl->display($root . 'libs/bulletins/epitech/download_intra.tpl');
    }
}

function bulletin_view_user($id) {
    global $tpl, $root;

    $mdl = new Modele('bulletin_user');
    $mdl->fetch($id);

    $bulletin = array(
        'bu' => $mdl,
        'data' => unserialize($mdl->bu_data),
        'spice' => 0,
    );

    foreach ($bulletin['data'] as $mark) {
        $bulletin['spice'] += $mark['duration'];
    }

    $tpl->assign('bulletin', $bulletin);
    $tpl->display($root . 'libs/bulletins/epitech/user.tpl');
}
