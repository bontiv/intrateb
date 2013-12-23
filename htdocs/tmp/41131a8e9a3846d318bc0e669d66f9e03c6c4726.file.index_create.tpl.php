<?php /* Smarty version Smarty-3.1.16, created on 2013-12-23 03:06:57
         compiled from "/var/www/nep2/htdocs/templates/index_create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98052447352b7982cf31f57-58095691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '41131a8e9a3846d318bc0e669d66f9e03c6c4726' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/index_create.tpl',
      1 => 1387764405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98052447352b7982cf31f57-58095691',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b7982d0282a6_95745534',
  'variables' => 
  array (
    'succes' => 0,
    'error' => 0,
    'types' => 0,
    't' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b7982d0282a6_95745534')) {function content_52b7982d0282a6_95745534($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['succes']->value) {?>
    <div class="success alert-success">Inscription passé avec succès.</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <div class="alert-danger danger"><strong>Erreur !</strong> <?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
<?php }?>


<h1>Inscription</h1>
<div class="alert alert-info">
    <p><strong>Attention !</strong> L'inscription sur ce site ne tient pas lieu
        d'inscription à l'association. Vous devez vous inscrire et cotiser en
        tant qu'adhérent pour bénéficier de tous les services de ce site.
        </p>
</div>

<form method="POST" action="<?php echo mkurl_smarty(array('action'=>"index",'page'=>"create"),$_smarty_tpl);?>
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
        Mot de passe :<br/>
        <input type="password" name="user_pass" />
    </p>
    <p>
        Confirmez le mot de passe :<br/>
        <input type="password" name="confirmPassword" />
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
        <input type="submit" name="Inscription" class="btn btn-default" />
    </p>
</form>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
