<?php

function ecole_index()
{
    global $pdo, $tpl;
    
    $pager = new SimplePager('user_types');
    $pager->run($tpl);
    $tpl->display('ecole_index.tpl');
    quit();
}

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