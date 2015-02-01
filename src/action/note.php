<?php

function note_index() {
    global $tpl;

    $mdl = new Modele('periods');
    $mdl->find(array('period_type' => isset($_REQUEST['type']) ? $_REQUEST['type'] : $_SESSION['user']['user_type']));
    while ($mdl->next()) {
        $tpl->append('periods', new Modele($mdl));
    }

    $types = new Modele('user_types');
    $types->find();
    while ($types->next()) {
        $tpl->append('types', new Modele($types));
    }


    display();
}

function note_viewp() {
    global $tpl;

    $period = new Modele('periods');
    $period->fetch($_REQUEST['period']);
    $tpl->assign('period', $period);

    $mdl = new Modele('marks');
    $mdl->find(array(
        'mark_user' => $_SESSION['user']['user_id'],
        'mark_period' => $period->getKey(),
    ));
    while ($mdl->next()) {
        $tpl->append('marks', new Modele($mdl));
    }

    display();
}
