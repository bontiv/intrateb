<?php

/**
 * Controleur sur la gestion des sections
 * Ce controleur contient toutes les pages utilisés pour gérer les sections.
 * @package Epicenote
 */

/**
 * Défini le mode superuser
 */
function section_security($page, $params) {
    $mdl = new Modele('user_sections');

    if (!$_SESSION['user'] || !isset($params['section']))
        return false;

    $mdl->find(array(
        'us_user' => $_SESSION['user']['user_id'],
        'us_section' => $params['section'],
        'us_type' => 'manager'
    ));
    if ($mdl->count()) {
        return ACL_SUPERUSER;
    }
    return false;
}

/**
 * Permet de créer un événement
 * Ce controleur permet de créer un événement à partir d'une section. On y accède à partir de la fiche de la section qui va gérer le déroulement de l'événement.
 */
function section_mkevent() {
    global $pdo, $tpl;

    $tpl->assign('error', false);
    $tpl->assign('succes', false);
    $tpl->assign('section', $_GET['section']);

    if (isset($_POST['event_name'])) {
        $dateStart = new DateTime($_POST['event_start']);
        $dateEnd = new DateTime($_POST['event_end']);
        $sevenDays = new DateInterval('P7D');
        $dateLock = new DateTime($dateStart->format('Y-m-d H:i:s'));
        $dateLock->sub($sevenDays);
        $dateNote1 = new DateTime($dateEnd->format('Y-m-d H:i:s'));
        $dateNote1->add($sevenDays);
        $dateNote2 = new DateTime($dateNote1->format('Y-m-d H:i:s'));
        $dateNote2->add($sevenDays);

        $extra = array(
            'event_start' => $dateStart->format('Y-m-d H:i:s'),
            'event_end' => $dateEnd->format('Y-m-d H:i:s'),
            'event_lock' => $dateLock->format('Y-m-d H:i:s'),
            'event_note1' => $dateNote1->format('Y-m-d H:i:s'),
            'event_note2' => $dateNote2->format('Y-m-d H:i:s'),
            'event_coef' => 1,
            'event_section' => $_GET['section'],
            'event_owner' => $_SESSION['user']['user_id'],
        );

        if (autoInsert('events', 'event_', $extra))
            $tpl->assign('succes', true);
        else
            $tpl->assign('error', true);
    }

    $tpl->display('section_mkevent.tpl');
    quit();
}

/**
 * Liste toutes les sections
 */
function section_index() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM sections LEFT JOIN users ON user_id = section_owner ORDER BY section_name');
    $sql->execute();
    while ($line = $sql->fetch()) {

        $line['inType'] = isset($_SESSION['user']['sections'][$line['section_id']]) ? $_SESSION['user']['sections'][$line['section_id']]['us_type'] : false;
        $subsql = $pdo->prepare('SELECT * FROM user_sections NATURAL JOIN users WHERE section_id = ? AND us_type = \'manager\'');
        $subsql->bindValue(1, $line['section_id']);
        $subsql->execute();
        $managers = array();
        while ($subline = $subsql->fetch())
            $managers[] = $subline;
        $line['managers'] = $managers;
        $tpl->append('sections', $line);
    }

    $tpl->display('section_index.tpl');
    quit();
}

/**
 * Ajoute une section
 */
function section_add() {
    global $pdo, $tpl;

    $tpl->assign('error', false);
    $tpl->assign('succes', false);

    if (isset($_POST['section_name'])) {
        if (autoInsert('sections', 'section_', array(
                    'section_owner' => $_SESSION['user']['user_id'],
                ))) {
            $tpl->assign('succes', true);
        } else
            $tpl->assign('error', $pdo->errorInfo());
    }


    $tpl->display('section_add.tpl');
    quit();
}

/**
 * Supprime une section
 */
function section_delete() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM sections WHERE section_id = ?');
    $sql->bindValue(1, $_GET['section']);
    if ($sql->execute())
        redirect('section');
    else
        modexec('syscore', 'sqlerror');
}

