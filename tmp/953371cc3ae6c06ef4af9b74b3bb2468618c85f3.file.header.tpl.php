<?php /* Smarty version Smarty-3.1.13, created on 2013-05-05 22:41:34
         compiled from "/var/www/EpiceNote/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:48033388151859f5a8302c6-96366871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '953371cc3ae6c06ef4af9b74b3bb2468618c85f3' => 
    array (
      0 => '/var/www/EpiceNote/templates/header.tpl',
      1 => 1367786493,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48033388151859f5a8302c6-96366871',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51859f5a8328f8_18916564',
  'variables' => 
  array (
    'assetURL' => 0,
    'EXEC' => 0,
    'baseURL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51859f5a8328f8_18916564')) {function content_51859f5a8328f8_18916564($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Epice Notator 1.0</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['assetURL']->value;?>
css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['assetURL']->value;?>
css/bootstrap-responsive.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
          <a href="#" class="brand">Asso notator</a>

            <ul class="nav" role="navigation">
              <li<?php if ($_smarty_tpl->tpl_vars['EXEC']->value['controller']=='info'){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
info/notation">La notation</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['EXEC']->value['controller']=='events'){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
events/view">Events</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['EXEC']->value['controller']=='note'){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
note/view">Notes</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['EXEC']->value['controller']=='bulletin'){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
bulletin/view">Bulletin</a></li>
              <li class="dropdown<?php if ($_smarty_tpl->tpl_vars['EXEC']->value['controller']=='admin'){?> active<?php }?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Administration <b class="caret"></b>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
admin/users">Utilisateurs</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
admin/events">Evenements</a></li>
                </ul>
                </a>
            </ul>
              
          <div class="pull-right">
            <ul class="nav" role="navigation">
              <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">
                login_x <b class="caret"></b>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
profil/logout">Déconnexion</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseURL']->value;?>
profil/edit">Mon profile</a></li>
                </ul>
              </a></li>
            </ul>

          </div>

        </div>
      </div>
    </div>
<div class="container"><?php }} ?>