<?php /* Smarty version Smarty-3.1.16, created on 2013-12-23 01:25:06
         compiled from "/var/www/nep2/htdocs/templates/syscore_error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154303594752b70ef1d3e779-85260196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98dbe8ecd7827a2fbcec6057be7480a1e4f330a5' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/syscore_error.tpl',
      1 => 1387758305,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154303594752b70ef1d3e779-85260196',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b70ef1e378e3_75361796',
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b70ef1e378e3_75361796')) {function content_52b70ef1e378e3_75361796($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="alert alert-danger">
    <p><strong>Erreur !</strong> <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</p>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
