<?php

/**
 * Gestion des événements
 * Ce controleur permet de gérer les différents événements.
 * @package Epicenote
 */
function event_security($page, $params) {
    $us = new Modele('user_sections');
    $event = new Modele('events');

    if (!isset($params['event']))
        return false;

    $event->fetch($params['event']);

    if (!$_SESSION['user'])
        return false;

    // Rattrapage manager de l'event
    $us->find(array(
        'us_user' => $_SESSION['user']['user_id'],
        'us_section' => $event->event_section->section_id,
        'us_type' => 'manager'
    ));
    if ($us->count()) {
        return ACL_SUPERUSER;
    }

    // Rattrapage manager de section event
    if (preg_match('`^staff(|_.*)$`', $page)) {
        $us->find(array(
            'us_user' => $_SESSION['user']['user_id'],
            'us_section' => $params['section'],
            'us_type' => 'manager'
        ));
        if ($us->count()) {
            return ACL_SUPERUSER;
        }
    }
}

/**
 * Liste les événements
 * Permet de lister tous les événements enregistrés sur l'intra.
 */
function event_index() {
    global $tpl;

    $p = new SimplePager('events');
    $p->run($tpl);

    $tpl->display('event_index.tpl');
    quit();
}

/**
 * Fonction permettant de s'inscrire en staff sur un événement
 * @global type $pdo
 */
function event_goin() {
    global $pdo;

    $sql = $pdo->prepare('INSERT INTO event_staff (est_user, est_event, est_section) VALUES (?,?,?)');
    if (!isset($_GET['user']) || !hasAcl(ACL_SUPERUSER))
        $sql->bindValue(1, $_SESSION['user']['user_id']);
    else
        $sql->bindValue(1, $_GET['user']['user_id']);
    $sql->bindValue(2, $_GET['event']);
    $sql->bindValue(3, $_GET['section']);
    $sql->execute();
    modexec('event', 'staff');
}

/**
 * Fonction permettant de quitter en staff sur un événement
 * @global type $pdo
 */
function event_goout() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM event_staff WHERE est_user = ? AND est_event = ? AND est_section = ?');
    if (!isset($_GET['user']) || !hasAcl(ACL_SUPERUSER))
        $sql->bindValue(1, $_SESSION['user']['user_id']);
    else
        $sql->bindValue(1, $_GET['user']['user_id']);
    $sql->bindValue(2, $_GET['event']);
    $sql->bindValue(3, $_GET['section']);
    $sql->execute();
    modexec('event', 'staff');
}

/**
 * Voir l'équipe d'une section
 * Quand une section participe, elle participe avec une liste de staffs. Cette page permet de voir et gérer la liste des staffs.
 */
