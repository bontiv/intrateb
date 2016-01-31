<?php

/**
 * Fichier pour l'administration des instances des modèles
 * @package frametool
 */
function admin_modeles_index() {
    global $tpl, $pdo;

    $tables = mdle_get_tables();

    foreach ($tables as $t) {
        $sql = $pdo->query("SELECT COUNT(*) FROM " . $t['name']);
        $t['nbr'] = $sql->fetch();
        $t['nbr'] = $t['nbr'][0];
        $tpl->append('tables', $t);
    }
    $tpl->display('adminmodeles.tpl');
    quit();
}

function admin_modeles_modele() {
    global $tpl, $pdo;

    if (!preg_match("/^[a-zA-Z0-9_]*$/", $_GET['modele']))
        dbg_error(__FILE__, "Le nom de la table est incorrect");

    $table = mdle_need_desc($_GET['modele']);
    foreach ($table['fields'] as $key => $f) {
        if (!isset($f['label']))
            $f['label'] = $key;
        $f['name'] = $key;
        $tpl->append('fields', $f);
    }
    $tpl->assign('modele', $table);

    $sql = $pdo->query("SELECT * FROM `" . $_GET['modele'] . "`");
    $tpl->assign('insts', $sql->fetchAll());

    if ($tpl->getTemplateVars('result') == null)
        $tpl->assign('result', '');
    $tpl->display('adminmodeles_modele.tpl');
    quit();
}

function admin_modeles_addinst() {
    global $tpl;

    if (!preg_match("/^[a-zA-Z0-9_]*$/", $_GET['modele']))
        dbg_error(__FILE__, "Le nom de la table est incorrect");

    $modele = new Modele($_GET['modele']);
    $tpl->assign('result', '');

    if (isset($_POST['action'])) {
        if ($modele->addFrom($_POST)) {
            $tpl->assign('result', 'success');
        } else {
            $tpl->assign('result', 'error');
        }
    }

    $tpl->assign('modele', $modele);
    $tpl->assign('edit', $modele->edit());
    $tpl->display('adminmodeles_addinst.tpl');
    quit();
}

function admin_modeles_delinst() {
    global $tpl;

    $modele = new Modele($_GET['modele']);
    $modele->fetch($_GET['key']);
    $modele->delete();
    $tpl->assign('result', 'success');
    modexec('admin_modeles', 'modele');
}

function admin_modeles_modinst() {
    global $tpl;

    $modele = new Modele($_GET['modele']);
    $modele->fetch($_GET['key']);
    $tpl->assign('result', '');

    if (isset($_POST['action'])) {
        if ($modele->modFrom($_POST)) {
            $tpl->assign('result', 'success');
        } else {
            $tpl->assign('result', 'error');
        }
    }
    $tpl->assign('modele', $modele);
    $tpl->assign('edit', $modele->edit());
    $tpl->display('adminmodeles_modinst.tpl');
    quit();
}
