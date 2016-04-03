<?php

function mission_index() {
    global $user;

    $mdl = new Modele('mission');

    if (isset($_SESSION['user']) && $_SESSION['user'] != false) {
        $mdl->addExternalTable(
                'mission_dispo', array(
            'md_user' => $_SESSION['user']['user_id']
                )
        );
    }
    $mdl->find();

    $mdl->appendTemplate('missions');
    display();
}

function mission_dispo() {
    $success = true;

    //Purge olds
    $mdl = new Modele('mission_dispo');
    foreach ($_POST as $name => $value) {
        $field = explode('_', $name);
        if ($field[0] == 'DISPO') {
            $mdl->find(array(
                'md_mission' => $field[1],
                'md_user' => $_SESSION['user']['user_id']
            ));
            while ($mdl->next()) {
                $mdl->delete();
            }

            $success &= $mdl->addFrom(array(
                'md_mission' => $field[1],
                'md_user' => $_SESSION['user']['user_id'],
                'md_dispo' => $value,
            ));
        }
    }

    redirect('mission', 'index', array('hsuccess' => $success));
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

function mission_show() {
    $mdl = new Modele("mission");
    $mdl->fetch($_GET['id']);
    $mdl->assignTemplate('mission');

    $dispo = new Modele("mission_dispo");
    $dispo->find(array(
        "md_mission" => $mdl->getKey(),
        "md_dispo" => array(
            'AVAILABLE',
            'UNKNOW',
            'REFUSED'
        ),
            ), "md_dispo");
    $dispo->appendTemplate("dispos");

    display();
}
