<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($argv) || !isset($argc) || isset($_SERVER['HTTP_HOST'])) {
    echo "Le script Cron n'est utilisable qu'en console.";
    exit;
}

define('NPE_INDEX', true);
chdir(dirname(__FILE__) . '/../htdocs');
require 'bootstrap.php';
include $srcdir . '/loader.php';

//Liste des actions a enclencher
$cronActions = array(
    "bocal:update",
    "user:execSync",
    "ml:execUpdate",
);

//Execution des actions
foreach ($cronActions as $param) {
    list($action, $page) = explode(':', $param);
    modexec($action, $page);
}