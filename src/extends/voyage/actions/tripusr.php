<?php

/*
 * Gestion des dossiers utilisateur
 */

function tripusr_index() {
    global $tpl;

    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    $ufile = new Modele('trip_userfiles');
    $ufile->find(array(
        'tu_user' => $_SESSION['user']['user_id'],
        'tu_trip' => $mdl->getKey(),
    ));
    $ufile->appendTemplate('userfiles');

    $tpl->assign('delete', new DateTime($mdl->tr_retractdate) >= new DateTime("now"));
    $tpl->assign('new', new DateTime($mdl->tr_maxdate) >= new DateTime("now"));

    display();
}

function _tripusr_new_contact($form, &$ferr) {
// Nom obligatoire
    if ($form['lastname'] == '') {
        $ferr['lastname'] = 'Le nom est obligatoire sur un contact';
    }

// Prénom obligatoire
    if ($form['firstname'] == '') {
        $ferr['firstname'] = 'Le prénom est obligatoire sur un contact';
    }

// Un numéro de tel obligatoire
    if ($form['phone'] == '' && $form['cell'] == '') {
        $ferr['phone'] = 'Un numéro de téléphone est obligatoire sur un contact';
        $ferr['cell'] = 'Un numéro de téléphone est obligatoire sur un contact';
    }

    if (count($ferr) > 0) {
        return false;
    }

    $mdl = new Modele('trip_contacts');
    $valid = $mdl->addFrom(array(
        'ta_user' => $_SESSION['user']['user_id'],
        'ta_firstname' => $form['firstname'],
        'ta_lastname' => $form['lastname'],
        'ta_mail' => $form['mail'],
        'ta_phone' => $form['phone'],
        'ta_cell' => $form['cell'],
        'ta_street1' => $form['street'],
        'ta_zipcode' => $form['zipcode'],
        'ta_town' => $form['town'],
    ));

    if (!$valid) {
        $ferr['sql'] = 'Erreur SQL';
        return false;
    }

    return $mdl->getKey();
}

function _tripusr_error($from_array) {
    $return = array();

    foreach ($from_array as $elmt) {
        if (is_array($elmt)) {
            $return = array_merge($return, _tripusr_error($elmt));
        } else {
            $return[] = $elmt;
        }
    }

    return $return;
}

function tripusr_new() {
    global $tpl;

    $ferr = array(
        't' => array(),
        'e' => array(),
    );
    $errors = array();

    $mdl = new Modele('trips');
    $mdl->fetch($_GET['trip']);
    $mdl->assignTemplate('trip');

    if (new DateTime($mdl->tr_maxdate) < new DateTime("now")) {
        $tpl->assign('errors', array("La date de fin de création de dossier est passée, vous ne pouvez plus vous inscrire."));
        display();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['traveller'] == $_POST['emergency'] && $_POST['emergency'] != 'new') {
            $errors[] = 'Le contact en cas d\'urgence ne peut pas être le participant.';
            $ferr['emergency'] = true;
            $ferr['traveller'] = true;
        } elseif ($_POST['traveller'] == 'new' || $_POST['emergency'] == 'new') {
            if ($_POST['traveller'] == 'new' && isset($_POST['t'])) {
                $contact = _tripusr_new_contact($_POST['t'], $ferr['t']);
                if ($contact !== false) {
                    $_POST['traveller'] = $contact;
                }
            }
            if ($_POST['emergency'] == 'new' && isset($_POST['e'])) {
                $contact = _tripusr_new_contact($_POST['e'], $ferr['e']);
                if ($contact !== false) {
                    $_POST['emergency'] = $contact;
                }
            }
        }

        #Recherche dossier existant
        $file = new Modele('trip_userfiles');
        $find = array('tu_trip' => $mdl->getKey());
        if ($_POST['traveller'] == 'me') {
            $find['tu_user'] = $_SESSION['user']['user_id'];
            $find['tu_participant'] = 0;
        } else {
            $find['tu_participant'] = $_POST['traveller'];
        }
        $file->find($find);
        if ($file->count() > 0) {
            $errors[] = 'Un dossier existe déjà pour ce participant sur ce voyage.';
        }

        if (count($errors)) {
            $tpl->assign('errors', $errors);
        } elseif ($_POST['emergency'] != 'new' && $_POST['traveller'] != 'new') {
            $ufile = new Modele('trip_userfiles');
            $valid = $ufile->addFrom(array(
                'tu_trip' => $mdl->getKey(),
                'tu_step' => 2,
                'tu_type' => $mdl->raw_tr_deftype,
                'tu_participant' => $_POST['traveller'] == 'me' ? 0 : $_POST['traveller'],
                'tu_emergency' => $_POST['emergency'] == 'me' ? 0 : $_POST['emergency'],
                'tu_user' => $_SESSION['user']['user_id'],
            ));

            if ($valid) {
                redirect('tripusr', 'step2', array(
                    'file' => $ufile->getKey(),
                ));
            }
            $errors[] = 'Erreur SQL création dossier';
        }
    }

    $errors = array_merge($errors, _tripusr_error($ferr));
    $errors = array_unique($errors);

