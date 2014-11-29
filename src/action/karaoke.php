<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function karaoke_play() {
    global $tpl, $config;

    $ch = curl_init($config['Zanark']['playlist']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ans = strip_tags(curl_exec($ch));
    $matches = array();

    foreach (explode("\n", $ans) as $line) {
        $parts = explode(" - ", $line);
        if (count($parts) > 2) {
            $occ = array(
                $parts[0],
                $parts[1],
                isset($parts[3]) ? $parts[2] : "",
                isset($parts[3]) ? $parts[3] : $parts[2],
            );
            $occ[4] = mb_substr($occ[3], -1, 1, 'UTF-8');
            $def = array_keys(array('', '✓', '▶'), $occ[4]);
            if (!isset($def[0])) {
                $occ['status'] = 0;
            } else {
                $occ['status'] = $def[0];
            }
            $occ[3] = trim($occ[3], " ▶✓");
            $matches[] = $occ;
        }
    }
    $tpl->assign('karaoke', $matches);
    display();
}
