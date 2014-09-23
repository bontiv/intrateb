<?php

/**
 * Module de gestion des utilisateurs
 * Ce module permet de gérer son compte d'utilisateur ainsi que les utilisateurs
 * du site.
 * @package Epicenote
 */

/**
 * Permet d'afficher la liste des utilisateurs
 * @global type $pdo
 * @global type $tpl
 */
function user_index() {
    global $pdo, $tpl;

    $pager = new SimplePager('users');
    $pager->run($tpl);
    $tpl->display('user_index.tpl');
    quit();
}

/**
 * Ajoute un utilisateur
 * Des fois c'est bien de pouvoir rajouter un utilisateur depuis le panneau d'admin pour l'ajout des nouveaux adhérents.
 */
function user_add() {
    global $pdo, $tpl;

    $tpl->assign('error', false);
    $tpl->assign('succes', false);

    if (isset($_POST['user_name'])) {
        if (autoInsert('users', 'user_')) {
            $tpl->assign('succes', true);
        } else
            $tpl->assign('error', true);
    }

    $sql = $pdo->prepare('SELECT * FROM user_types');
    $sql->execute();
    while ($type = $sql->fetch()) {
        $tpl->append('types', $type);
    }

    $tpl->display('user_add.tpl');
    quit();
}

/**
 * Suppresion d'un utilisateur
 */
function user_delete() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
    $sql->bindValue(1, $_GET['user']);
    if ($sql->execute())
        redirect('user');
    else
        modexec('syscore', 'sqlerror');
}

/**
 * Détails d'un utilisateur
 * Et optionnellement sa vie.
 */
function user_view() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM users LEFT JOIN user_types ON ut_id = user_type WHERE user_id = ?');
    $sql->bindValue(1, $_REQUEST['user']);
    $sql->execute();
    $user = $sql->fetch();
    $tpl->assign('user', $user);

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN sections ON section_id = us_section WHERE us_user = ?');
    $sql->bindValue(1, $user['user_id']);
    $sql->execute();
    $sections = array();
    while ($line = $sql->fetch()) {
        $sections[] = $line['section_id'];
        $tpl->append('sections', $line);
    }

    $sql = $pdo->prepare('SELECT * FROM sections WHERE section_type = "primary"');
    $sql->execute();
    while ($line = $sql->fetch())
        if (!in_array($line['section_id'], $sections))
            $tpl->append('section_list', $line);

    $tpl->display('user_details.tpl');
    quit();
}

/**
 * Ajoute un utilisateur comme staff d'une section
 * Cette fonctionnalité permet de gérer les sections d'un utilisateur directement depuis son compte :p
 */
function user_invit_section() {
    global $pdo;

    $sql = $pdo->prepare('INSERT INTO user_sections (us_user, us_section, us_type) VALUES (?, ?, "user")');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_POST['us_section']);
    $sql->execute();
    redirect('user', 'view', array('user' => $_GET['user']));
}

/**
 * Permet de quitter une section
 */
function user_quit() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM user_sections WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('user', 'view', array('user' => $_GET['user']));
}

function user_check() {
    global $tpl;

    $mdt = new Modele('mandate');
    $mdt->find();

    $tpl->assign('mandates', array());

    while ($l = $mdt->next()) {
        $tpl->append('mandates', $l);
    }

    display();
}