function event_staff() {
    global $tpl, $pdo;

    $sql = $pdo->prepare('SELECT * FROM events LEFT JOIN users ON event_owner = user_id LEFT JOIN sections ON section_id = event_section WHERE event_id = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->execute();

    $event = $sql->fetch();
    if (!$event)
        modexec('syscore', 'notfound');
    $tpl->assign('event', $event);

    $sql = $pdo->prepare('SELECT * FROM event_sections LEFT JOIN sections ON es_section = section_id LEFT JOIN users ON section_owner = user_id WHERE es_event = ? AND es_section = ?');
    $sql->bindValue(1, $event['event_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    $es = array();
    $section = $sql->fetch();
    if (!$section)
        modexec('syscore', 'notfound');

    if (isset($_SESSION['user'])) {
        $sql = $pdo->prepare('SELECT COUNT(*) FROM event_staff WHERE est_user = ? AND est_section = ? AND est_event = ?');
        $sql->bindValue(1, $_SESSION['user']['user_id']);
        $sql->bindValue(2, $section['section_id']);
        $sql->bindValue(3, $event['event_id']);
        $sql->execute();
        $dat = $sql->fetch();
        $section['inType'] = $dat[0] == 0;
    } else
        $section['inType'] = false;

    $tpl->assign('section', $section);

    $sql = $pdo->prepare('SELECT * FROM event_staff LEFT JOIN users ON est_user = user_id LEFT JOIN user_sections ON us_user = user_id AND us_section = est_section WHERE est_event = ? AND est_section = ?');
    $sql->bindValue(1, $event['event_id']);
    $sql->bindValue(2, $section['section_id']);
    $sql->execute();
    $users = array();
    while ($usr = $sql->fetch())
        $users[] = $usr;

    $tpl->assign('users', $users);
    $tpl->display("event_staff.tpl");
    quit();
}

/**
 * Détails d'un événement
 * Cette page permet de voir les informations détaillés d'une section. Nous pouvons aussi utiliser cette page pour ajouter ou retirer la participation d'une section à un événement.
 */
function event_view() {
    global $tpl, $pdo;

    $sql = $pdo->prepare('SELECT * FROM events LEFT JOIN users ON event_owner = user_id LEFT JOIN sections ON section_id = event_section WHERE event_id = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->execute();

    $event = $sql->fetch();
    if (!$event)
        modexec('syscore', 'notfound');

    $sql = $pdo->prepare('SELECT * FROM event_sections LEFT JOIN sections ON es_section = section_id WHERE es_event = ?');
    $sql->bindValue(1, $event['event_id']);
    $sql->execute();
    $es = array();
    while ($line = $sql->fetch()) {
        $es[$line['section_id']] = $line;
        $es[$line['section_id']]['cdat'] = false;
        $es[$line['section_id']]['staffs'] = new Modele('event_staff');
        $es[$line['section_id']]['staffs']->find(array(
            'est_event' => $event['event_id'],
            'est_section' => $line['section_id'],
        ));
    }

    $mdl = new Modele('event_staff');
    $mdl->find(array(
        'est_event' => $event['event_id'],
        'est_user' => $_SESSION['user']['user_id'],
    ));
    while ($mdl->next()) {
        if (isset($es[$mdl->raw_est_section])) {
            $es[$mdl->raw_est_section]['cdat'] = $mdl->toArray();
        } else {
            // Réparation de table a la volé
            $mdl->delete();
        }
    }

    $tpl->assign('es', $es);

    $sql = $pdo->prepare('SELECT * FROM sections');
    $sql->execute();
    while ($line = $sql->fetch())
        if (!in_array($line['section_id'], array_keys($es)))
            $tpl->append('sections', $line);

    $tpl->assign('event', $event);
    $tpl->display('event_view.tpl');
    quit();
}

/**
 * Ajoute une section à un événement
 * Cette page permet de notifier la participation d'une section à un événement.
 */
function event_addsection() {
    global $pdo;

    $sql = $pdo->prepare('INSERT INTO event_sections (es_event, es_section) VALUES (?, ?)');
    $sql->bindValue(1, $_GET['event']);
    $sql->bindValue(2, $_POST['es_section']);
    $sql->execute();

    redirect('event', 'view', array('event' => $_GET['event']));
}

/**
 * Supprime la participation d'une section à un événement
 * Permet de supprimer une section d'un événement. On ne supprime pas la section réellement, on retire sa participation à l'événement.
 */
function event_delsection() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM event_sections WHERE es_event = ? AND es_section = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->bindValue(2, $_GET['admsec']);
    $sql->execute();

    redirect('event', 'view', array('event' => $_GET['event']));
}

/**
 * Permet d'éditer le coef d'un event
 */
function event_edit() {
    global $tpl;

    $mdl = new Modele('events');
    $mdl->fetch($_GET['event']);
    $tpl->assign('event', $mdl);
    $tpl->assign('success', false);
    $tpl->assign('error', false);

    display();
}

/**
 * Sauvegarde de l'événement
 */
function event_editpost() {
    global $tpl;

    $mdl = new Modele('events');
    $mdl->fetch($_GET['event']);
    $tpl->assign('success', false);
    $tpl->assign('error', false);
    if ($mdl->modFrom($_POST)) {
        $tpl->assign('success', true);
    } else {
        $tpl->assign('error', 'Erreur d\'enregistrement.');
    }
    $tpl->assign('event', $mdl);

    $tpl->display('event_edit.tpl');
    quit();
}

/**
 * Supprime un événement
 */
function event_delete() {
    global $tpl;

    $mdl = new Modele('events');
    try {
        $mdl->fetch($_GET['event']);
        $tpl->assign('hsuccess', $mdl->delete());
    } catch (SQLFetchNotFound $e) {
        $tpl->assign('hsuccess', false);
    }
    modexec('event', 'index');
}

function event_joinsection() {
    global $tpl;

    $mdl = new Modele('event_staff');
    $rst = $mdl->addFrom(array(
        'est_user' => $_SESSION['user']['user_id'],
        'est_event' => $_GET['event'],
        'est_section' => $_GET['section'],
    ));

    $tpl->assign('hsuccess', $rst);
    modexec('event', 'view');
}

function event_quitsection() {
    global $tpl;

    $mdl = new Modele('event_staff');
    $tpl->assign('hsuccess', $mdl->find(array(
                'est_event' => $_GET['event'],
                'est_section' => $_GET['section'],
                'est_user' => $_SESSION['user']['user_id'],
    )));

    while ($mdl->next())
        $mdl->delete();

    modexec('event', 'view');
}

function event_edit_needed() {
    $mdl = new Modele('event_sections');
    $mdl->find(array(
        'es_section' => $_GET['section'],
        'es_event' => $_GET['event'],
    ));

    $mdl->next();

    if (isset($_POST['count'])) {
        $mdl->es_needed = $_POST['count'];
        redirect('event', 'staff', array(
            'event' => $mdl->raw_es_event,
            'section' => $mdl->raw_es_section,
            'hsuccess' => '1',
        ));
    }

    $mdl->assignTemplate('es');
    display();
}

function event_staff_accept() {
    $mdl = new Modele('event_staff');
    $mdl->find(array(
        'est_event' => $_GET['event'],
        'est_section' => $_GET['section'],
        'est_user' => $_GET['user'],
    ));
    if ($mdl->next()) {
        $mdl->est_status = 'OK';
        $GLOBALS['tpl']->assign('hsuccess', true);
    } else {
        $GLOBALS['tpl']->assign('hsuccess', false);
    }

    modexec('event', 'staff');
}

function event_staff_reject() {
    $mdl = new Modele('event_staff');
    $mdl->find(array(
        'est_event' => $_GET['event'],
        'est_section' => $_GET['section'],
        'est_user' => $_GET['user'],
    ));
    if ($mdl->next()) {
        $mdl->est_status = 'NO';
        $GLOBALS['tpl']->assign('hsuccess', true);
    } else {
        $GLOBALS['tpl']->assign('hsuccess', false);
    }

    modexec('event', 'staff');
}

function event_addpoints() {
    global $tpl, $pdo;

    $event = new Modele('events');
    $event->fetch($_GET['event']);
    $event->assignTemplate('event');

    $section = new Modele('sections');
    $section->fetch($_REQUEST['section']);
    $section->assignTemplate('section');

    $queryFields = array(
        'part_duration',
        'part_title',
        'part_justification'
    );

    $mdl = new Modele('participations');
    $tpl->assign('form', $mdl->edit($queryFields));

    if (isset($_POST['edit'])) {
        $data = array(
            'part_section' => $section->section_id,
            'part_attribution_date' => date('Y-m-d'),
            'part_status' => 'SUBMITTED',
            'part_event' => $event->getKey(),
        );

        foreach ($queryFields as $field) {
            $data[$field] = $_POST[$field];
        }

        if (!$mdl->addFrom($data))
            redirect('section', 'details', array('section' => $section->section_id, 'hsuccess' => '0'));
        $sql = $pdo->prepare('SELECT * FROM event_staff LEFT JOIN users ON user_id =est_user WHERE est_section = ? AND est_event = ?');
        $sql->bindValue(1, $section->getKey());
        $sql->bindValue(2, $event->getKey());
        $sql->execute();

        $mdlMark = new Modele('marks');
        $dataMark = array(
            'mark_participation' => $mdl->getKey(),
        );

        while ($user = $sql->fetch()) {
            $markOk = $_POST['staff-' . $user['user_id'] . '-ok'];
            $markPeriod = $_POST['staff-' . $user['user_id'] . '-period'];
            $markMark = $_POST['staff-' . $user['user_id'] . '-mark'];

            if ($markOk == 'YES') {
                $dataMark['mark_user'] = $user['user_id'];
                $dataMark['mark_period'] = $markPeriod;
                $mdlMark->addFrom($dataMark);
            }
        }
        redirect('event', 'staff_activities', array('event' => $event->getKey(), 'section' => $section->section_id, 'hsuccess' => '1'));
    }

    $types = new Modele('user_types');
    $types->find();
    $repPeriods = array();

    while ($type = $types->next()) {
        $periods = $pdo->prepare('SELECT * FROM periods WHERE period_start < NOW() AND period_end > NOW() AND period_type = ? AND period_state = "ACTIVE"');
        $periods->bindValue(1, $types->ut_id);
        $periods->execute();

        while ($period = $periods->fetch()) {
            if (!isset($repPeriods[$types->ut_id])) {
                $repPeriods[$types->ut_id] = array();
            }
            $repPeriods[$types->ut_id][] = $period;
        }
    }
    $tpl->assign('periods', $repPeriods);

    $sql = $pdo->prepare('SELECT * FROM event_staff LEFT JOIN users ON user_id =est_user WHERE est_section = ? AND est_event = ? ORDER BY user_name');
    $sql->bindValue(1, $section->getKey());
    $sql->bindValue(2, $event->getKey());
    $sql->execute();

    while ($user = $sql->fetch()) {
        $tpl->append('staffs', $user);
    }

    display();
}

function event_staff_activities() {
    global $tpl, $pdo;

    $sql = $pdo->prepare('SELECT * FROM events LEFT JOIN users ON event_owner = user_id LEFT JOIN sections ON section_id = event_section WHERE event_id = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->execute();

    $event = $sql->fetch();
    if (!$event)
        modexec('syscore', 'notfound');
    $tpl->assign('event', $event);

    $sql = $pdo->prepare('SELECT * FROM event_sections LEFT JOIN sections ON es_section = section_id LEFT JOIN users ON section_owner = user_id WHERE es_event = ? AND es_section = ?');
    $sql->bindValue(1, $event['event_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();

    $es = array();
    $section = $sql->fetch();
    if (!$section)
        modexec('syscore', 'notfound');

    if (isset($_SESSION['user'])) {
        $sql = $pdo->prepare('SELECT COUNT(*) FROM event_staff WHERE est_user = ? AND est_section = ? AND est_event = ?');
        $sql->bindValue(1, $_SESSION['user']['user_id']);
        $sql->bindValue(2, $section['section_id']);
        $sql->bindValue(3, $event['event_id']);
        $sql->execute();
        $dat = $sql->fetch();
        $section['inType'] = $dat[0] == 0;
    } else
        $section['inType'] = false;

    $tpl->assign('section', $section);

    $activites = new Modele('participations');
    $activites->find(array(
        'part_section' => $section['section_id'],
        'part_event' => $event['event_id'],
    ));
    while ($activites->next()) {
        $tpl->append('activities', new Modele($activites));
    }

    display();
}

function event_bocal_list() {
    global $tpl, $pdo;

    $sql = $pdo->prepare('SELECT * FROM events LEFT JOIN users ON event_owner = user_id LEFT JOIN sections ON section_id = event_section WHERE event_id = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->execute();

    $event = $sql->fetch();
    if (!$event) {
        modexec('syscore', 'notfound');
    }
    $tpl->assign('event', $event);

    $mdl = new Modele('event_bocal');
    $mdl->find(array('eb_event' => $event['event_id']));
    $mdl->appendTemplate('tickets');

    display();
}

function event_bocal_add() {
    global $srcdir;

    include_once $srcdir . '/libs/bocal.php';

    $bocal = new Bocal();
    if (!$bocal->getTicket($_REQUEST['ticketid'])) {
        redirect("event", "bocal_list", array("event" => $_GET['event'], "hsuccess" => 0));
    }

    $mdl = new Modele('event_bocal');
    $mdl->addFrom(array(
        'eb_ticket' => $bocal->id,
        'eb_event' => $_GET['event'],
        'eb_title' => $bocal->title,
    ));
    redirect("event", "bocal_list", array("event" => $_GET['event'], "hsuccess" => 1));
}

function event_bocal_view() {
    global $tpl, $pdo, $srcdir;

    $sql = $pdo->prepare('SELECT * FROM events LEFT JOIN users ON event_owner = user_id LEFT JOIN sections ON section_id = event_section WHERE event_id = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->execute();

    $event = $sql->fetch();
    if (!$event) {
        modexec('syscore', 'notfound');
    }
    $tpl->assign('event', $event);

    $mdl = new Modele('event_bocal');
    $mdl->find(array(
        'eb_id' => $_GET['ticket'],
        'eb_event' => $event['event_id'],
    ));

    if (!$mdl->next()) {
        modexec('syscore', 'notfound');
    }

    include_once $srcdir . '/libs/bocal.php';

    $bocal = new Bocal();
    if (!$bocal->getTicket($mdl->eb_ticket)) {
        modexec('syscore', 'notfound');
    }
    $bocal->updateDB($mdl->getKey());
    $tpl->assign('ticket', $bocal);
    display();
}

function event_staff_add() {
    global $pdo;

    // Autocomplete
    if (isset($_GET['format']) && $_GET['format'] == 'json') {
        $sql = $pdo->prepare("SELECT user_name FROM users WHERE user_name LIKE ? ORDER BY user_name ASC LIMIT 10");
        $sql->bindValue(1, "%$_GET[term]%");
        $sql->execute();

        echo json_encode($sql->fetchAll(PDO::FETCH_COLUMN, 0));
        quit();
    }

    if (isset($_POST['login'])) {
        $mdl = new Modele('event_staff');
        $usr = $pdo->prepare('SELECT user_id FROM users WHERE user_name = ?');
        foreach (explode(',', $_POST['login']) as $login) {
            $usr->bindValue(1, trim($login));
            $usr->execute();
            $usrDetails = $usr->fetch();
            if ($usrDetails !== false) {
                $mdl->find(array(
                    'est_user' => $usrDetails['user_id'],
                    'est_event' => $_REQUEST['event'],
                    'est_section' => $_REQUEST['section'],
                ));
                if ($mdl->next()) {
                    $mdl->est_status = 'OK';
                } else {
                    $mdl->addFrom(array(
                        'est_user' => $usrDetails['user_id'],
                        'est_event' => $_REQUEST['event'],
                        'est_section' => $_REQUEST['section'],
                        'est_status' => 'OK',
                    ));
                }
            }
        }
        redirect('event', 'staff', array('section' => $_REQUEST['section'], 'event' => $_REQUEST['event'], 'hsuccess' => 1));
    }
}
