<?php

/**
 * Gestion des événements
 * Ce controleur permet de gérer les différents événements.
 * @package Epicenote
 */


/**
 * Liste les événements
 * Permet de lister tous les événements enregistrés sur l'intra.
 */
function event_index()
{
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
function event_staff () {
    global $tpl, $pdo;
    
    $sql = $pdo->prepare('SELECT * FROM events LEFT JOIN users ON event_owner = user_id LEFT JOIN sections ON section_id = event_section WHERE event_id = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->execute();
    
    $event = $sql->fetch();
    if (!$event)
        modexec ('syscore', 'notfound');
    $tpl->assign('event', $event);

    $sql = $pdo->prepare('SELECT * FROM event_sections LEFT JOIN sections ON es_section = section_id LEFT JOIN users ON section_owner = user_id WHERE es_event = ? AND es_section = ?');
    $sql->bindValue(1, $event['event_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    $es = array();
    $section = $sql->fetch();
    if (!$section)
        modexec ('syscore', 'notfound');
    
    if (isset($_SESSION['user'])) {
        $sql = $pdo->prepare('SELECT COUNT(*) FROM event_staff WHERE est_user = ? AND est_section = ? AND est_event = ?');
        $sql->bindValue(1, $_SESSION['user']['user_id']);
        $sql->bindValue(2, $section['section_id']);
        $sql->bindValue(3, $event['event_id']);
        $sql->execute();
        $dat = $sql->fetch();
        $section['inType'] = $dat[0] == 0;
    }
    else
        $section['inType'] = false;
    
    $tpl->assign('section', $section);
    
    $sql = $pdo->prepare('SELECT * FROM event_staff LEFT JOIN users ON est_user = user_id LEFT JOIN user_sections ON us_user = user_id AND us_section = est_section WHERE est_event = ? AND est_section = ?');
    $sql->bindValue(1, $event['event_id']);
    $sql->bindValue(2, $section['section_id']);
    $sql->execute();
    $users = [];
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
        modexec ('syscore', 'notfound');
    
    $sql = $pdo->prepare('SELECT * FROM event_sections LEFT JOIN sections ON es_section = section_id WHERE es_event = ?');
    $sql->bindValue(1, $event['event_id']);
    $sql->execute();
    $es = array();
    while ($line = $sql->fetch())
        $es[$line['section_id']] = $line;
    $tpl->assign('es', $es);
    
    $sql = $pdo->prepare('SELECT * FROM sections');
    $sql->execute();
    while ($line = $sql->fetch())
        if (!in_array($line['section_id'], array_keys ($es)))
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