/**
 * Affiche les détails d'une section
 * Les détails d'une section c'est aussi la liste des membres de la section avec la gestion des membres.
 * NB: C'est aussi d'ici qu'on créer un événement.
 */
function section_details() {
    global $pdo, $tpl;

    $tpl->assign('managers', array());
    $tpl->assign('users', array());
    $tpl->assign('guests', array());

    $section = new Modele('sections');
    $section->fetch($_REQUEST['section']);
    $tpl->assign('section', $section);


    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="manager"');
    $sql->bindValue(1, $section->section_id);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('managers', $line);

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="user"');
    $sql->bindValue(1, $section->section_id);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('users', $line);

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="guest"');
    $sql->bindValue(1, $section->section_id);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('guests', $line);

    $tpl->display('section_details.tpl');
    quit();
}

/**
 * Je veux rentrer dans la section
 * Ce controleur permet à l'utilisateur actuellement connecter de faire une demande d'adhésion à une section.
 */
function section_goin() {
    global $pdo;

    $sql = $pdo->prepare('INSERT INTO user_sections (us_user, us_section, us_type) VALUES (?, ?, "guest")');
    $sql->bindValue(1, $_SESSION['user']['user_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section');
}

/**
 * Je ne veux plus de cette section
 * Cette fonction permet à l'utilisateur connecté de quitter la section.
 */
function section_goout() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM user_sections WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_SESSION['user']['user_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section');
}

/**
 * Ho Oui ! Un staff
 * Permet d'accepter un membre dans sa section.
 * @global type $pdo
 */
