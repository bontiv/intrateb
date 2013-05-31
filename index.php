<?php

include "./libs/smarty/Smarty.class.php";
include "./bootstrap.php";


$smarty = new Smarty();
$smarty->template_dir = ROOT . "templates";
$smarty->compile_dir = ROOT . "tmp";

function execAction($controller, $action = '', $params = null) {
  global $smarty;
  
  $fileBase = basename($controller);
  $filePath = './controllers/' . $fileBase . '.php';
  $function = $fileBase . '_' . $action . 'Action';
  if ($params === null) $params = array();
  
  if (!file_exists($filePath)) {
    trigger_error('Controller not found', E_USER_ERROR);
    return false;
  }

  include_once $filePath;
  if (!function_exists($function)) {
    trigger_error('Action not found', E_USER_ERROR);
    return false;
  }
  
  $smarty->assign('EXEC', array(
      'controller' => $controller,
      'action' => $action,
      ));
  call_user_func_array($function, $params);
}

if (isset($_SERVER['PATH_INFO']))
  $elmts = explode('/', $_SERVER['PATH_INFO']);
else if ($_SERVER['QUERY_STRING'])
  $elmts = explode('/', $_SERVER['QUERY_STRING']);
else
  $elmts = array('info', 'notation');

for ($i = 0; $i < count($elmts); $i++) {
  if ($elmts[$i] === '')
    unset ($elmts[$i]);
}

$controller = array_shift($elmts);
$action = array_shift($elmts);

$smarty->assign('assetURL', '/EpiceNote/public/');
$smarty->assign('baseURL', '/EpiceNote/index.php/');
execAction($controller, $action);
