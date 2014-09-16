<?php

function cards_makeme() {
    global $tpl, $pdo, $srcdir, $tmpdir;

    $mdl = new Modele('card');
    $mdt = new Modele('mandate');
    $mdt->fetch($_POST['mandate']);
    $usr = new Modele('users');
    $usr->fetch($_SESSION['user']['user_id']);

    $imgd = imagecreatefrompng($srcdir . DS . 'libs' . DS . 'card_bg.png');
    $fdir = $srcdir . DS . 'libs' . DS . 'font' . DS;

    $c_black = imagecolorallocate($imgd, 0, 0, 0);
    $picture = imagecreatefrompng($usr->user_photo);
    imagecopy($imgd, $picture, 66, 60, 0, 0, 210, 270);
    imagettftext($imgd, 90, 0, 400, 100, $c_black, $fdir . 'data-latin.ttf', 'EPITANIME');
    imagettftext($imgd, 30, 0, 400, 150, $c_black, $fdir . 'go3v2.ttf', $mdt->mandate_label);
    imagettftext($imgd, 50, 0, 400, 240, $c_black, $fdir . 'AccidentalPresidency.ttf', "Id: " . $usr->user_id);
    imagettftext($imgd, 50, 0, 400, 300, $c_black, $fdir . 'AccidentalPresidency.ttf', "Pseudo: " . $usr->user_name);
    imagettftext($imgd, 50, 0, 400, 360, $c_black, $fdir . 'AccidentalPresidency.ttf', "Prénom: " . $usr->user_firstname);
    imagettftext($imgd, 50, 0, 400, 420, $c_black, $fdir . 'AccidentalPresidency.ttf', "Nom: " . $usr->user_lastname);

    $filename = tempnam($tmpdir, 'img');
    imagepng($imgd, $filename);

    if ($mdl->addFrom(array(
                'card_user' => $usr->user_id,
                'card_mandate' => $mdt->mandate_id,
                'card_maketime' => date('Y-m-d'),
                'card_picture' => $filename,
            ))) {
        $tpl->assign('hsuccess', true);
    } else
        $tpl->assign('hsuccess', false);

    modexec('index', 'profile');
}

function cards_index() {
    global $tpl, $pdo;

    $nb = $pdo->query('SELECT COUNT(*) FROM card WHERE card_status = \'CREATED\'');
    if ($nb = $nb->fetch())
        $tpl->assign('nbNeeded', $nb[0]);

    $nb = $pdo->query('SELECT COUNT(*) FROM card WHERE card_status = \'WAIT\'');
    if ($nb = $nb->fetch())
        $tpl->assign('nbWait', $nb[0]);

    $bdl = new Modele('cardbundle');
    $bdl->find();

    $tpl->assign('bundles', array());
    while ($l = $bdl->next()) {
        $nb = $pdo->query('SELECT COUNT(*) FROM card WHERE card_bundle = \'' . $bdl->cbundle_id . '\'');
        if ($nb = $nb->fetch())
            $l['count'] = $nb[0];
        $tpl->append('bundles', $l);
    }

    display();
}

function cards_validate() {
    global $tpl;

    $crd = new Modele('card');

    if (isset($_POST['cancel'])) {
        $crd->fetch($_POST['card']);
        $crd->card_status = 'NOPICTURE';
    }

    if (isset($_POST['validate'])) {
        $crd->fetch($_POST['card']);
        $crd->card_status = 'WAIT';
    }

    $crd->find(array('card_status' => 'CREATED'));
    if ($crd->next()) {
        $tpl->assign('card', $crd);
    } else {
        $tpl->assign('card', false);
    }

    display();
}

function cards_view() {
    $mdl = new Modele('card');
    $mdl->fetch($_GET['id']);

    header('Content-Type: image/png');
    readfile($mdl->card_picture);
    quit();
}

function cards_delmycard() {
    global $tpl;

    $mdl = new Modele('card');

    $mdl->find(array(
        'card_user' => $_SESSION['user']['user_id'],
        'card_id' => $_GET['card'],
    ));

    if (!$mdl->next()) {
        $tpl->assign('hsuccess', false);
        modexec('index', 'profile');
    }

    $mdl->delete();
    $tpl->assign('hsuccess', true);
    modexec('index', 'profile');
}

function cards_mkbundle() {
    global $tpl;

    $bdl = new Modele('cardbundle');
    if (!$bdl->addFrom(array(
                'cbundle_date' => date('Y-m-d'),
            ))) {
        $tpl->assign('msg', 'Impossible de créer le bundle');
        $tpl->display('syscore_error.tpl');
        quit();
    }

    $crd = new Modele('card');
    $crd->find(array('card_status' => 'WAIT'));
    while ($crd->next()) {
        $crd->card_bundle = $bdl;
        $crd->card_status = 'PRINT';
    }
    redirect('cards');
}