function section_accept() {
    global $pdo;

    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "user" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

/**
 * Bye le membre ...
 * Permet de retirer un membre d'une section.
 * @global type $pdo
 */
function section_reject() {
    global $pdo;

    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "rejected" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

/**
 * Promotion manager
 * Et hop ! Un staff devient responsable de la section.
 * @global type $pdo
 */
function section_manager() {
    global $pdo;

    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "manager" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

function section_edit() {
    global $tpl;

    $mdl = new Modele('sections');
    $mdl->fetch($_GET['section']);
    if (isset($_POST['postOK'])) {
        $tpl->assign('hsuccess', $mdl->modFrom($_POST));
    }
    $tpl->assign('section', $mdl);

    display();
}

function section_addpoints() {
    global $tpl, $pdo;

    $section = new Modele('sections');
    $section->fetch($_REQUEST['section']);
    $tpl->assign('section', $section);

    $queryFields = array(
        'part_duration',
        'part_title',
        'part_justification'
    );

    $mdl = new Modele('participations');
    $tpl->assign('form', $mdl->edit($queryFields));

    if (isset($_POST['edit'])) {
        $data = array(
            'part_section' => $section->section_id,
            'part_attribution_date' => date('Y-m-d'),
            'part_status' => 'SUBMITTED',
        );

        foreach ($queryFields as $field) {
            $data[$field] = $_POST[$field];
        }

        if (!$mdl->addFrom($data))
            redirect('section', 'details', array('section' => $section->section_id, 'hsuccess' => '0'));
        $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? ORDER BY user_name');
        $sql->bindValue(1, $section->section_id);
        $sql->execute();

        $mdlMark = new Modele('marks');
        $dataMark = array(
            'mark_participation' => $mdl->getKey(),
        );

        while ($user = $sql->fetch()) {
            if (in_array($user['user_id'], $_POST['staffs'])) {
                $dataMark['mark_user'] = $user['user_id'];
                $dataMark['mark_period'] = $_POST['type-' . $user['user_type']];
                $mdlMark->addFrom($dataMark);
            }
        }
        redirect('section', 'details', array('section' => $section->section_id, 'hsuccess' => '1'));
    }

    $types = new Modele('user_types');
    $types->find();
    while ($type = $types->next()) {
        $periods = $pdo->prepare('SELECT * FROM periods WHERE period_start < NOW() AND period_end > NOW() AND period_type = ? AND period_state = "ACTIVE"');
        $periods->bindValue(1, $types->ut_id);
        $periods->execute();

        $repPeriods = array();
        while ($period = $periods->fetch()) {
            $repPeriods[] = $period;
        }

        $tpl->append('types', array(
            'id' => $types->ut_id,
            'name' => $types->ut_name,
            'periods' => $repPeriods,
        ));
    }

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? ORDER BY user_name');
    $sql->bindValue(1, $section->section_id);
    $sql->execute();

    while ($user = $sql->fetch()) {
        $tpl->append('staffs', $user);
    }

    display();
}

function section_activities() {
    global $tpl;

    $section = new Modele('sections');
    $section->fetch($_REQUEST['section']);
    $tpl->assign('section', $section);

    $activites = new Modele('participations');
    $activites->find(array('part_section' => $section->section_id));
    while ($activites->next()) {
        $tpl->append('activities', new Modele($activites));
    }

    display();
}

function section_events() {
    global $tpl;

    $section = new Modele('sections');
    $section->fetch($_REQUEST['section']);
    $tpl->assign('section', $section);

    $events = new Modele('events');
    $events->find(array('event_section' => $section->section_id));
    while ($events->next()) {
        $tpl->append('events', new Modele($events));
    }

    display();
}

function section_viewactivity() {
    $section = new Modele('sections');
    $section->fetch($_REQUEST['section']);
    $section->assignTemplate('section');

    $mdl = new Modele('participations');
    $mdl->fetch($_REQUEST['activity']);
    if ($mdl->raw_part_section == $_REQUEST['section']) {
        $mdl->assignTemplate('part');
    } else {
        redirect('index');
    }
    display();
}

function section_mls() {
    global $tpl, $srcdir;

    include $srcdir . '/libs/GoogleApi.php';

    $api = new GoogleApi();

    $mdl = new Modele('sections');
    $mdl->fetch($_REQUEST['section']);
    $mdl->assignTemplate('section');

    if ($mdl->section_ml) {
        $grp = $api->getGroupsDetails($mdl->section_ml);
        $tpl->append('groups', array(
            'obj' => $grp,
            'isSection' => true,
        ));
    }

    $lnk = new Modele('section_ml');
    $lnk->find(array('sm_section' => $mdl->section_id));
    while ($lnk->next()) {
        $grp = $api->getGroupsDetails($lnk->sm_ml);
        $tpl->append('groups', array(
            'obj' => $grp,
            'isSection' => false,
        ));
    }

    display();
}

function section_admin_ml() {
    global $tpl, $srcdir, $pdo;

    include $srcdir . '/libs/GoogleApi.php';

    $api = new GoogleApi();

    $mdl = new Modele('sections');
    $mdl->fetch($_REQUEST['section']);
    $mdl->assignTemplate('section');

    $lnk = new Modele('section_ml');
    $lnk->find(array(
        'sm_section' => $_REQUEST['section'],
        'sm_ml' => $_REQUEST['ml'],
    ));
    if (!$lnk->next()) {
        modexec('syscore', 'forbidden');
    }

    $grp = $api->getGroupsDetails($lnk->sm_ml);
    $tpl->assign('group', $grp);

    $members = $api->getGroupMembers($grp->id);
    $usql = $pdo->prepare('SELECT * FROM users WHERE user_email = ?');

    foreach ($members->members as $member) {
        $usql->bindValue(1, $member->email);
        $usql->execute();
        $user = $usql->fetch();

        $tpl->append('members', array(
            'isSave' => strpos($member->email, 'save_') === 0,
            'user' => $user,
            'obj' => $member,
        ));
    }

    display();
}

function section_admin_ml_add() {
    global $tpl, $srcdir, $pdo;

    include $srcdir . '/libs/GoogleApi.php';

    $api = new GoogleApi();

    $mdl = new Modele('sections');
    $mdl->fetch($_REQUEST['section']);
    $mdl->assignTemplate('section');

    $lnk = new Modele('section_ml');
    $lnk->find(array(
        'sm_section' => $_REQUEST['section'],
        'sm_ml' => $_REQUEST['ml'],
    ));
    if (!$lnk->next()) {
        modexec('syscore', 'forbidden');
    }

    $api->addGroupMember($lnk->sm_ml, $_REQUEST['email']);

    redirect("section", "admin_ml", array(
        "hsuccess" => 1,
        "section" => $_REQUEST['section'],
        "ml" => $lnk->sm_ml,
    ));
}

function section_admin_ml_del() {
    global $tpl, $srcdir, $pdo;

    include $srcdir . '/libs/GoogleApi.php';

    $api = new GoogleApi();

    $mdl = new Modele('sections');
    $mdl->fetch($_REQUEST['section']);
    $mdl->assignTemplate('section');

    $lnk = new Modele('section_ml');
    $lnk->find(array(
        'sm_section' => $_REQUEST['section'],
        'sm_ml' => $_REQUEST['ml'],
    ));
    $mbr = $api->getGroupMemberDetails($_REQUEST['ml'], $_REQUEST['member']);
    if (!$lnk->next() || strpos($_REQUEST['member'], 'save_') === 0 || $mbr->type == "GROUP") {
        modexec('syscore', 'forbidden');
    }

    $api->delGroupMember($lnk->sm_ml, $_REQUEST['member']);

    redirect("section", "admin_ml", array(
        "hsuccess" => 1,
        "section" => $_REQUEST['section'],
        "ml" => $lnk->sm_ml,
    ));
}

function section_admin_ml_setadmin() {
    global $tpl, $srcdir, $pdo;

    include $srcdir . '/libs/GoogleApi.php';

    $api = new GoogleApi();

    $mdl = new Modele('sections');
    $mdl->fetch($_REQUEST['section']);
    $mdl->assignTemplate('section');

    $lnk = new Modele('section_ml');
    $lnk->find(array(
        'sm_section' => $_REQUEST['section'],
        'sm_ml' => $_REQUEST['ml'],
    ));
    $mbr = $api->getGroupMemberDetails($_REQUEST['ml'], $_REQUEST['member']);
    if (!$lnk->next() || strpos($_REQUEST['member'], 'save_') === 0 || $mbr->type == "GROUP") {
        modexec('syscore', 'forbidden');
    }

    $ret = $api->setGroupMemberLevel($lnk->sm_ml, $_REQUEST['member'], 'OWNER');

    redirect("section", "admin_ml", array(
        "hsuccess" => 1,
        "section" => $_REQUEST['section'],
        "ml" => $lnk->sm_ml,
    ));
}

function section_admin_ml_noadmin() {
    global $tpl, $srcdir, $pdo;

    include $srcdir . '/libs/GoogleApi.php';

    $api = new GoogleApi();

    $mdl = new Modele('sections');
    $mdl->fetch($_REQUEST['section']);
    $mdl->assignTemplate('section');

    $lnk = new Modele('section_ml');
    $lnk->find(array(
        'sm_section' => $_REQUEST['section'],
        'sm_ml' => $_REQUEST['ml'],
    ));
    $mbr = $api->getGroupMemberDetails($_REQUEST['ml'], $_REQUEST['member']);
    if (!$lnk->next() || strpos($_REQUEST['member'], 'save_') === 0 || $mbr->type == "GROUP") {
        modexec('syscore', 'forbidden');
    }

    $api->setGroupMemberLevel($lnk->sm_ml, $_REQUEST['member'], 'MEMBER');

    redirect("section", "admin_ml", array(
        "hsuccess" => 1,
        "section" => $_REQUEST['section'],
        "ml" => $lnk->sm_ml,
    ));
}