// Recherche des contacts
    $ctx = new Modele('trip_contacts');
    $ctx->find(array('ta_user' => $_SESSION['user']['user_id']));
    $ctx->appendTemplate('contacts');

    $tpl->assign('ferr', $ferr);
    display();
}

function tripusr_continue() {
    $mdl = new Modele('trip_userfiles');
    $mdl->fetch($_GET['file']);

    if ($mdl->raw_tu_user == $_SESSION['user']['user_id']) {
        redirect('tripusr', 'step' . $mdl->tu_step, array('file' => $mdl->getKey()));
    }
}

function tripusr_delete() {
    $ufile = _tripusr_load();

    $mdl = new Modele('trips');
    $mdl->fetch($ufile->raw_tu_trip);

    $now = new DateTime("now");
    if (new DateTime($mdl->tr_retractdate) < $now) {
        redirect('tripusr', 'index', array(
            'trip' => $ufile->raw_tu_trip,
            'hsuccess' => false,
        ));
    }

    $opts = new Modele('trip_option_userfile');
    $opts->find(array(
        'tou_userfile' => $ufile->getKey()
    ));
    while ($opts->next()) {
        $opts->delete();
    }

    //TODO : Faire la suppression des cheques

    redirect('tripusr', 'index', array(
        'trip' => $ufile->raw_tu_trip,
        'hsuccess' => !$ufile->delete(),
    ));
}

function _tripusr_load() {
    global $tpl;

    $ufile = new Modele('trip_userfiles');

    try {
        $ufile->fetch($_GET['file']);
    } catch (SQLFetchNotFound $e) {
        redirect('syscore', 'invcall');
    }

    if ($ufile->raw_tu_user != $_SESSION['user']['user_id']) {
        redirect('syscore', 'forbidden');
    }

    $mdl = new Modele('trips');
    $mdl->fetch($ufile->raw_tu_trip);

    $tpl->assign('delete', new DateTime($mdl->tr_retractdate) >= new DateTime("now"));

    $ufile->assignTemplate('ufile');
    $ufile->tu_trip->assignTemplate('trip');

    return $ufile;
}

function _tripusr_data($fields, $from = null) {
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

function tripusr_step2() {
    global $tpl;

    $ufile = _tripusr_load();

    if ($ufile->tu_step != 2) {
        redirect('tripusr', 'continue', array('file' => $ufile->getKey()));
    }

    $health = $ufile->edit(array(
        'tu_vertigo',
        'tu_travel_sickness',
        'tu_allergy',
    ));

    $memo = $ufile->edit(array(
        'tu_comment',
    ));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["next"])) {
            $data = _tripusr_data(array(
                'tu_vertigo',
                'tu_travel_sickness',
                'tu_allergy',
                'tu_comment',
            ));

            $data['tu_step'] = 3;

            if ($ufile->modFrom($data)) {
                redirect('tripusr', 'step3', array('file' => $ufile->getKey()));
            } else {
                $tpl->assign('hsuccess', false);
            }
        }/* else {
          $data['tu_step'] = 1;
          redirect('tripusr', 'new', array('file' => $ufile->getKey(), 'trip' => $ufile->raw_tu_trip));
          } */
    }

    $tpl->assign('health', $health);
    $tpl->assign('memo', $memo);
    display();
}

