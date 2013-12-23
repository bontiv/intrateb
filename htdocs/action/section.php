<?php

function section_mkevent() {
    global $pdo, $tpl;
    
    $tpl->display('section_mkevent.tpl');
    quit();
}

function section_index() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM sections LEFT JOIN users ON user_id = section_owner');
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

function section_add() {
    global $pdo, $tpl;

    $tpl->assign('error', false);
    $tpl->assign('succes', false);

    if (isset($_POST['section_name'])) {
        if (autoInsert('sections', 'section_', array(
                    'section_owner' => $_SESSION['user']['user_id'],
                ))) {
            $tpl->assign('succes', true);
        }
        else
            $tpl->assign('error', $pdo->errorInfo());
    }


    $tpl->display('section_add.tpl');
    quit();
}

function section_delete() {
    global $pdo;

    $sql = $pdo->prepare('DELETE FROM sections WHERE section_id = ?');
    $sql->bindValue(1, $_GET['section']);
    if ($sql->execute())
        redirect('section');
    else
        modexec('syscore', 'sqlerror');
}

function section_details() {
    global $pdo, $tpl;

    $sql = $pdo->prepare('SELECT * FROM sections LEFT JOIN users ON user_id = section_owner WHERE section_id = ?');
    $sql->bindValue(1, $_REQUEST['section']);
    $sql->execute();
    $section = $sql->fetch();
    $section['inType'] = isset($_SESSION['user']['sections'][$section['section_id']]) ? $_SESSION['user']['sections'][$section['section_id']]['us_type'] : false;
    $tpl->assign('section', $section);
    $tpl->assign('managers', array());
    $tpl->assign('users', array());
    $tpl->assign('guests', array());
    

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="manager"');
    $sql->bindValue(1, $section['section_id']);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('managers', $line);

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="user"');
    $sql->bindValue(1, $section['section_id']);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('users', $line);

    $sql = $pdo->prepare('SELECT * FROM user_sections LEFT JOIN users ON user_id = us_user WHERE us_section = ? AND us_type="guest"');
    $sql->bindValue(1, $section['section_id']);
    $sql->execute();
    while ($line = $sql->fetch())
        $tpl->append('guests', $line);

    $tpl->display('section_details.tpl');
    quit();
}


function section_goin() {
    global $pdo;

    $sql = $pdo->prepare('INSERT INTO user_sections (us_user, us_section, us_type) VALUES (?, ?, "guest")');
    $sql->bindValue(1, $_SESSION['user']['user_id']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section');
}

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
 * @global type $pdo
 */
function section_accept()
{
    global $pdo;
    
    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "user" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

/**
 * Bye le membre ...
 * @global type $pdo
 */
function section_reject()
{
    global $pdo;
    
    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "rejected" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}

/**
 * Promotion manager
 * @global type $pdo
 */
function section_manager()
{
    global $pdo;
    
    $sql = $pdo->prepare('UPDATE user_sections SET us_type = "manager" WHERE us_user = ? AND us_section = ?');
    $sql->bindValue(1, $_GET['user']);
    $sql->bindValue(2, $_GET['section']);
    $sql->execute();
    redirect('section', 'details', array('section' => $_GET['section']));
}