<?php

function config_index() {
    global $tpl;

    $tpl->assign('configs', get_configs());
    display();
}

function _config_display_field($cfg, $name) {
    global $config;

    if (!isset($cfg['fields'][$name]))
        dbg_error(__FILE__, 'Oups ! On me demande l\'affichage du champ ' . $name . ' mais il n\'existe pas dans le modèle ' . $cfg['name'] . '.');

    // Pas de champs pour une inscrémentation auto
    if ($cfg['fields'][$name]['type'] == 'auto_int')
        return '';

    $func = 'mdle_form_' . $cfg['fields'][$name]['type'];

    if (function_exists($func))
        return call_user_func($func, $cfg['fields'][$name], isset($config[$cfg['name']], $config[$cfg['name']][$name]) ? $config[$cfg['name']][$name] : null);
    else
        dbg_error(__FILE__, 'L\'affichage des champs de type ' . $cfg['fields'][$name]['type'] . ' n\'est pas encore implémenté.');
}

function _config_update($scope, $name, $value) {
    global $config, $pdo, $env;

    $config[$scope][$name] = $value;

    $update = $pdo->prepare('UPDATE config SET value = ? WHERE name = ? AND env = ?');
    $update->bindValue(1, $value);
    $update->bindValue(2, "$scope!!$name");
    $update->bindValue(3, $env);
    $update->execute();
    if ($update->rowCount() > 0)
        return true;
    echo 'step2';
    $insert = $pdo->prepare('INSERT INTO config (value, name, env) VALUES (?, ?, ?)');
    $insert->bindValue(1, $value);
    $insert->bindValue(2, "$scope!!$name");
    $insert->bindValue(3, $env);
    return $insert->execute();
}

function config_edit() {
    global $tpl;

    $allCfg = get_configs();
    $cfg = $allCfg[$_GET['scope']];
    $tpl->assign('cfg', $cfg);

    if (isset($_POST['valider'])) {
        foreach (array_keys($cfg['fields']) as $name) {
            $tpl->assign('hsuccess', _config_update($cfg['name'], $name, $_POST[$name]));
        }
    }

    $form = '';
    foreach (array_keys($cfg['fields']) as $name) {
        $form .= _config_display_field($cfg, $name);
    }
    $tpl->assign('form', $form);

    display();
}
