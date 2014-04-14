<?php

/**
 * Controleurs de la gestion des écoles
 * Ce controleur permet de gérer les différentes écoles du groupe IONIS
 * @package Epicenote
 */


/**
 * Affiche la liste des écoles
 * Permet d'afficher une page avec la liste des écoles (page par défaut du module).
 */
function ecole_index()
{
    global $pdo, $tpl;
    
    $pager = new SimplePager('user_types');
    $pager->run($tpl);
    $tpl->display('ecole_index.tpl');
    quit();
}


/**
 * Ajout d'une école
 * Controleur utilisé pour ajouter une nouvelle école.
 */
function ecole_add()
{
    global $pdo, $tpl;
    
    $tpl->assign('error', false);
    $tpl->assign('succes', false);
    
    if (isset($_POST['ut_name']))
    {
        if (autoInsert('user_types', 'ut_'))
        {
            $tpl->assign('succes', true);
        }
        else
            $tpl->assign('error', true);
    }
    
    $tpl->display('ecole_add.tpl');
    quit();
}


/**
 * Supression d'une école
 * Controleur utilisé pour supprimer une école.
 */
function ecole_delete()
{
    global $pdo;
    
    $sql = $pdo->prepare('DELETE FROM user_types WHERE ut_id = ?');
    $sql->bindValue(1, $_GET['ecole']);
    if ($sql->execute())
        redirect('ecole');
    else
        modexec ('syscore', 'sqlerror');
}