<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function twofactors_set() {
    global $tpl, $srcdir;

    $usr = new Modele('users');
    $usr->fetch($_SESSION['user']['user_id']);

    if ($_POST['activation'] == "true") {
        require_once $srcdir . '/libs/GoogleAuthenticator/GoogleAuthenticator.php';

        $otp = new GoogleAuthenticator();
        if (!$otp->checkCode($_SESSION['user']['GoogleAuthenticator'], $_POST['code'])) {
            $tpl->assign('hsuccess', "GoogleAuthentificator code invalide");
            modexec("index", "profile");
            quit();
        }
        $usr->user_otp = $_SESSION['user']['GoogleAuthenticator'];
    } else {
        $usr->user_otp = "";
    }
    $_SESSION['user']['user_otp'] = $usr->user_otp;
    redirect("index", "profile", array('hsuccess' => 1));
}

function twofactors_getQR() {
    global $srcdir;

    require_once $srcdir . '/libs/phpqrcode/phpqrcode.php';


    $text = sprintf("otpauth://totp/%s@%s?secret=%s&issuer=Epitanime", $_SESSION['user']['user_name'], $_SERVER['HTTP_HOST'], $_SESSION['user']['GoogleAuthenticator']);

    $qrcode = new QRcode();
    $qrcode->png($text, false, QR_ECLEVEL_M, 5);
    quit();
}
