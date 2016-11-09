<?php

function _find_user_status($usr) {
    if ($usr->user_role == 'ADMINISTRATOR') {
        return ('bureau');
    } else {
        switch ($usr->user_type->ut_name) {
            case 'EPITECH':
            case 'EPITA':
            case 'CODING ACADEMY':
            case 'IONIS STM':
                return ('etudiant');
            default:
                return ('externe');
        }
    }
}

function _resize_logo($imgd) {
    global $srcdir;
    
    $logo = imagecreatefrompng($srcdir . DS . 'libs' . DS . 'card_logo.png');
    $sz = getimagesize($srcdir . DS . 'libs' . DS . 'card_logo.png');
    
    if ($sz[0] / 100 > $sz[1] / 145) {
        $w = 100;
        $h = ceil(100 * $sz[1] / $sz[0]);
    } else {
        $w = ceil(145 * $sz[0] / $sz[1]);
        $h = 145;
    }
    imagecopyresized($imgd, $logo, 530, 0, 0, 0, $w, $h, $sz[0], $sz[1]);
}

function cards_makeme() {
    global $tpl, $pdo, $srcdir, $tmpdir, $config;

    include_once $srcdir . DS . 'libs' . DS . 'barcode.php';

    //Verif
    $sql = $pdo->prepare('SELECT COUNT(*) FROM user_mandate WHERE um_user = ? AND um_mandate = ?');
    $sql->bindValue(1, $_SESSION['user']['user_id']);
    $sql->bindValue(2, $_POST['mandate']);
    $sql->execute();
    $TEST = $sql->fetch();
    if ($TEST[0] == 0) {
        modexec('syscore', 'moderror');
        quit();
    }

    $mdl = new Modele('card');
    $mdt = new Modele('mandate');
    $mdt->fetch($_POST['mandate']);
    $usr = new Modele('users');
    $usr->fetch($_SESSION['user']['user_id']);

    $filename = tempnam($tmpdir, 'img');

    if ($mdl->addFrom(array(
                'card_user' => $usr->user_id,
                'card_mandate' => $mdt->mandate_id,
                'card_maketime' => date('Y-m-d'),
                'card_picture' => $filename,
            ))) {
        $tpl->assign('hsuccess', true);
    } else
        $tpl->assign('hsuccess', false);

    
    $imgd = imagecreatefrompng($srcdir . DS . 'libs' . DS . 'card_bg.png');
    $fdir = $srcdir . DS . 'libs' . DS . 'font' . DS;

    $c_black = imagecolorallocate($imgd, 0, 0, 0);
   
    $picture = imagecreatefrompng($usr->user_photo);
    imagecopy($imgd, $picture, 950, 180, 0, 0, 210, 270);
    _resize_logo($imgd);
    imagettftext($imgd, 30, 0, 20, 40, $c_black, $fdir . 'data-latin.ttf', 'LATEB');
    imagettftext($imgd, 30, 0, 20, 100, $c_black, $fdir . 'go3v2.ttf', 'Carte de membre');
    imagettftext($imgd, 30, 0, 800, 100, $c_black, $fdir . 'go3v2.ttf', 'Validité: ' . $mdt->mandate_label);
    imagettftext($imgd, 50, 0, 20, 240, $c_black, $fdir . 'AccidentalPresidency.ttf', "Nom:");
    imagettftext($imgd, 50, 0, 455, 240, $c_black, $fdir . 'data-latin.ttf', $usr->user_lastname);
    imagettftext($imgd, 50, 0, 20, 310, $c_black, $fdir . 'AccidentalPresidency.ttf', "Prénom:");
    imagettftext($imgd, 50, 0, 455, 310, $c_black, $fdir . 'data-latin.ttf', $usr->user_firstname);
    imagettftext($imgd, 50, 0, 20, 370, $c_black, $fdir . 'AccidentalPresidency.ttf', "Pseudo:");
    imagettftext($imgd, 50, 0, 455, 370, $c_black, $fdir . 'data-latin.ttf', $usr->user_name);
    imagettftext($imgd, 50, 0, 20, 430, $c_black, $fdir . 'AccidentalPresidency.ttf', "Date de naissance:");
    imagettftext($imgd, 50, 0, 455, 430, $c_black, $fdir . 'data-latin.ttf', $usr->user_born);
    imagettftext($imgd, 50, 0, 20, 490, $c_black, $fdir . 'AccidentalPresidency.ttf', "Statut:");
    imagettftext($imgd, 50, 0, 455, 490, $c_black, $fdir . 'data-latin.ttf', "membre " . _find_user_status($usr));
    imagettftext($imgd, 50, 0, 20, 550, $c_black, $fdir . 'AccidentalPresidency.ttf', "Immatriculation:");
    imagettftext($imgd, 50, 0, 455, 550, $c_black, $fdir . 'data-latin.ttf', $config['assoInfo']['assoId'] . " - " . $usr->user_id);
    /*imagettftext($imgd, 30, 0, 60, 150, $c_black, $fdir . 'go3v2.ttf', $mdt->mandate_label);
    imagettftext($imgd, 50, 0, 60, 240, $c_black, $fdir . 'AccidentalPresidency.ttf', "Immatriculation: " . $usr->user_id);
    imagettftext($imgd, 50, 0, 60, 300, $c_black, $fdir . 'AccidentalPresidency.ttf', "Pseudo: " . $usr->user_name);
    imagettftext($imgd, 50, 0, 60, 360, $c_black, $fdir . 'AccidentalPresidency.ttf', "Prénom: " . $usr->user_firstname);
    imagettftext($imgd, 50, 0, 60, 420, $c_black, $fdir . 'AccidentalPresidency.ttf', "Nom: " . $usr->user_lastname);*/

    $cbfile = tempnam($tmpdir, 'cb');
    imagebarcode($cbfile, str_pad($mdl->getKey(), 12, '0', STR_PAD_LEFT), 600, 70, 5);
    $codebar = imagecreatefrompng($cbfile);
    imagecopy($imgd, $codebar, 275, 580, 0, 0, 600, 70);
    unlink($cbfile);

    imagepng($imgd, $filename);

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

function cards_viewmycard() {
    $mdl = new Modele('card');
    $mdl->find(array(
        'card_id' => $_GET['card'],
        'card_user' => $_SESSION['user']['user_id'],
    ));
    $mdl->next();

    header('Content-Type: image/png');
    readfile($mdl->card_picture);
    quit();
}

/**
 * Refus de carte par pannel user
 * @global type $tpl
 */
function cards_delcard() {
    global $tpl;

    $mdl = new Modele('card');

    $mdl->fetch($_GET['card']);
    $mdl->card_status = 'NOPICTURE';
    $tpl->assign('hsuccess', true);
    $_REQUEST['user'] = $mdl->raw_card_user;
    modexec('user', 'view');
}

/**
 * Acceptation de carte par pannel user
 * @global type $tpl
 */
function cards_okcard() {
    global $tpl;

    $mdl = new Modele('card');

    $mdl->fetch($_GET['card']);
    $mdl->card_status = 'WAIT';
    $tpl->assign('hsuccess', true);
    $_REQUEST['user'] = $mdl->raw_card_user;
    modexec('user', 'view');
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

function cards_download() {
    global $tmpdir;

    $bdl = new Modele('cardbundle');
    $bdl->fetch($_GET['bundle']);
    $bdl->cbundle_status = 'WAIT';

    $crd = new Modele('card');
    $crd->find(array('card_bundle' => $bdl->cbundle_id));

    $zipfile = tempnam($tmpdir, 'zip');

    $zip = new ZipArchive();
    $zip->open($zipfile, ZipArchive::CREATE);

    $zip->setArchiveComment("Automade zip archive from EPITANIME intra software. Bundle " . $bdl->cbundle_date);

    while ($crd->next()) {
        $zip->addFile($crd->card_picture, "card$crd->card_id.png");
        $crd->card_status = 'PRINT';
    }

    $zip->close();
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="bundle_' . $bdl->cbundle_date . '.zip"');
    readfile($zipfile);
    unlink($zipfile);

    quit();
}

function cards_bundleok() {
    $bdl = new Modele('cardbundle');
    $bdl->fetch($_GET['bundle']);
    $bdl->cbundle_status = 'OK';

    redirect('cards');
}

function cards_delbundle() {
    $bdl = new Modele('cardbundle');
    $bdl->fetch($_GET['bundle']);

    $crd = new Modele('card');
    $crd->find(array(
        'card_bundle' => $bdl->getKey(),
    ));

    while ($crd->next()) {
        $crd->card_bundle = null;
        $crd->card_status = 'WAIT';
    }

    $bdl->delete();

    redirect('cards');
}
