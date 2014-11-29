<?php

/**
 * Controleur sur la gestion des sections
 * Ce controleur contient toutes les pages utilisés pour gérer les sections.
 * @package Epicenote
 */

/**
 * Défini le mode superuser
 */
function section_security($page, $params) {
    $mdl = new Modele('user_sections');

    if (!$_SESSION['user'] || !isset($params['section']))
        return false;

    $mdl->find(array(
        'us_user' => $_SESSION['user']['user_id'],
        'us_section' => $params['section'],
        'us_type' => 'manager'
    ));
    if ($mdl->count()) {
        return ACL_SUPERUSER;
    }
    return false;
}

/**
 * Permet de créer un événement
 * Ce controleur permet de créer un événement à partir d'une section. On y accède à partir de la fiche de la section qui va gérer le déroulement de l'événement.
 */
function section_mkevent() {
    global $pdo, $tpl;

    $tpl->assign('error', false);
    $tpl->assign('succes', false);
    $tpl->assign('section', $_GET['section']);

    if (isset($_POST['event_name'])) {
        $dateStart = new DateTime($_POST['event_start']);
        $dateEnd = new DateTime($_POST['event_end']);
        $sevenDays = new DateInterval('P7D');
        $dateLock = new DateTime($dateStart->format('Y-m-d H:i:s'));
        $dateLock->sub($sevenDays);
        $dateNote1 = new DateTime($dateEnd->format('Y-m-d H:i:s'));
        $dateNote1->add($sevenDays);
        $dateNote2 = new DateTime($dateNote1->format('Y-m-d H:i:s'));
        $dateNote2->add($sevenDays);

        $extra = array(
            'event_start' => $dateStart->format('Y-m-d H:i:s'),
            'event_end' => $dateEnd->format('Y-m-d H:i:s'),
            'event_lock' => $dateLock->format('Y-m-d H:i:s'),
            'event_note1' => $dateNote1->format('Y-m-d H:i:s'),
            'event_note2' => $dateNote2->format('Y-m-d H:i:s'),
            'event_coef' => 1,
            'event_section' => $_GET['section'],
            'event_owner' => $_SESSION['user']['user_id'],
        );

        if (autoInsert('events', 'event_', $extra))
            $tpl->assign('succes', true);
        else
            $tpl->assign('error', true);
    }

    $tpl->display('section_mkevent.tpl');
    quit();
}

/**
 * Liste toutes les sections
 */
function section_index() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM sections LEFT JOIN users ON user_id = section_owner');
    $sql->execute();
    while ($line = $sql->fetch()) {

        $line['inType'] = isset($_SESSION['user']['sections'][$line['section_id']]) ? $_SESSION['user']['sections'][$line['section_id']]['us_type'] : false;
        $subsql = $pdo->prepare('SELECT * FROM user_sections NATURAL JOIN users WHERE section_id = ? AND us_type = \'manager\'');
        $subsql->bindValue(1, $line['section_id']);
        $subsql->execute();
        $managers = array();
        while ($subline = $subsql->fetch())
            $managers[] = $subline;
        $line['managers'] = $managers;
        $tpl->append('sections', $line);
    }

    $tpl->display('section_index.tpl');
    quit();
}

/**
 * Ajoute une section
 */
function section_add() {
    global $pdo, $tpl;

    $tpl->assign('error', false);
    $tpl->assign('succes', false);

    if (isset($_POST['section_name'])) {
        if (autoInsert('sections', 'section_', array(
                    'section_owner' => $_SESSION['user']['user_id'],
                ))) {
            $tpl->assign('succes', true);
        } else
            $tpl->assign('error', $pdo->errorInfo());
    }


    $tpl->display('section_add.tpl');
    quit();
}

/**
 * Supprime une section
 */
function section_delete() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM sections WHERE section_id = ?');
    $sql->bindValue(1, $_GET['section']);
    if ($sql->execute())
        redirect('section');
    else
        modexec('syscore', 'sqlerror');
}

/**
 * Affiche les détails d'une section
 * Les détails d'une section c'est aussi la liste des membres de la section avec la gestion des membres.
 * NB: C'est aussi d'ici qu'on créer un événement.
 */
function section_details() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM sections LEFT JOIN users ON user_id = section_owner WHERE section_id = ?');
    $sql->bindValue(1, $_REQUEST['section']);
    $sql->execute();
    $section = $sql->fetch();
    $section['inType'] = isset($_SESSION['user']['sections'][$section['section_id']]) ? $_SESSION['user']['sections'][$section['section_id']]['us_type'] : false;
    $tpl->assign('section', $section);
    $tpl->assign('managers', array());
    $tpl->assign('users', array());
    $tpl->assign('guests', array());


    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="manager"');
    $sql->bindValue(1, $section['section_id']);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('managers', $line);

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="user"');
    $sql->bindValue(1, $section['section_id']);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('users', $line);

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="guest"');
    $sql->bindValue(1, $section['section_id']);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('guests', $line);

    $tpl->display('section_details.tpl');
    quit();
}

/**
 * Je veux rentrer dans la section
 * Ce controleur permet à l'utilisateur actuellement connecter de faire une demande d'adhésion à une section.
 */
function section_goin() {
    global $pdo;

    $sql = $pdo->prepare('INSERT INTO user_sections (us_user, us_section, us_type) VALUES (?, ?, "guest")');
    $sql->bindValue(1, $_SESSION['user']['user_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section');
}

/**
 * Je ne veux plus de cette section
 * Cette fonction permet à l'utilisateur connecté de quitter la section.
 */
function section_goout() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM user_sections WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_SESSION['user']['user_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section');
}

/**
 * Ho Oui ! Un staff
 * Permet d'accepter un membre dans sa section.
 * @global type $pdo
 */
function section_accept() {
    global $pdo;

    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "user" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

/**
 * Bye le membre ...
 * Permet de retirer un membre d'une section.
 * @global type $pdo
 */
function section_reject() {
    global $pdo;

    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "rejected" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

/**
 * Promotion manager
 * Et hop ! Un staff devient responsable de la section.
 * @global type $pdo
 */
function section_manager() {
    global $pdo;

    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "manager" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

function section_edit() {
    global $tpl;

    $mdl = new Modele('sections');
    $mdl->fetch($_GET['section']);
    if (isset($_POST['postOK'])) {
        $tpl->assign('hsuccess', $mdl->modFrom($_POST));
    }
    $tpl->assign('section', $mdl);

    display();
}
