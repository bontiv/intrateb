<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function trip_index() {
    $mod = new Modele('trips');
    $mod->find();
    $mod->appendTemplate('trips');

    display();
}

function trip_add() {
    global $tpl;

    $mod = new Modele('trips');
    $form = $mod->edit(array(
        'tr_name',
        'tr_start',
        'tr_end',
        'tr_maxdate',
        'tr_retractdate',
        'tr_caution',
        'tr_places',
    ));
    $tpl->assign('form', $form);

    if (isset($_POST['tr_name'])) {
        if ($mod->addFrom($_POST)) {
            redirect('trip', 'index', array('hsuccess' => 1));
        } else {
            $tpl->assign("hsuccess", false);
        }
    }

    display();
}

function trip_admin() {
    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    display();
}

function trip_edit() {
    global $tpl;

    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');
    $tpl->assign('form', $mdl->edit(array(
                'tr_name',
                'tr_start',
                'tr_end',
                'tr_maxdate',
                'tr_retractdate',
                'tr_caution',
                'tr_places',
    )));

    if (isset($_POST['tr_name'])) {
        if ($mdl->modFrom($_POST)) {
            redirect('trip', 'admin', array('trip' => $mdl->getKey(), 'hsuccess' => 1));
        } else {
            $tpl->assign("hsuccess", false);
        }
    }

    display();
}

function trip_delete() {
    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);

    redirect('trip', 'index', array('hsuccess' => $mdl->delete() ? '0' : '1'));
}

function trip_admin_cars() {
    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $ext = new Modele('trip_cars');
    $ext->find(array('tc_trip' => $mdl->getKey()));
    $ext->appendTemplate('cars');

    display();
}

function trip_car_add() {
    global $tpl;

    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $mod = new Modele('trip_cars');
    $form = $mod->edit(array(
        'tc_name',
        'tc_places',
    ));
    $tpl->assign('form', $form);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_merge_recursive($_POST, array(
            'tc_trip' => $mdl->getKey(),
        ));
        var_dump($data);
        if ($mod->addFrom($data)) {
            redirect('trip', 'admin_cars', array('trip' => $mdl->getKey(), 'hsuccess' => 1));
        } else {
            $tpl->assign("hsuccess", false);
        }
    }

    display();
}

function trip_car_delete() {
    $mod = new Modele('trip_cars');
    $mod->fetch($_GET['car']);
    $trip = $mod->raw_tc_trip;

    redirect('trip', 'admin_cars', array('trip' => $trip, 'hsuccess' => $mod->delete() ? '0' : '1'));
}

function trip_car_edit() {
    global $tpl;

    $mod = new Modele('trip_cars');
    $mod->fetch($_GET['car']);
    $mod->assignTemplate('car');
    $mdl = $mod->tc_trip;
    $mdl->assignTemplate('trip');

    $tpl->assign('form', $mod->edit(array(
                'tc_name',
                'tc_places',
    )));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($mod->modFrom($_POST)) {
            redirect('trip', 'admin_cars', array('trip' => $mdl->getKey(), 'hsuccess' => '1'));
        } else {
            $tpl->assign('hsuccess', 0);
        }
    }

    display();
}

function trip_admin_rooms() {
    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $ext = new Modele('trip_rooms');
    $ext->find(array('to_trip' => $mdl->getKey()));
    $ext->appendTemplate('rooms');

    display();
}

function trip_room_add() {
    global $tpl;

    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $mod = new Modele('trip_rooms');
    $form = $mod->edit(array(
        'to_name',
        'to_alias',
        'to_places',
        'to_type',
    ));
    $tpl->assign('form', $form);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_merge_recursive($_POST, array(
            'to_trip' => $mdl->getKey(),
        ));
        var_dump($data);
        if ($mod->addFrom($data)) {
            redirect('trip', 'admin_rooms', array('trip' => $mdl->getKey(), 'hsuccess' => 1));
        } else {
            $tpl->assign("hsuccess", false);
        }
    }

    display();
}

function trip_room_delete() {
    $mod = new Modele('trip_rooms');
    $mod->fetch($_GET['room']);
    $trip = $mod->raw_to_trip;

    redirect('trip', 'admin_rooms', array('trip' => $trip, 'hsuccess' => $mod->delete() ? '0' : '1'));
}

function trip_room_edit() {
    global $tpl;

    $mod = new Modele('trip_rooms');
    $mod->fetch($_GET['room']);
    $mod->assignTemplate('room');
    $mdl = $mod->to_trip;
    $mdl->assignTemplate('trip');

    $tpl->assign('form', $mod->edit(array(
                'to_name',
                'to_alias',
                'to_places',
                'to_type',
    )));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($mod->modFrom($_POST)) {
            redirect('trip', 'admin_rooms', array('trip' => $mdl->getKey(), 'hsuccess' => '1'));
        } else {
            $tpl->assign('hsuccess', 0);
        }
    }

    display();
}

function trip_admin_tickets() {
    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $ext = new Modele('trip_types');
    $ext->find(array('tt_trip' => $mdl->getKey()));
    $ext->appendTemplate('tickets');

    display();
}

function trip_ticket_add() {
    global $tpl;

    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $mod = new Modele('trip_types');
    $form = $mod->edit(array(
        'tt_name',
        'tt_price',
        'tt_restriction',
    ));
    $tpl->assign('form', $form);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_merge_recursive($_POST, array(
            'tt_trip' => $mdl->getKey(),
        ));
        var_dump($data);
        if ($mod->addFrom($data)) {
            redirect('trip', 'admin_tickets', array('trip' => $mdl->getKey(), 'hsuccess' => 1));
        } else {
            $tpl->assign("hsuccess", false);
        }
    }

    display();
}

function trip_ticket_delete() {
    $mod = new Modele('trip_rooms');
    $mod->fetch($_GET['room']);
    $trip = $mod->raw_to_trip;

    redirect('trip', 'admin_rooms', array('trip' => $trip, 'hsuccess' => $mod->delete() ? '0' : '1'));
}

function trip_ticket_edit() {
    global $tpl;

    $mod = new Modele('trip_rooms');
    $mod->fetch($_GET['room']);
    $mod->assignTemplate('room');
    $mdl = $mod->to_trip;
    $mdl->assignTemplate('trip');

    $tpl->assign('form', $mod->edit(array(
                'to_name',
                'to_places',
    )));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($mod->modFrom($_POST)) {
            redirect('trip', 'admin_rooms', array('trip' => $mdl->getKey(), 'hsuccess' => '1'));
        } else {
            $tpl->assign('hsuccess', 0);
        }
    }

    display();
}

function trip_ticket_default() {
    $mdl = new Modele('trip_types');
    $mdl->fetch($_GET['ticket']);
    $trip = $mdl->tt_trip;
    $trip->tr_deftype = $mdl->getKey();

    redirect('trip', 'admin_tickets', array('hsuccess' => 1, 'trip' => $trip->getKey()));
}
