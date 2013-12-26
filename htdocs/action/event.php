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
    
    $tpl->assign('event', $event);
    $tpl->display('event_view.tpl');
    quit();
}