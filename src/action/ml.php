<?php

global $srcdir;
require_once $srcdir . '/libs/GoogleApi.php';

function ml_index() {
    global $tpl, $pdo, $config;

    $api = new GoogleApi();
    $rlst = $api->getGroupsList();

    $sql = $pdo->query('SELECT * FROM sections WHERE section_ml != ""');
    $sections = array();
    while ($s = $sql->fetch()) {
        $sections[$s['section_ml']] = $s;
    }

    $sql = $pdo->query('SELECT * FROM section_ml LEFT JOIN sections ON section_id = sm_section');
    $managed = array();
    while ($m = $sql->fetch()) {
        $managed[$m['sm_ml']][] = $m;
    }

    foreach ($rlst->groups as $group) {
        $tpl->append('groups', array(
            'obj' => $group,
            'isSection' => isset($sections[$group->email]) ? $sections[$group->email] : false,
            'isMembersList' => $group->email == $config['GoogleApps']['members_ml'],
            'isManaged' => isset($managed[$group->id]) ? $managed[$group->id] : false,
        ));
    }
    display();
}

function ml_view() {
    global $tpl, $pdo;

    $api = new GoogleApi();
    $details = $api->getGroupsDetails($_GET['ml']);
    $tpl->assign('group', $details);

    $members = $api->getGroupMembers($_GET['ml']);
    $usql = $pdo->prepare('SELECT * FROM users WHERE user_email = ?');
    foreach ($members->members as $member) {
        $usql->bindValue(1, $member->email);
        $usql->execute();
        $user = $usql->fetch();

        $tpl->append('members', array(
            'obj' => $member,
            'user' => $user,
            'isSave' => strpos($member->email, 'save_') === 0,
        ));
    }

    $mls = new Modele('section_ml');
    $mls->find(array('sm_ml' => $details->id));
    $ids = array();
    while ($mls->next()) {
        $tpl->append('mls', new Modele($mls));
        $ids[] = $mls->raw_sm_section;
    }

    $sec = new Modele('sections');
    $sec->find();
    while ($sec->next()) {
        if (!in_array($sec->section_id, $ids)) {
            $tpl->append('sections', new Modele($sec));
        }
    }

    display();
}

function ml_addMember() {
    global $tpl;

    $api = new GoogleApi();

    $msg = $api->addGroupMember($_GET['ml'], $_POST['email']);

    if (isset($msg->error)) {
        $tpl->assign('msg', $msg->error->message);
        $tpl->display('syscore_error.tpl');
        quit();
    } else {
        redirect("ml", "view", array("ml" => $_GET['ml'], 'hsuccess' => 1));
    }
}

function ml_delMember() {
    $api = new GoogleApi();

    $msg = $api->delGroupMember($_GET['ml'], $_GET['member']);
    redirect("ml", "view", array("ml" => $_GET['ml'], 'hsuccess' => 1));
}

function ml_autoUpdate() {
    global $tpl;

    $section = new Modele('sections');
    $section->find('section_ml != ""');
    $api = new GoogleApi();
    $toAdd = array();
    $toDelete = array();
    $sections = array();

    while ($section->next()) {
        $toAdd[$section->getKey()] = array();
        $toDelete[$section->getKey()] = array();
        $sections[$section->getKey()] = $section->toArray();

        $Lmembers = new Modele('user_sections');
        $Lmembers->find(array(
            'us_section' => $section->getKey(),
            'us_type' => 'manager',
        ));

        while ($Lmembers->next()) {
            $toAdd[$section->getKey()][] = strtolower($Lmembers->us_user->user_email);
        }

        $reelMembers = $api->getGroupMembers($section->section_ml);
        foreach ($reelMembers->members as $member) {
            $key = array_keys($toAdd[$section->getKey()], strtolower($member->email));
            if (strpos($member->email, 'save_') !== 0) { //Skip sauvegarde
                if ($member->type == "GROUP") {
                    continue;
                } elseif (count($key) == 0) {
                    $toDelete[$section->getKey()][] = strtolower($member->email);
                } else {
                    unset($toAdd[$section->getKey()][$key[0]]);
                }
            }
        }
    }

    $tpl->assign('sections', $sections);
    $tpl->assign('toDelete', $toDelete);
    $tpl->assign('toAdd', $toAdd);
    display();
}

function ml_execUpdate() {
    $section = new Modele('sections');
    $section->find('section_ml != ""');
    $api = new GoogleApi();

    while ($section->next()) {
        $toAdd = array();
        $toDelete = array();

        $Lmembers = new Modele('user_sections');
        $Lmembers->find(array(
            'us_section' => $section->getKey(),
            'us_type' => 'manager',
        ));

        while ($Lmembers->next()) {
            $toAdd[] = strtolower($Lmembers->us_user->user_email);
        }

        $reelMembers = $api->getGroupMembers($section->section_ml);
        if (isset($reelMembers->members)) {
            foreach ($reelMembers->members as $member) {
                $key = array_keys($toAdd, strtolower($member->email));
                if (strpos($member->email, 'save_') !== 0) { //Skip sauvegarde
                    if ($member->type == "GROUP") {
                        continue;
                    } elseif (count($key) == 0) {
                        $toDelete[] = strtolower($member->email);
                    } else {
                        unset($toAdd[$key[0]]);
                    }
                }
            }
        }

        foreach ($toAdd as $mail) {
            $api->addGroupMember($section->section_ml, $mail);
        }

        foreach ($toDelete as $mail) {
            $api->delGroupMember($section->section_ml, $mail);
        }
    }

    redirect('ml', 'autoUpdate');
}

function ml_manageSection() {
    $mdl = new Modele('section_ml');
    $suc = $mdl->addFrom(array(
        'sm_section' => $_REQUEST['section'],
        'sm_ml' => $_REQUEST['ml'],
    ));

    redirect("ml", "view", array('hsuccess' => $suc ? 1 : 0, 'ml' => $_REQUEST['ml']));
}

function ml_removeSection() {
    $mdl = new Modele('section_ml');
    $mdl->fetch($_REQUEST['lnk']);
    $ml = $mdl->sm_ml;
    $suc = $mdl->delete();

    redirect("ml", "view", array('ml' => $ml));
}
