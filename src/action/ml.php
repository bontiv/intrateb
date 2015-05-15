<?php

global $srcdir;
require_once $srcdir . '/libs/GoogleApi.php';

function ml_index() {
    global $tpl, $pdo, $config;

    $api = new GoogleApi();
    $rlst = $api->getGroupsList();

    $sql = $pdo->query('SELECT section_ml FROM sections WHERE section_ml != ""');
    $sections = array();
    while ($s = $sql->fetch()) {
        $sections[] = $s[0];
    }

    foreach ($rlst->groups as $group) {
        $tpl->append('groups', array(
            'obj' => $group,
            'isSection' => in_array($group->email, $sections),
            'isMembersList' => $group->email == $config['GoogleApps']['members_ml'],
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
            $toAdd[$section->getKey()][] = $Lmembers->us_user->user_email;
        }

        $reelMembers = $api->getGroupMembers($section->section_ml);
        foreach ($reelMembers->members as $member) {
            $key = array_keys($toAdd[$section->getKey()], $member->email);
            if (strpos($member->email, 'save_') !== 0) { //Skip sauvegarde
                if ($member->type == "GROUP") {
                    continue;
                } elseif (count($key) == 0) {
                    $toDelete[$section->getKey()][] = $member->email;
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
            $toAdd[] = $Lmembers->us_user->user_email;
        }

        $reelMembers = $api->getGroupMembers($section->section_ml);
        foreach ($reelMembers->members as $member) {
            $key = array_keys($toAdd, $member->email);
            if (strpos($member->email, 'save_') !== 0) { //Skip sauvegarde
                if ($member->type == "GROUP") {
                    continue;
                } elseif (count($key) == 0) {
                    $toDelete[] = $member->email;
                } else {
                    unset($toAdd[$key[0]]);
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
