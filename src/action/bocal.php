<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function bocal_update() {
    global $srcdir;

    include $srcdir . '/libs/bocal.php';

    $mdl = new Modele('event_bocal');
    $mdl->find();
    $boc = new Bocal();

    while ($mdl->next()) {
        $boc->getTicket($mdl->eb_ticket);
        $boc->updateDB($mdl->getKey());
    }
    echo "ok";
}
