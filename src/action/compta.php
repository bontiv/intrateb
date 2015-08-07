<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkIBAN($iban) {
    $iban = strtolower(str_replace(' ', '', $iban));
    $Countries = array('al' => 28, 'ad' => 24, 'at' => 20, 'az' => 28, 'bh' => 22, 'be' => 16, 'ba' => 20, 'br' => 29, 'bg' => 22, 'cr' => 21, 'hr' => 21, 'cy' => 28, 'cz' => 24, 'dk' => 18, 'do' => 28, 'ee' => 20, 'fo' => 18, 'fi' => 18, 'fr' => 27, 'ge' => 22, 'de' => 22, 'gi' => 23, 'gr' => 27, 'gl' => 18, 'gt' => 28, 'hu' => 28, 'is' => 26, 'ie' => 22, 'il' => 23, 'it' => 27, 'jo' => 30, 'kz' => 20, 'kw' => 30, 'lv' => 21, 'lb' => 28, 'li' => 21, 'lt' => 20, 'lu' => 20, 'mk' => 19, 'mt' => 31, 'mr' => 27, 'mu' => 30, 'mc' => 27, 'md' => 24, 'me' => 22, 'nl' => 18, 'no' => 15, 'pk' => 24, 'ps' => 29, 'pl' => 28, 'pt' => 25, 'qa' => 29, 'ro' => 24, 'sm' => 27, 'sa' => 24, 'rs' => 22, 'sk' => 24, 'si' => 19, 'es' => 24, 'se' => 24, 'ch' => 21, 'tn' => 24, 'tr' => 26, 'ae' => 23, 'gb' => 22, 'vg' => 24);
    $Chars = array('a' => 10, 'b' => 11, 'c' => 12, 'd' => 13, 'e' => 14, 'f' => 15, 'g' => 16, 'h' => 17, 'i' => 18, 'j' => 19, 'k' => 20, 'l' => 21, 'm' => 22, 'n' => 23, 'o' => 24, 'p' => 25, 'q' => 26, 'r' => 27, 's' => 28, 't' => 29, 'u' => 30, 'v' => 31, 'w' => 32, 'x' => 33, 'y' => 34, 'z' => 35);

    if (!isset($Countries[substr($iban, 0, 2)])) {
        return false;
    }

    if (strlen($iban) == $Countries[substr($iban, 0, 2)]) {

        $MovedChar = substr($iban, 4) . substr($iban, 0, 4);
        $MovedCharArray = str_split($MovedChar);
        $NewString = "";

        foreach ($MovedCharArray AS $key => $value) {
            if (!is_numeric($MovedCharArray[$key])) {
                $MovedCharArray[$key] = $Chars[$MovedCharArray[$key]];
            }
            $NewString .= $MovedCharArray[$key];
        }

        if (bcmod($NewString, '97') == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function compta_index() {
    global $tpl;

    $mdl = new Modele('user_accounts');
    $mdl->find(array('ua_user' => $_SESSION['user']['user_id']));

    $accounts = array(array(
            'ua_id' => 0,
            'ua_identifier' => 'Chèque',
            'ua_type' => 'cheq',
            'ua_number' => '',
    ));
    while ($mdl->next()) {
        $accounts[] = $mdl->toArray();
    }

    $tpl->assign('accounts', $accounts);
    display();
}

function compta_add() {
    global $tpl;

    $mdl = new Modele('user_accounts');

    $fields = array(
        'ua_identifier',
        'ua_number',
    );

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $info = array_merge($_POST, array(
            'ua_user' => $_SESSION['user']['user_id'],
        ));

        $info['ua_number'] = strtoupper(str_replace(' ', '', $info['ua_number']));
        if (checkIBAN($info['ua_number'])) {
            if ($mdl->addFrom($info)) {
                redirect("compta", "index", array('hsuccess' => 1));
            } else {
                $tpl->assign('hsuccess', false);
            }
        } else {
            $tpl->assign('hsuccess', "Le numero IBAN est invalide");
        }
    }

    $tpl->assign('form', $mdl->edit($fields));
    display();
}

function compta_setdefault() {
    $usr = new Modele('users');
    $usr->fetch($_SESSION['user']['user_id']);

    if ($_GET['account'] == 0) {
        $usr->user_compta = 0;
        $_SESSION['user']['user_compta'] = 0;
        redirect("compta", "index", array('hsuccess' => 1));
    }

    $mdlAcc = new Modele('user_accounts');
    $mdlAcc->fetch($_GET['account']);

    if ($mdlAcc->raw_ua_user == $_SESSION['user']['user_id']) {
        $usr->user_compta = $mdlAcc->getKey();
        $_SESSION['user']['user_compta'] = $mdlAcc->getKey();
        redirect("compta", "index", array('hsuccess' => 1));
    }

    redirect("compta", "index", array('hsuccess' => 0));
}

function compta_delete() {
    $mdlAcc = new Modele('user_accounts');
    $mdlAcc->fetch($_GET['account']);

    if ($mdlAcc->raw_ua_user == $_SESSION['user']['user_id']) {
        $mdlAcc->delete();
        redirect("compta", "index", array('hsuccess' => 1));
    }

    redirect("compta", "index", array('hsuccess' => 0));
}

function compta_view() {
    display();
}

function compta_ended() {
    display();
}
