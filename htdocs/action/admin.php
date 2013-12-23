<?php

function admin_index() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM acces WHERE acl_action != "index" AND acl_action != "admin"');
    $sql->execute();
    while ($line = $sql->fetch()) {
        $tpl->append('acls', $line);
    }

    $tpl->display('admin_index.tpl');
    quit();
}

function admin_update() {
    global $pdo;

    $sql = $pdo->prepare('SELECT * FROM acces');
    $sql->execute();
    while ($line = $sql->fetch()) {
        if (isset($_POST['acl' . $line['acl_id']])) {
            $update = $pdo->prepare('UPDATE acces SET acl_acces = ? WHERE acl_id = ?');
            $update->bindValue(1, $_POST['acl' . $line['acl_id']]);
            $update->bindValue(2, $line['acl_id']);
            $update->execute();
        }
    }

    redirect('admin');
}