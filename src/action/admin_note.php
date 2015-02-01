<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function admin_note_index() {
    $mdl = new Modele('participations');
    $mdl->find(array('part_status' => 'SUBMITTED'));
    $mdl->appendTemplate('parts');

    display();
}

function admin_note_mandate() {
    $mdl = new Modele('mandate');
    $mdl->find();
    $mdl->appendTemplate('mandates');
    display();
}

function admin_note_addmandate() {
    global $tpl;

    $mdl = new Modele('mandate');
    $mdl->assignTemplate('mandat');
    if (isset($_POST['edit'])) {
        if ($mdl->addFrom($_POST)) {
            redirect("admin_note", "mandate", array('hsuccess' => 1));
        }
        $tpl->assign('hsuccess', false);
    }
    display();
}

function admin_note_delmandate() {
    $mdl = new Modele('mandate');
    $mdl->fetch($_REQUEST['mandate']);
    if ($mdl->delete()) {
        redirect("admin_note", "mandate", array('hsuccess' => 1));
    } else {
        redirect("admin_note", "mandate", array('hsuccess' => 1));
    }

    display();
}

function admin_note_periods() {
    display();
}
