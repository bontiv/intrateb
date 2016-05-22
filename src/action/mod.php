<?php

/**
 * Gestionnaire des extentions INTRA.
 */
# Deja il faut la gestion des extensions
global $srcdir;
include_once $srcdir . '/libs/extend.php';

function mod_index() {
    global $tpl;

    foreach (Extend::getMods() as $mod) {
        $mod['enabled'] = Extend::isInstalled($mod['sysdir']);
        $tpl->append('extends', $mod);
    }
    display();
}

function mod_activate() {
    $mod = new Extend($_GET['mod']);

    redirect('mod', 'index', array('hsuccess' => $mod->install()));
}

function mod_desactivate() {
    $mod = new Extend($_GET['mod']);

    redirect('mod', 'index', array('hsuccess' => $mod->uninstall()));
}

function mod_update() {
    $mod = new Extend($_GET['mod']);

    redirect('mod', 'index', array('hsuccess' => $mod->update()));
}
