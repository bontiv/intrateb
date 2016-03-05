<?php

function mission_index() {
    $mdl = new Modele('mission');

    $mdl->find();
    $mdl->appendTemplate('missions');

    display();
}

function mission_create() {
    global $tpl;

    $mdl = new Modele('mission');

    $tpl->assign('create_form', $mdl->edit());

    if (isset($_POST['submit'])) {
        $from = new DateTime($_POST['m_date_start']);
        $to = new DateTime($_POST['m_date_end']);
        if ($from > $to) {
            $tpl->assign('hsuccess', 'Erreur de date');
        } else {
            $tpl->assign('hsuccess', $mdl->addFrom($_POST));
        }
    }
    display();
}
