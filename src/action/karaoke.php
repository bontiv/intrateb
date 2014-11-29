<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function karaoke_list() {
    $ch = curl_init('http://zanark.net/demandes/ajax.php?loadTasks&list=1&compl=1&sort=1');
}

function karaoke_play() {
    global $tpl;
    
    $ch = curl_init('http://www.zanark.net/karaoke/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ans = curl_exec($ch);
    $matches = array();
    if (preg_match_all('`\n *([^-]*[^ -]) *- *([^-]*[^ -]) *- *([^-]*[^ -]) *- *([^-]*[^ -]) *(✓?)<br ?/>\n`', $ans, $matches, PREG_SET_ORDER))
    {
        foreach ($matches as &$occ) {
            $def = array_keys(array('', '✓'), $occ[5]);
            if (!isset($def[0])) {
                $occ['status'] = -1;
            } else {
                $occ['status'] = $def[0];
            }
        }
    }
    $tpl->assign('karaoke', $matches);
    display();
}