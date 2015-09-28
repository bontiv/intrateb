<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function developer_security($page, $params) {
    $mdl = new Modele('api_clients');

    if (!$_SESSION['user'] || !isset($params['section'])) {
        return false;
    }

    $pages = array('view');

    if (!in_array($pages, $page)) {
        return false;
    }

    $mdl->find(array(
        'ac_owner' => $_SESSION['user']['user_id'],
        'ac_id' => $params['apli'],
    ));
    if ($mdl->count()) {
        return ACL_SUPERUSER;
    }
    return false;
}

function developer_index() {
    //Securité : sortir les gens malhonnêtes
    if (isset($_REQUEST['appli'])) {
        modexec('syscore', 'forbidden');
    }

    $cli = new Modele('api_clients');

    if (hasAcl(ACL_SUPERUSER)) {
        $cli->find();
    } else {
        $cli->find(array(
            'ac_owner' => $_SESSION['user']['user_id'],
        ));
    }

    $cli->appendTemplate('clients');
    display();
}

function developer_view() {
    global $tpl;

    $mdl = new Modele('api_clients');
    $mdl->fetch($_REQUEST['appli']);
    $mdl->assignTemplate('apli');

    $allowed_callbacks = explode("\n", $mdl->ac_callback);
    foreach ($allowed_callbacks as &$callback) {
        $callback = trim($callback, " \t\n\r\0\x0B/");
    }

    $tpl->assign('callbacks', $allowed_callbacks);
    display();
}

function developer_valid() {
    $mdl = new Modele('api_clients');
    $mdl->fetch($_REQUEST['appli']);
    $mdl->ac_active = 'VALID';

    redirect('developer', 'view', array('appli' => $_REQUEST['appli'], 'hsuccess' => '1'));
}

function developer_refuse() {
    $mdl = new Modele('api_clients');
    $mdl->fetch($_REQUEST['appli']);
    $mdl->ac_active = 'REFUSED';

    redirect('developer', 'view', array('appli' => $_REQUEST['appli'], 'hsuccess' => '1'));
}

function developer_send() {
    $mdl = new Modele('api_clients');
    $mdl->fetch($_REQUEST['appli']);
    $mdl->ac_active = 'WAITING';

    redirect('developer', 'view', array('appli' => $_REQUEST['appli'], 'hsuccess' => '1'));
}

function developer_refresh() {
    $mdl = new Modele('api_clients');
    $mdl->fetch($_REQUEST['appli']);
    $mdl->ac_secret = md5(uniqid('', true));

    $key = openssl_pkey_new(array(
        'private_key_bits' => 512,
        'encrypt_key' => false,
    ));
    openssl_pkey_export($key, $keypem);
    $mdl->ac_apikey = $keypem;


    redirect('developer', 'view', array('appli' => $_REQUEST['appli'], 'hsuccess' => '1'));
}

function developer_edit() {
    $mdl = new Modele('api_clients');
    $mdl->fetch($_REQUEST['appli']);

    if (isset($_POST['callback'])) {
        $mdl->ac_callback = $_POST['callback'];
        redirect('developer', 'view', array('appli' => $_REQUEST['appli'], 'hsuccess' => '1'));
    }

    $mdl->assignTemplate('cli');
    display();
}

function developer_log() {
    global $pdo, $tpl;

    if (hasAcl(ACL_SUPERUSER)) {
        $sql = $pdo->query('SELECT * FROM api_tokens LEFT JOIN users ON user_id = at_user LEFT JOIN api_clients ON at_client = ac_id WHERE at_type = \'ACCESS\' ORDER BY at_start DESC LIMIT 50');
    } else {
        $sql = $pdo->prepare('SELECT * FROM api_tokens LEFT JOIN users ON user_id = at_user LEFT JOIN api_clients ON at_client = ac_id WHERE ac_owner = 1 AND at_type = \'ACCESS\' ORDER BY at_start DESC LIMIT 50');
        $sql->bindValue(1, $_SESSION['user']['user_id']);
        $sql->execute();
    }

    while ($line = $sql->fetch()) {
        $tpl->append('logs', $line);
    }

    display();
}
