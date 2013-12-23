<?php /* Smarty version Smarty-3.1.16, created on 2013-12-22 22:00:03
         compiled from "/var/www/nep2/htdocs/templates/section_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35483813552b752140ddcf1-02557914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6dfcdcce7e38a48b9b911b058728511ad2920d1' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/section_add.tpl',
      1 => 1387745994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35483813552b752140ddcf1-02557914',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b7521410e796_08157600',
  'variables' => 
  array (
    'succes' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b7521410e796_08157600')) {function content_52b7521410e796_08157600($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['succes']->value) {?>
    <div class="success alert-success">Insertion OK</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <div class="alert-danger danger">Insertion fail <?php echo $_smarty_tpl->tpl_vars['error']->value[2];?>
</div>
<?php }?>


<h1>Administration</h1>
<h2>Sections</h2>

<ul class="nav nav-pills">
  <li><a href="<?php echo mkurl_smarty(array('action'=>"section"),$_smarty_tpl);?>
">Liste</a></li>
  <li class="active"><a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"add"),$_smarty_tpl);?>
" class="btn" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<form method="POST" action="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"add"),$_smarty_tpl);?>
">
    <p>
        Nom de la section :<br/>
        <input type="text" name="section_name" />
    </p>
    <p>
        Type de section :<br/>
        <select name="section_type">
            <option value="PRIMARY">Section asso</option>
            <option value="SECONDARY">Sous-section</option>
        </select>
    </p>
    <p>
        <input type="submit" name="Ajouter" class="btn btn-default" />
    </p>
</form>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
