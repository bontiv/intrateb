<?php

/*
 * Fichier pour la gestion des dossiers participants
 */

#Requis pour les maj status
require dirname(dirname(__FILE__)) . DS . 'libs' . DS . 'common.php';

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
            if ($ufile->raw_tu_payment == "YES" && $ufile->raw_tu_caution == "YES" && $ufile->raw_tu_responsability_agreement == "YES") {
                if (!$ufile->modFrom(array(
                            'tu_complete' => (new DateTime("now"))->format('Y-m-d H:i:s'),
                            "tu_step" => 9
                        ))) {
                    $tpl->assign('hsuccess', false);
                } else {
                    $tpl->assign('hsuccess', true);
                }
            } else {
                $tpl->assign('hsuccess', true);
            }
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
        if ($chq->raw_tq_type == 'PAYMENT') {
            $totalPay += $chq->tq_amount;
        } else {
            $totalCaution += $chq->tq_amount;
        }
    }

    $tpl->assign('total', $total);
    $tpl->assign('paiement', $totalPay);
    $tpl->assign('caution', $totalCaution);
    display();
}

function tripadm_add_pay() {
    global $tpl;

    $ufile = _tripadm_load();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mod = new Modele("trip_cheq");

        $args = array_merge($_POST, array(
            'tq_file' => $ufile->getKey(),
            'tq_type' => 'PAYMENT',
            'tq_date' => strftime('%F %T'),
        ));

        if ($mod->addFrom($args)) {
            _trip_update($ufile);
            redirect('tripadm', 'order', array('file' => $ufile->getKey(), 'hsuccess' => 1));
        } else {
            $tpl->assign('hsuccess', false);
        }
    }

    display();
}

function tripadm_add_caution() {
    global $tpl;

    $ufile = _tripadm_load();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mod = new Modele("trip_cheq");

        $args = array_merge($_POST, array(
            'tq_file' => $ufile->getKey(),
            'tq_type' => 'CAUTION',
            'tq_date' => strftime('%F %T'),
        ));

        if ($mod->addFrom($args)) {
            _trip_update($ufile);
            redirect('tripadm', 'order', array('file' => $ufile->getKey(), 'hsuccess' => 1));
        } else {
            $tpl->assign('hsuccess', false);
        }
    }

    display();
}
