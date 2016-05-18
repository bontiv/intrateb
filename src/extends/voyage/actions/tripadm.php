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

    if ($ufile->raw_tu_user != $_SESSION['user']['user_id']) {
        redirect('syscore', 'forbidden');
    }

    $ufile->assignTemplate('ufile');
    $ufile->tu_trip->assignTemplate('trip');

    return $ufile;
}

function tripadm_index() {
    $ufile = _tripadm_load();

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
    $ufile = _tripadm_load();

    display();
}
