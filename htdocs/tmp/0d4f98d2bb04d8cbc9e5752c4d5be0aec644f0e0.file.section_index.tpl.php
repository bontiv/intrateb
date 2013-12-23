<?php /* Smarty version Smarty-3.1.16, created on 2013-12-23 02:30:50
         compiled from "/var/www/nep2/htdocs/templates/section_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106415722952b7515aadf1b0-23607413%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d4f98d2bb04d8cbc9e5752c4d5be0aec644f0e0' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/section_index.tpl',
      1 => 1387762247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106415722952b7515aadf1b0-23607413',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b7515ab23fc7_17106557',
  'variables' => 
  array (
    'sections' => 0,
    'line' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b7515ab23fc7_17106557')) {function content_52b7515ab23fc7_17106557($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Administration</h1>
<h3>Gestion des sections</h3>
<a class="btn btn-link" href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"add"),$_smarty_tpl);?>
" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Type</th>
      <th>Créateur</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php  $_smarty_tpl->tpl_vars["line"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["line"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["line"]->key => $_smarty_tpl->tpl_vars["line"]->value) {
$_smarty_tpl->tpl_vars["line"]->_loop = true;
?>
    <tr>
      <td><a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"details",'section'=>$_smarty_tpl->tpl_vars['line']->value['section_id']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['line']->value['section_name'];?>
</a>
      <?php if ($_smarty_tpl->tpl_vars['line']->value['inType']=="guest") {?><span class="label label-default">En attente</span><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['line']->value['inType']=="rejected") {?><span class="label label-danger">Rejeté</span><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['line']->value['inType']=="user") {?><span class="label label-success">Staff</span><?php }?>
      <?php if ($_smarty_tpl->tpl_vars['line']->value['inType']=="manager") {?><span class="label label-primary">Manager</span><?php }?>
          </td>
      <td><?php echo $_smarty_tpl->tpl_vars['line']->value['section_type'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_name'];?>
</td>
      <td>
        <div class="btn-group">
          <?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"ADMINISTRATOR")); $_block_repeat=true; echo acl_smarty(array('level'=>"ADMINISTRATOR"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"delete",'section'=>$_smarty_tpl->tpl_vars['line']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"ADMINISTRATOR"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

          <?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"ADMINISTRATOR")); $_block_repeat=true; echo acl_smarty(array('level'=>"ADMINISTRATOR"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"edit",'section'=>$_smarty_tpl->tpl_vars['line']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"ADMINISTRATOR"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

          <?php if ($_smarty_tpl->tpl_vars['line']->value['inType']) {?>
          <a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"goout",'section'=>$_smarty_tpl->tpl_vars['line']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
          <?php } else { ?>
          <a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"goin",'section'=>$_smarty_tpl->tpl_vars['line']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i></a>
          <?php }?>
        </div>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
    

<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
