<?php

/*
 * Fichier pour la gestion des dossiers participants
 */

function _tripadm_load() {
    $ufile = new Modele('trip_userfiles');

    try {
        $ufile->fetch($_GET['file']);
    } catch (SQLFetchNotFound $e) {
        redirect('syscore', 'invcall');
    }

//    if ($ufile->raw_tu_user != $_SESSION['user']['user_id']) {
//        redirect('syscore', 'forbidden');
    //   }

    $ufile->assignTemplate('ufile');
    $ufile->tu_trip->assignTemplate('trip');

    return $ufile;
}

function _tripadm_data($fields, $from = null) {
    $data = array();

    if ($from === null) {
        $from = $_POST;
    }

    foreach ($fields as $field) {
        if (isset($from[$field])) {
            $data[$field] = $from[$field];
        }
    }

    return $data;
}

function tripadm_index() {
    global $tpl;

    $ufile = _tripadm_load();
    $data = array();

    if (isset($_GET["tu_payment"])) {
        $data[] = "tu_payment";
    }
    if (isset($_GET["tu_caution"])) {
        $data[] = "tu_caution";
    }
    if (isset($_GET["tu_responsability_agreement"])) {
        $data[] = "tu_responsability_agreement";
    }

    $data = _tripadm_data($data, $_GET);
    if (!empty($data)) {
        if ($ufile->modFrom($data)) {
            $tpl->assign('hsuccess', true);
        } else {
            $tpl->assign('hsuccess', false);
        }
    }

    display();
}

function tripadm_contact() {
    $ufile = _tripadm_load();

    display();
}

function tripadm_health() {
    $ufile = _tripadm_load();

    display();
}

function tripadm_order() {
    global $tpl;


    $ufile = _tripadm_load();
    $total = $ufile->tu_type->tt_price;

    $opt = new Modele('trip_option_userfile');
    $opt->find(array('too_userfiles' => $ufile->getKey()));

    while ($opt->next()) {
        $tpl->append('opts', new Modele($opt));
        $total += $opt->tou_option->too_price;
    }

    $chq = new Modele('trip_cheq');
    $totalPay = 0;
    $totalCaution = 0;

    $chq->find(array(
        'tq_file' => $ufile->getKey(),
    ));
    while ($chq->next()) {
        $tpl->append('chqs', new Modele($chq));
        if ($chq->raw_cq_type == 'PAYMENT') {
            $totalPay += $chq->cq_amount;
        } else {
            $totalCaution += $chq->cq_amount;
        }
    }


    $tpl->assign('total', $total);
    $tpl->assign('paiement', $totalPay);
    $tpl->assign('caution', $totalCaution);
    display();
}

function tripadm_add_pay() {
    $ufile = _tripadm_load();

    display();
}

function tripadm_add_caution() {
    $ufile = _tripadm_load();

    display();
}
