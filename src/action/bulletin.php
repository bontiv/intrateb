<?php

function bulletin_index() {
    global $pdo, $tpl;

    $qry = 'SELECT * FROM bulletin_user LEFT JOIN periods ON bu_period = period_id WHERE bu_user = ? and period_state != "ACTIVE"';
    $sql = $pdo->prepare($qry);
    $sql->bindValue(1, $_SESSION['user']['user_id']);
    $sql->execute();

    while ($line = $sql->fetch()) {
        $tpl->append('bulletins', $line);
    }

    display();
}

function bulletin_viewbulletin() {
    global $pdo, $root;

    $mdl = new Modele("bulletin_user");
    $mdl->fetch($_GET['id']);

    require $root . 'libs' . DS . 'bulletins' . DS . $mdl->bu_period->period_generator . DS . 'bulletin.php';

    bulletin_view_user($_GET['id']);
    quit();
}
