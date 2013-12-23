<?php

/**
 * Petite page de présentation du projet
 * @global type $tpl
 */
function index_index() {
    global $tpl;

    $tpl->display('index.tpl');
    quit();
}

/**
 * Permet de connecter un utilisateur
 * @global type $tpl
 * @global type $pdo
 */
function index_login() {
    global $tpl, $pdo;

    $tpl->assign('msg', false);

    //Tentative de connexion
    if (isset($_POST['login'])) {
        $sql = $pdo->prepare('SELECT * FROM users WHERE user_name = ?');
        $sql->bindValue(1, $_POST['login']);
        $sql->execute();
        if ($user = $sql->fetch()) {
            //Ici l'utilisateur existe
            if (strlen($user['user_pass']) != 32) // Mot de passe non chiffré ...
                $user['user_pass'] = md5($user['user_name'] . ':' . $user['user_pass']);

            //Mot de passe correct ?
            if (md5($user['user_pass'] . $_SESSION['random']) == $_POST['password']) {
                $_SESSION['user'] = $user;
                $_SESSION['user']['role'] = aclFromText($user['user_role']);
                redirect('index');
            }
        }

        // Et oui, pas de redirection = erreur de login ...
        $tpl->assign('msg', 'Utilisateur ou mot de passe erroné.');
    }

    $_SESSION['random'] = md5(uniqid());
    $tpl->assign('random', $_SESSION['random']);
    $tpl->display('index_login.tpl');
    quit();
}

/**
 * Ferme une session utilisateur
 * @global type $tpl
 */
function index_logout() {
    global $tpl;

    $_SESSION['user'] = false;
    redirect('index');
}

function index_create() {
    global $tpl, $pdo;
    $tpl->assign('error', false);
    $tpl->assign('succes', false);

    if (isset($_POST['user_name'])) {
        $pass = md5($_POST['user_name'].':'.$_POST['user_pass']);
        
        if (strlen($_POST['user_pass']) < 4)
            $tpl->assign('error', 'Mot de passes pas assez long...');
        elseif ($_POST['user_pass'] != $_POST['confirmPassword'])
            $tpl->assign('error', 'Mot de passes différents...');
        elseif ($_POST['user_pass'] != $_POST['confirmPassword'])
            $tpl->assign('error', 'Mot de passes différents...');
        elseif (autoInsert('users', 'user_', array(
            'user_pass' => $pass,
            'user_role' => 'GUEST',
        ))) {
            $tpl->assign('succes', true);
        }
        else
            $tpl->assign('error', 'Erreur SQL...');
    }

    $sql = $pdo->prepare('SELECT * FROM user_types');
    $sql->execute();
    while ($type = $sql->fetch()) {
        $tpl->append('types', $type);
    }


    $tpl->display('index_create.tpl');
    quit();
}