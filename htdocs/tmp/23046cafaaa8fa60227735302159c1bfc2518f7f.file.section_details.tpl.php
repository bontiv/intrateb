<?php /* Smarty version Smarty-3.1.16, created on 2013-12-23 02:28:40
         compiled from "/var/www/nep2/htdocs/templates/section_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206975498352b75905a900d2-64247724%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23046cafaaa8fa60227735302159c1bfc2518f7f' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/section_details.tpl',
      1 => 1387762116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206975498352b75905a900d2-64247724',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b75905ac2897_41767653',
  'variables' => 
  array (
    'section' => 0,
    'managers' => 0,
    'line' => 0,
    'users' => 0,
    'guests' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b75905ac2897_41767653')) {function content_52b75905ac2897_41767653($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Administration</h1>
<h2>Section <?php echo $_smarty_tpl->tpl_vars['section']->value['section_name'];?>
</h2>
<p>Section crée par <?php echo $_smarty_tpl->tpl_vars['section']->value['user_name'];?>
. C'est une <?php if (!isset($_smarty_tpl->tpl_vars['section']) || !is_array($_smarty_tpl->tpl_vars['section']->value)) $_smarty_tpl->createLocalArrayVariable('section');
if ($_smarty_tpl->tpl_vars['section']->value['section_type'] = "primary") {?>section principale<?php } else { ?>sous section<?php }?>.</p>
<h3>Membres</h3>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Type</th>
            <th>Login</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php  $_smarty_tpl->tpl_vars["line"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["line"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['managers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["line"]->key => $_smarty_tpl->tpl_vars["line"]->value) {
$_smarty_tpl->tpl_vars["line"]->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_name'];?>
</td>
                <td><span class="label label-primary">Manager</span></td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_login'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_email'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_phone'];?>
</td>
                <td><a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"accept",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id'],'section'=>$_smarty_tpl->tpl_vars['section']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-warning"><span class="glyphicon-thumbs-down glyphicon"></span></td>
            </tr>
        <?php } ?>
        <?php  $_smarty_tpl->tpl_vars["line"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["line"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["line"]->key => $_smarty_tpl->tpl_vars["line"]->value) {
$_smarty_tpl->tpl_vars["line"]->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_name'];?>
</td>
                <td><span class="label label-success">Staff</span></td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_login'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_email'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_phone'];?>
</td>
                <td>
                    <div class="btn-group">
                    <a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"reject",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id'],'section'=>$_smarty_tpl->tpl_vars['section']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
                    <a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"manager",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id'],'section'=>$_smarty_tpl->tpl_vars['section']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-warning"><span class="glyphicon-thumbs-up glyphicon"></span></a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        <?php  $_smarty_tpl->tpl_vars["line"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["line"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['guests']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["line"]->key => $_smarty_tpl->tpl_vars["line"]->value) {
$_smarty_tpl->tpl_vars["line"]->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_name'];?>
</td>
                <td><span class="label label-default">En attente</span></td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_login'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_email'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['line']->value['user_phone'];?>
</td>
                <td>
                    <div class="btn-group">
                    <a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"reject",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id'],'section'=>$_smarty_tpl->tpl_vars['section']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
                    <a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"accept",'user'=>$_smarty_tpl->tpl_vars['line']->value['user_id'],'section'=>$_smarty_tpl->tpl_vars['section']->value['section_id']),$_smarty_tpl);?>
" class="btn btn-primary"><span class="glyphicon-plus glyphicon"></span></a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
