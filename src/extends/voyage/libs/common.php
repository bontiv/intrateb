<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function _trip_update($ufile) {

    $total = $ufile->tu_type->tt_price;

    $opt = new Modele('trip_option_userfile');
    $opt->find(array('too_userfiles' => $ufile->getKey()));

    while ($opt->next()) {
        $total += $opt->tou_option->too_price;
    }

    $chq = new Modele('trip_cheq');
    $totalPay = 0;
    $totalCaution = 0;

    $chq->find(array(
        'tq_file' => $ufile->getKey(),
    ));
    while ($chq->next()) {
        if ($chq->raw_tq_type == 'PAYMENT') {
            $totalPay += $chq->tq_amount;
        } else {
            $totalCaution += $chq->tq_amount;
        }
    }

    if ($totalPay >= $total && $ufile->raw_tu_payment != 'YES') {
        $ufile->tu_payment = 'YES';
    }
    if ($totalCaution >= $ufile->tu_trip->tr_caution && $ufile->raw_tu_caution != 'YES') {
        $ufile->tu_caution = 'YES';
    }
    if ($ufile->raw_tu_payment == 'YES' && $ufile->raw_tu_caution == 'YES' && $ufile->tu_step == 5) {
        $ufile->tu_step = 9;
    }
}
