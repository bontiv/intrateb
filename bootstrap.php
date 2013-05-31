<?php

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
include "./vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(
    ROOT . "config",
    ROOT . "models",
    );
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'modular',
    'dbname'   => 'notator',
);

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

$objs = scandir(ROOT . 'models');

foreach ($objs as &$file)
  if (is_file(ROOT . 'models' . DIRECTORY_SEPARATOR . $file))
    include_once ROOT . 'models' . DIRECTORY_SEPARATOR . $file;