function tripusr_step3() {
    global $tpl;

    $ufile = _tripusr_load();

    if ($ufile->tu_step != 3) {
        redirect('tripusr', 'continue', array('file' => $ufile->getKey()));
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valid = true;
        foreach ($_POST['opt'] as $answer) {
            $tou = new Modele('trip_option_userfile');
            $valid = $valid && $tou->addFrom(array(
                        'tou_option' => $answer,
                        'too_userfiles' => $ufile->getKey(),
            ));
        }
        if ($valid) {
            $ufile->tu_step = 4;
            redirect('tripusr', 'step4', array('file' => $ufile->getKey()));
        }
        $tpl->assign('hsuccess', false);
    }

    $optlist = array();
    $questions = new Modele('trip_options');
    $questions->find(array('topt_trip' => $ufile->raw_tu_trip));

    // Pas de complements, go etape 4
    if ($questions->count() == 0) {

        $ufile->tu_step = 4;
        redirect('tripusr', 'step4', array('file' => $ufile->getKey()));
    }

    while ($questions->next()) {
        if (!isset($optlist[$questions->topt_group])) {
            $optlist[$questions->topt_group] = array();
        }

        $qinfo = array(
            'question' => new Modele($questions),
            'options' => array(),
        );

        $opts = new Modele('trip_option_options');
        $opts->find(array('too_option' => $questions->getKey()));
        while ($opts->next()) {
            $qinfo['options'][] = new Modele($opts);
        }
        $optlist[$questions->topt_group][] = $qinfo;
    }

    $tpl->assign('groups', $optlist);

    display();
}

// Choix billet
function tripusr_step4() {
    global $tpl;

    $ufile = _tripusr_load();

    if ($ufile->tu_step != 4) {
        redirect('tripusr', 'continue', array('file' => $ufile->getKey()));
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["next"])) {
            $bill = new Modele('trip_types');
            $bill->fetch($_POST['ticket']);
            switch ($bill->raw_tt_restriction) {
                case 'ALL':
                    $ufile->tu_type = $bill->getKey();
                    $ufile->tu_price = $bill->tt_price;
                    $ufile->tu_step = 5;
                    redirect('tripusr', 'step5', array('file' => $ufile->getKey()));
                    break;
                case 'USER':
                    $ufile->tu_type = $bill->getKey();
                    if (aclFromText($_SESSION['user']['user_role']) >= ACL_USER) {
                        $ufile->tu_price = $bill->tt_price;
                        $ufile->tu_step = 5;
                        redirect('tripusr', 'step5', array('file' => $ufile->getKey()));
                    }
                    break;
                default:
                    echo 'ERROR: not implemented';
                    quit();
                    break;
            }
        }
        /* else {
          $questions = new Modele('trip_options');
          $questions->find(array('topt_trip' => $ufile->raw_tu_trip));
          // Pas de complements, go back etape 2
          if ($questions->count() == 0) {
          $ufile->tu_step = 2;
          redirect('tripusr', 'step2', array('file' => $ufile->getKey()));
          } else {
          $ufile->tu_step = 3;
          redirect('tripusr', 'step3', array('file' => $ufile->getKey()));
          }
          } */
    }

    $tickets = new Modele('trip_types');
    $tickets->find(array('tt_trip' => $ufile->raw_tu_trip));
    $tickets->appendTemplate('tickets');

    display();
}

function tripusr_step5() {
    $ufile = _tripusr_load();
    //if (isset($_POST["prev"])) {
    //    $ufile->tu_step = 4;
    //    redirect('tripusr', 'step4', array('file' => $ufile->getKey()));
    //}
    display();
}

function tripusr_step9() {
    $ufile = _tripusr_load();

    display();
}

function tripusr_paypal() {
    global $root;

    require $root . 'libs' . DS . 'caddie_paie.php';

    $paiement = Paiement::getInstance();
    $paiement->addProduct('Voyage', 10);
    $paiement->sendRequest();
}
