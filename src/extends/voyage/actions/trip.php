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

function trip_admin_files() {
    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $ufiles = new Modele('trip_userfiles');
    $ufiles->find(array(
        'tu_trip' => $mdl->getKey()
    ));
    $ufiles->appendTemplate('ufiles');

    display();
}

function trip_files_delete() {
    $mod = new Modele('trip_userfiles');
    $mod->fetch($_GET['file']);
    $trip = $mod->raw_tu_trip;

    redirect('trip', 'admin_files', array('trip' => $trip, 'hsuccess' => $mod->delete() ? '0' : '1'));
}

function trip_files_edit() {
    global $tpl;

    $mod = new Modele('trip_userfiles');
    $mod->fetch($_GET['file']);
    $mod->assignTemplate('file');
    $mdl = $mod->tu_trip;
    $mdl->assignTemplate('trip');
    
    $tpl->assign('form', $mod->edit(array(
                'tu_payment',
                'tu_caution',
                'tu_responsability_agreement'
    )));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($mod->modFrom($_POST)) {
            redirect('trip', 'trip_admin_files', array('trip' => $mdl->getKey(), 'hsuccess' => '1'));
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

function trip_admin_options() {
    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $ext = new Modele('trip_options');
    $ext->find(array('topt_trip' => $mdl->getKey()));
    $ext->appendTemplate('options');

    display();
}

function trip_option_add() {
    global $tpl;

    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $mod = new Modele('trip_options');
    $form = $mod->edit(array(
        'topt_group',
        'topt_question',
        'topt_label',
    ));
    $tpl->assign('form', $form);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_merge_recursive($_POST, array(
            'topt_trip' => $mdl->getKey(),
        ));
        var_dump($data);
        if ($mod->addFrom($data)) {
            redirect('trip', 'admin_options', array('trip' => $mdl->getKey(), 'hsuccess' => 1));
        } else {
            $tpl->assign("hsuccess", false);
        }
    }

    display();
}

function trip_option_delete() {
    $mod = new Modele('trip_options');
    $mod->fetch($_GET['option']);
    $trip = $mod->raw_topt_trip;

    redirect('trip', 'admin_options', array('trip' => $trip, 'hsuccess' => $mod->delete() ? '0' : '1'));
}

function trip_option_edit() {
    global $tpl;

    $mod = new Modele('trip_options');
    $mod->fetch($_GET['option']);
    $mod->assignTemplate('option');
    $mdl = $mod->topt_trip;
    $mdl->assignTemplate('trip');

    $tpl->assign('form', $mod->edit(array(
                'topt_group',
                'topt_question',
                'topt_label',
    )));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($mod->modFrom($_POST)) {
            redirect('trip', 'admin_options', array('trip' => $mdl->getKey(), 'hsuccess' => '1'));
        } else {
            $tpl->assign('hsuccess', 0);
        }
    }

    display();
}

function trip_opt_list() {
    global $tpl;

    $mod = new Modele('trip_options');
    $mod->fetch($_GET['option']);
    $mod->assignTemplate('option');
    $mdl = $mod->topt_trip;
    $mdl->assignTemplate('trip');

    $opt = new Modele('trip_option_options');
    $opt->find(array('too_option' => $mod->getKey()));
    $opt->appendTemplate('ooptions');

    display();
}

function trip_opt_add() {
    global $tpl;

    $mod = new Modele('trip_options');
    $mod->fetch($_GET['option']);
    $mod->assignTemplate('option');
    $mdl = $mod->topt_trip;
    $mdl->assignTemplate('trip');

    $opt = new Modele('trip_option_options');
    $tpl->assign('form', $opt->edit(array(
                'too_value',
                'too_price',
    )));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_merge($_POST, array(
            'too_option' => $mod->getKey(),
        ));

        if ($opt->addFrom($data)) {
            redirect('trip', 'opt_list', array('option' => $mod->getKey(), 'hsuccess' => 1));
        }
        $tpl->assign('hsuccess', false);
    }

    display();
}

function trip_opt_delete() {
    $mod = new Modele('trip_option_options');
    $mod->fetch($_GET['option']);
    $option = $mod->raw_too_option;

    redirect('trip', 'opt_list', array('option' => $option, 'hsuccess' => $mod->delete() ? '0' : '1'));
}

function trip_opt_edit() {
    global $tpl;

    $opt = new Modele('trip_option_options');
    $opt->fetch($_GET['option']);
    $opt->assignTemplate('ooption');
    $mod = $opt->too_option;
    $mod->assignTemplate('option');
    $mdl = $mod->topt_trip;
    $mdl->assignTemplate('trip');

    $tpl->assign('form', $opt->edit(array(
                'too_value',
                'too_price',
    )));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($opt->modFrom($_POST)) {
            redirect('trip', 'opt_list', array('option' => $mod->getKey(), 'hsuccess' => 1));
        }
        $tpl->assign('hsuccess', false);
    }

    display();
}
