<?php

/**
 * Controleurs du module administration
 * Ce module permet la gestion des droits d'accès. Son droit d'accès est forcé à "Admin" par le framework, il ne peut pas être édité lui même.
 * @package Epicenote
 */

/**
 * Controleur page d'index admin
 * Permet l'affichage de la page d'administration des droits d'accès.
 */
function admin_index() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM acces WHERE acl_action != "index" AND acl_action != "admin" ORDER BY acl_action ASC, acl_page ASC');
    $sql->execute();
    $conf = array();
    while ($line = $sql->fetch()) {
        if (!isset($conf[$line['acl_action']]))
            $conf[$line['acl_action']] = array();
        $conf[$line['acl_action']][] = $line;
    }

    $tpl->assign('acls', $conf);
    $tpl->display('admin_index.tpl');
    quit();
}

/**
 * Controleur mise à jour des droits
 * Ce controleur est appelé quand on valide la page avec les droits d'accès. Il permet d'enregistrer les nouveaux droits d'accès.
 */
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
