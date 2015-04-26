<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function toyunda_index() {
    global $config, $tpl;

    $url = "http://www.mytinytodo.net/demo/";

    $ci = curl_init($config['Zanark']['todolist'] . 'ajax.php?loadTasks&list=1&compl=1&sort=0');
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    $list = json_decode(curl_exec($ci), true);

    $tasks = $list['list'];
    foreach ($tasks as &$task) {
        $parts = explode(" - ", $task['title']);
        $occ = array(
            isset($parts[1]) ? $parts[0] : '',
            isset($parts[2]) ? $parts[1] : '',
            isset($parts[3]) ? $parts[2] : '',
            isset($parts[3]) ? $parts[3] : (
                    isset($parts[2]) ? $parts[2] : (isset($parts[1]) ? $parts[1] : $parts[0])
                    ),
        );
        $occ[4] = mb_substr($occ[3], -1, 1, 'UTF-8');
        $occ[3] = trim($occ[3], " ▶✓");
        $task['filltitle'] = $task['title'];
        $task['language'] = $occ[0];
        $task['serie'] = $occ[1];
        $task['version'] = $occ[2];
        $task['title'] = $occ[3];
    }

    $tpl->assign('list', $tasks);
    display();
}

function toyunda_add() {
    global $tpl;

    if (isset($_POST['title'])) {
        if ($_POST['title'] == "") {
            $tpl->assign('errmsg', 'Le titre est obligatoire.');
        } elseif ($_POST['langue'] == "") {
            $tpl->assign('errmsg', 'La langue est obligatoire.');
        } elseif ($_POST['version'] != "" && $_POST['serie'] == "") {
            $tpl->assign('errmsg', 'La version ne peut pas être spécifié sans la série.');
        } else {
            if ($_POST['version'] != '') {
                $str = "$_POST[langue] - $_POST[serie] - $_POST[version] - $_POST[title]";
            } elseif ($_POST['serie']) {
                $str = "$_POST[langue] - $_POST[serie] - $_POST[title]";
            } else {
                $str = "$_POST[langue] - $_POST[title]";
            }

            $url = "http://www.mytinytodo.net/demo/";

            $ci = curl_init($url . 'ajax.php?newTask');
            curl_setopt($ci, CURLOPT_POST, true);
            curl_setopt($ci, CURLOPT_POSTFIELDS, array(
                "list" => "1",
                "tag" => "",
                "title" => $str,
            ));
            if (curl_exec($ci)) {
                redirect('toyunda', 'index', array('hsuccess' => 1));
            } else {
                $tpl->assign('errmsg', 'Erreur de communication.');
            }
        }
    }

    display();
}
