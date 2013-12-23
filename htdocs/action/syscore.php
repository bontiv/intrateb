<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function syscore_autoload($page)
{
    global $tpl;
    
    switch ($page)
    {
        case 'forbidden':
            $tpl->assign('msg', 'Vous n\'avez pas le niveau d\'accès nécessaire pour cette action.');
            break;
        case 'nomod':
            $tpl->assign('msg', 'Module introuvable.');
            break;
        case 'moderror':
            $tpl->assign('msg', 'Le module n\'a pas terminé correctement.');
            break;
        case 'nopage':
            $tpl->assign('msg', 'Le module n\'a pas executer cette page.');
            break;
        default:
            $tpl->assign('msg', 'Erreur inconnu : ' . $page);
            break;
    }
    $tpl->display('syscore_error.tpl');
    quit();
}
?>
