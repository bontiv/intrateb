<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function _ftp_exec($command) {
    global $config;

    $ftpConf = $config['ftpServer'];

    if ($ftpConf['type'] == 'LOCAL') {
        $return_var = 0;
        $output = array();
        exec($command, $output, $return_var);
        return $return_var;
    } else {
        $ssh = ssh2_connect($ftpConf['host'], 22);
        if ($ssh === false) {
            return false;
        }
        if (!ssh2_auth_password($ssh, $ftpConf['user'], $ftpConf['pass'])) {
            return false;
        }
        return ssh2_exec($ssh, $command);
    }
}

function ftp_index() {
    global $pdo, $tpl;

    $sqlQuery = 'SELECT * '
            . 'FROM ftp_users '
            . 'LEFT JOIN sections ON section_id = fu_section '
            . 'LEFT JOIN users ON fu_member = user_id '
            . 'LEFT JOIN user_sections ON fu_section = us_section AND us_user = :uid ';
    if (!hasAcl(ACL_ADMINISTRATOR)) {
        $sqlQuery .= 'WHERE fu_member = :uid OR ( '
                . 'us_type = \'manager\' '
//                . 'AND us_user = :uid '
                . ')';
    }
    $sql = $pdo->prepare($sqlQuery);
    $sql->bindValue('uid', $_SESSION['user']['user_id']);
    $sql->execute();

    while ($line = $sql->fetch()) {
        $tpl->append('allFtp', $line);
    }
    display();
}

function ftp_del() {
    global $tpl;

    $account = new Modele('ftp_users');
    $account->fetch($_GET['account']);

    if (!hasAcl(ACL_ADMINISTRATOR)
//            && $account->raw_fu_member != $_SESSION['user']['user_id']
            && (
            !isset($_SESSION['user']['sections'][$account->raw_fu_section]) || $_SESSION['user']['sections'][$account->raw_fu_section]['us_type'] != 'manager'
            )) {
        $tpl->assign('hsuccess', false);
        modexec('ftp');
    } else {
        $usr = escapeshellarg($account->fu_user);
        _ftp_exec("sudo /opt/scripts/deluser.sh $usr");
        $tpl->assign('hsuccess', $account->delete());
        modexec('ftp');
    }
}

function ftp_edit() {
    global $tpl;

    $account = new Modele('ftp_users');
    $account->fetch($_GET['account']);
    $tpl->assign('account', $account);

    if (!hasAcl(ACL_ADMINISTRATOR)
//            && $account->raw_fu_member != $_SESSION['user']['user_id']
            && (
            !isset($_SESSION['user']['sections'][$account->raw_fu_section]) || $_SESSION['user']['sections'][$account->raw_fu_section]['us_type'] != 'manager'
            )) {
        $tpl->assign('hsuccess', false);
        modexec('ftp');
    } else {
        if (isset($_POST['password'])) {
            if (strlen($_POST['password']) < 8) {
                $tpl->assign('badpass', 'Le mot de passe est trop court.');
                display();
            } else {
                $account->fu_pass = $_POST['password'];
                $usr = escapeshellarg($account->fu_user);
                $pwd = escapeshellarg($_POST['password']);
                _ftp_exec("sudo /opt/scripts/passwduser.sh $usr $pwd");
                $tpl->assign('hsuccess', true);
                modexec('ftp');
            }
        } else {
            display();
        }
    }
}

function ftp_add() {
    global $tpl, $pdo;

    $grp = new Modele('sections');
    $grp->find();
    while ($grp->next()) {
        if (hasAcl(ACL_ADMINISTRATOR) || (isset($_SESSION['user']['sections'][$grp->section_id]) && $_SESSION['user']['sections'][$grp->section_id]['us_type'] == 'manager'))
            $tpl->append('groups', $grp->toArray());
    }

    if (isset($_POST['user'])) {
        $sqlUsr = $pdo->prepare('SELECT * FROM users WHERE user_name LIKE ?');
        $sqlUsr->bindValue(1, $_POST['member']);
        $sqlUsr->execute();
        if ($sqlUsr->rowCount() == 0) {
            $tpl->assign('error', 'Utilisateur INTRA introuveable.');
            display();
        } elseif (!hasAcl(ACL_ADMINISTRATOR) && (!isset($_SESSION['user']['sections'][$_POST['section']]) || $_SESSION['user']['sections'][$_POST['section']]['us_type'] != 'manager')) {
            $tpl->assign('error', 'Groupe introuveable.');
            display();
        } elseif (strlen($_POST['pass']) < 8) {
            $tpl->assign('error', 'Le mot de passe doit faire au moins 8 caractères.');
            display();
        } else {
            $add = new Modele('ftp_users');
            $user = $sqlUsr->fetch();
            $tpl->assign('hsuccess', $add->addFrom(array(
                        'fu_user' => 'toy_' . $_POST['user'],
                        'fu_pass' => $_POST['pass'],
                        'fu_section' => $_POST['section'],
                        'fu_member' => $user['user_id'],
                        'fu_path' => '/home/ftp/toyunda/timeurs/',
            )));
            $usr = escapeshellarg($_POST['user']);
            $pwd = escapeshellarg($_POST['pass']);
            _ftp_exec("sudo /opt/scripts/adduser.sh $usr $pwd");
            display();
        }
    }

    display();
}
