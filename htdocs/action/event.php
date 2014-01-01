<?php

function event_index()
{
    global $tpl;
    
    $p = new SimplePager('events');
    $p->run($tpl);
    
    $tpl->display('event_index.tpl');
    quit();
}

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

function event_addsection() {
    global $pdo;
    
    $sql = $pdo->prepare('INSERT INTO event_sections (es_event, es_section) VALUES (?, ?)');
    $sql->bindValue(1, $_GET['event']);
    $sql->bindValue(2, $_POST['es_section']);
    $sql->execute();
    
    redirect('event', 'view', array('event' => $_GET['event']));
}

function event_delsection() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM event_sections WHERE es_event = ? AND es_section = ?');
    $sql->bindValue(1, $_GET['event']);
    $sql->bindValue(2, $_GET['admsec']);
    $sql->execute();
    
    redirect('event', 'view', array('event' => $_GET['event']));
}

function event_staff() {
    global $pdo, $tpl;
    
    
}