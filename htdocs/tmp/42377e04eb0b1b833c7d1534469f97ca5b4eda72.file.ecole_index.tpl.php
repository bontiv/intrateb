<?php /* Smarty version Smarty-3.1.16, created on 2013-12-22 20:56:05
         compiled from "/var/www/nep2/htdocs/templates/ecole_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144866412352b73bf611d4d5-62336196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42377e04eb0b1b833c7d1534469f97ca5b4eda72' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/ecole_index.tpl',
      1 => 1387742164,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144866412352b73bf611d4d5-62336196',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b73bf6149315_35079685',
  'variables' => 
  array (
    'ptable' => 0,
    'line' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b73bf6149315_35079685')) {function content_52b73bf6149315_35079685($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Administration</h1>
<h3>Gestion des écoles</h3>


<ul class="nav nav-pills">
  <li class="active"><a href="#">Liste</a></li>
  <li><a href="<?php echo mkurl_smarty(array('action'=>"ecole",'page'=>"add"),$_smarty_tpl);?>
" class="btn" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Type</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php  $_smarty_tpl->tpl_vars["line"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["line"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ptable']->value['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["line"]->key => $_smarty_tpl->tpl_vars["line"]->value) {
$_smarty_tpl->tpl_vars["line"]->_loop = true;
?>
    <tr>
      <td><?php echo $_smarty_tpl->tpl_vars['line']->value['ut_name'];?>
</td>
      <td>
        <div class="btn-group">
          <a href="<?php echo mkurl_smarty(array('action'=>"ecole",'page'=>"delete",'ecole'=>$_smarty_tpl->tpl_vars['line']->value['ut_id']),$_smarty_tpl);?>
" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
          <a href="<?php echo mkurl_smarty(array('action'=>"ecole",'page'=>"edit",'ecole'=>$_smarty_tpl->tpl_vars['line']->value['ut_id']),$_smarty_tpl);?>
" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
        </div>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
    

<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
