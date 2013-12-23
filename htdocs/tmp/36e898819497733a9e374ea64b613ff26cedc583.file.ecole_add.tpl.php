<?php /* Smarty version Smarty-3.1.16, created on 2013-12-22 21:00:04
         compiled from "/var/www/nep2/htdocs/templates/ecole_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23094168052b73ce0dd62f8-80283591%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36e898819497733a9e374ea64b613ff26cedc583' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/ecole_add.tpl',
      1 => 1387742013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23094168052b73ce0dd62f8-80283591',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b73ce0df0982_62126335',
  'variables' => 
  array (
    'succes' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b73ce0df0982_62126335')) {function content_52b73ce0df0982_62126335($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['succes']->value) {?>
    <div class="success alert-success">Insertion OK</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <div class="alert-danger danger">Insertion fail</div>
<?php }?>


<h1>Administration</h1>
<h2>Ecoles</h2>

<ul class="nav nav-pills">
  <li><a href="<?php echo mkurl_smarty(array('action'=>"ecole"),$_smarty_tpl);?>
">Liste</a></li>
  <li class="active"><a href="<?php echo mkurl_smarty(array('action'=>"ecole",'page'=>"add"),$_smarty_tpl);?>
" class="btn" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<form method="POST" action="<?php echo mkurl_smarty(array('action'=>"ecole",'page'=>"add"),$_smarty_tpl);?>
">
    <p>
        Nom de l'école :<br/>
        <input type="text" name="ut_name" />
    </p>
    <p>
        <input type="submit" name="Ajouter" class="btn btn-default" />
    </p>
</form>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
