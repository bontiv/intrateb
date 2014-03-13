<?php
/**
 * Module système
 * Le module système est un module un peu requis qui va avec FrameTool. Il
 * contient principalement des pages d'erreur et des outils de gestion
 * d'erreurs.
 * @package FrameTool
 */

/**
 * Affichage de page
 * Cette fonction autoload (qui attrappe plusieurs pages) permet d'afficher
 * des pages d'erreur type des erreurs les plus souvent rencontré dans le
 * fonctionnement de FrameTool.
 * @global type $tpl
 * @param type $page
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
