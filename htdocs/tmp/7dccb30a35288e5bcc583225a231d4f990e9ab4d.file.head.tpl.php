<?php /* Smarty version Smarty-3.1.16, created on 2013-12-23 02:51:40
         compiled from "/var/www/nep2/htdocs/templates/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25597690152b711dadbdde0-01343025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dccb30a35288e5bcc583225a231d4f990e9ab4d' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/head.tpl',
      1 => 1387763498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25597690152b711dadbdde0-01343025',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b711dadc5e90_57965010',
  'variables' => 
  array (
    '_user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b711dadc5e90_57965010')) {function content_52b711dadc5e90_57965010($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <!-- Css -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-select.css" rel="stylesheet">
        <!-- /Css -->
        <!-- Scripts -->
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/bootstrap-select.js"></script>
        <!-- /Scripts -->

        <title>Epice Notator ! La terreur des assos !</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body background="../images/bg3.png" style="background-attachment: fixed; width: 100%; height: 100%; background-position: top center; z-index: 1; position: relative;">

        <nav class="navbar navbar-default" role="navigation">
            <div class="navar-header">
                <a class="navbar-brand" href="<?php echo mkurl_smarty(array('action'=>"index"),$_smarty_tpl);?>
">EpiceNotator</a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse" >
                <ul class="nav navbar-nav">
<?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"USER")); $_block_repeat=true; echo acl_smarty(array('level'=>"USER"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <li><a href="<?php echo mkurl_smarty(array('action'=>"user"),$_smarty_tpl);?>
">Utilisateurs</a></li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"USER"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"ADMINISTRATOR")); $_block_repeat=true; echo acl_smarty(array('level'=>"ADMINISTRATOR"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <li><a href="<?php echo mkurl_smarty(array('action'=>"ecole"),$_smarty_tpl);?>
">Ecoles</a></li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"ADMINISTRATOR"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"GUEST")); $_block_repeat=true; echo acl_smarty(array('level'=>"GUEST"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <li><a href="<?php echo mkurl_smarty(array('action'=>"section"),$_smarty_tpl);?>
">Sections</a></li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"GUEST"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"USER")); $_block_repeat=true; echo acl_smarty(array('level'=>"USER"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <li><a href="<?php echo mkurl_smarty(array('action'=>"reclam"),$_smarty_tpl);?>
">Réclamations</a></li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"USER"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"ADMINISTRATOR")); $_block_repeat=true; echo acl_smarty(array('level'=>"ADMINISTRATOR"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Admin
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo mkurl_smarty(array('action'=>"admin"),$_smarty_tpl);?>
">Droits d'accès</a></li>
                        </ul>
                    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"ADMINISTRATOR"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </ul>
                <div class="nav navbar-nav navbar-text pull-right dropdown">
                    <?php if ($_smarty_tpl->tpl_vars['_user']->value) {?>
                        <a href="#" data-toggle="dropdown" style="color:grey">
                            <?php echo $_smarty_tpl->tpl_vars['_user']->value['user_name'];?>
</a><b class="caret"></b>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?php echo mkurl_smarty(array('action'=>"index",'page'=>"logout"),$_smarty_tpl);?>
">Déconnexion</a></li>
                            <li><a href="<?php echo mkurl_smarty(array('action'=>"index",'page'=>"profile"),$_smarty_tpl);?>
">Mon profile</a></li>
                        </ul>
                    <?php } else { ?>
                        <a href="<?php echo mkurl_smarty(array('action'=>"index",'page'=>"login"),$_smarty_tpl);?>
" style="color:grey">
                            Connexion</a> - <a href="<?php echo mkurl_smarty(array('action'=>"index",'page'=>"create"),$_smarty_tpl);?>
" style="color:grey">
                            Inscription</a>
                        <?php }?>
                </div>
            </div>

        </nav>
        <div class="container row col-md-offset-1">

<?php }} ?>
