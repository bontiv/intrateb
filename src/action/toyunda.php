<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function toyunda_index() {
    global $config, $tpl;

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
    global $tpl, $config;

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

            $ci = curl_init($config['Zanark']['todolist'] . 'ajax.php?newTask');
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

    //Récupération des langues
    $lngs = new Modele('toyunda_langs');
    $lngs->find();
    $lngs->appendTemplate('langs');

    //Récupération des types
    $typs = new Modele('toyunda_types');
    $typs->find();
    $typs->appendTemplate('types');

    //Récupération des types
    $sttr = new Modele('toyunda_transition');
    $sttr->find();
    $sttr->appendTemplate('trans');


    display();
}

function toyunda_admstatus() {
    $mdl = new Modele('toyunda_status');
    $mdl->find();
    $mdl->appendTemplate('status');
    display();
}

function toyunda_admaddstatus() {
    global $tpl;

    $mdl = new Modele('toyunda_status');
    $tpl->assign('form', $mdl->edit());

    if (isset($_POST['ts_name'])) {
        if ($mdl->addFrom($_POST)) {
            redirect("toyunda", "admstatus", array('hsuccess' => 1));
        }
        $tpl->assign('hsuccess', false);
    }

    display();
}

function toyunda_admdelstatus() {
    $mdl = new Modele('toyunda_status');
    $mdl->fetch($_GET['id']);
    $mdl->delete();
    redirect("toyunda", "admstatus", array('hsuccess' => 1));
}

function toyunda_admtypes() {
    $mdl = new Modele('toyunda_types');
    $mdl->find();
    $mdl->appendTemplate('types');
    display();
}

function toyunda_admaddtype() {
    global $tpl;

    $mdl = new Modele('toyunda_types');
    $tpl->assign('form', $mdl->edit());

    if (isset($_POST['tt_name'])) {
        if ($mdl->addFrom($_POST)) {
            redirect("toyunda", "admtypes", array('hsuccess' => 1));
        }
        $tpl->assign('hsuccess', false);
    }

    display();
}

function toyunda_admdeltype() {
    $mdl = new Modele('toyunda_types');
    $mdl->fetch($_GET['id']);
    $mdl->delete();
    redirect("toyunda", "admtypes", array('hsuccess' => 1));
}

function toyunda_admlangs() {
    $mdl = new Modele('toyunda_langs');
    $mdl->find();
    $mdl->appendTemplate('langs');
    display();
}

function toyunda_admaddlang() {
    global $tpl;

    $mdl = new Modele('toyunda_langs');
    $tpl->assign('form', $mdl->edit(array(
                'tl_code', 'tl_name'
    )));

    foreach (scandir('images/flags/png/') as $flag) {
        if ($flag[0] != '.' && is_file('images/flags/png/' . $flag)) {
            $tpl->append('flags', $flag);
        }
    }

    if (isset($_POST['tl_name'])) {
        if ($mdl->addFrom($_POST)) {
            redirect("toyunda", "admlangs", array('hsuccess' => 1));
        }
        $tpl->assign('hsuccess', false);
    }

    display();
}

function toyunda_admdellang() {
    $mdl = new Modele('toyunda_langs');
    $mdl->fetch($_GET['id']);
    $mdl->delete();
    redirect("toyunda", "admlangs", array('hsuccess' => 1));
}

function toyunda_admtrans() {
    $mdl = new Modele('toyunda_transition');
    $mdl->find();
    $mdl->appendTemplate('trans');
    display();
}

function toyunda_admaddtrans() {
    global $tpl;

    $mdl = new Modele('toyunda_transition');
    $tpl->assign('form', $mdl->edit());

    if (isset($_POST['tr_from'])) {
        if ($mdl->addFrom($_POST)) {
            redirect("toyunda", "admtrans", array('hsuccess' => 1));
        }
        $tpl->assign('hsuccess', false);
    }

    display();
}

function toyunda_admdeltrans() {
    $mdl = new Modele('toyunda_transition');
    $mdl->fetch($_GET['id']);
    $mdl->delete();
    redirect("toyunda", "admtrans", array('hsuccess' => 1));
}
