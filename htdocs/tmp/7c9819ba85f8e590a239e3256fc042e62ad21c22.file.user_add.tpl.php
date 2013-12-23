<?php /* Smarty version Smarty-3.1.16, created on 2013-12-22 21:23:12
         compiled from "/var/www/nep2/htdocs/templates/user_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37856540752b7493b8a0e98-17069471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c9819ba85f8e590a239e3256fc042e62ad21c22' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/user_add.tpl',
      1 => 1387743788,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37856540752b7493b8a0e98-17069471',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b7493b8f8952_14590479',
  'variables' => 
  array (
    'succes' => 0,
    'error' => 0,
    'types' => 0,
    't' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b7493b8f8952_14590479')) {function content_52b7493b8f8952_14590479($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['succes']->value) {?>
    <div class="success alert-success">Insertion OK</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <div class="alert-danger danger">Insertion fail</div>
<?php }?>


<h1>Administration</h1>
<h2>Utilisateurs</h2>

<ul class="nav nav-pills">
  <li><a href="<?php echo mkurl_smarty(array('action'=>"user"),$_smarty_tpl);?>
">Liste</a></li>
  <li class="active"><a href="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"add"),$_smarty_tpl);?>
" class="btn"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<form method="POST" action="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"add"),$_smarty_tpl);?>
">
    <p>
        Pseudo :<br/>
        <input type="text" name="user_name" />
    </p>
    <p>
        Nom :<br/>
        <input type="text" name="user_lastname" />
    </p>
    <p>
        Prénom :<br/>
        <input type="text" name="user_firstname" />
    </p>
    <p>
        Type :<br/>
        <select name="user_type">
        <?php  $_smarty_tpl->tpl_vars["t"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["t"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["t"]->key => $_smarty_tpl->tpl_vars["t"]->value) {
$_smarty_tpl->tpl_vars["t"]->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['t']->value['ut_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['t']->value['ut_name'];?>
</option>
        <?php } ?>
        </select>
    </p>
    <p>
        Login IONIS :<br/>
        <input type="text" name="user_login" />
    </p>
    <p>
        Email :<br/>
        <input type="text" name="user_email" />
    </p>
    <p>
        Téléphone :<br/>
        <input type="text" name="user_phone" />
    </p>
    <p>
        <input type="submit" name="Ajouter" class="btn btn-default" />
    </p>
</form>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
