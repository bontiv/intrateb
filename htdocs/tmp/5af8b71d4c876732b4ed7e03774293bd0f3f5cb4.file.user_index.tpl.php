<?php /* Smarty version Smarty-3.1.16, created on 2013-12-22 22:35:01
         compiled from "/var/www/nep2/htdocs/templates/user_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77232800852b737f9a66f98-97078454%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5af8b71d4c876732b4ed7e03774293bd0f3f5cb4' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/user_index.tpl',
      1 => 1387748100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77232800852b737f9a66f98-97078454',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b737f9a8f047_40303613',
  'variables' => 
  array (
    'ptable' => 0,
    'line' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b737f9a8f047_40303613')) {function content_52b737f9a8f047_40303613($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Administration</h1>
<h3>Gestion des utilisateurs</h3>
<a class="btn btn-link" href="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"add"),$_smarty_tpl);?>
" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Pseudo</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Téléphone</th>
      <th>email</th>
      <th>Login</th>
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
      <td><a href="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"view",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['line']->value['user_name'];?>
</a></td>
      <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_lastname'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_firstname'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_phone'];?>
</td>
      <td><a href="<?php echo $_smarty_tpl->tpl_vars['line']->value['user_email'];?>
"><?php echo $_smarty_tpl->tpl_vars['line']->value['user_email'];?>
</a></td>
      <td><a href="https://intra.epitech.eu/user/<?php echo $_smarty_tpl->tpl_vars['line']->value['user_login'];?>
/"><?php echo $_smarty_tpl->tpl_vars['line']->value['user_login'];?>
</a></td>
      <td>
        <div class="btn-group">
          <a href="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"delete",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id']),$_smarty_tpl);?>
" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
          <a href="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"edit",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id']),$_smarty_tpl);?>
" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
          <a href="#" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i></a>
        </div>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
    

<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
