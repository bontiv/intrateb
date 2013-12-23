<?php /* Smarty version Smarty-3.1.16, created on 2013-12-23 02:41:23
         compiled from "/var/www/nep2/htdocs/templates/user_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100878803052b772cfb93975-97481168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdd5654a2ae1358575b3e7f38727511eb2d32943' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/user_details.tpl',
      1 => 1387762882,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100878803052b772cfb93975-97481168',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b772cfbd4742_29652316',
  'variables' => 
  array (
    'user' => 0,
    'section_list' => 0,
    'sec' => 0,
    'sections' => 0,
    'line' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b772cfbd4742_29652316')) {function content_52b772cfbd4742_29652316($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Utilisateurs</h1>
<h2><?php echo $_smarty_tpl->tpl_vars['user']->value['user_name'];?>
</h2>

<p><strong>Nom : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['user_lastname'];?>
<br/>
    <strong>Prenom : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['user_firstname'];?>
<br/>
    <strong>ID : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
<br/>
    <strong>Ecole : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['ut_name'];?>
<br/>
    <strong>Login IONIS : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['user_login'];?>
<br/>
    <strong>email : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['user_email'];?>
<br/>
    <strong>Téléphone : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['user_phone'];?>
<br/>
    <strong>Accès : </strong><?php echo $_smarty_tpl->tpl_vars['user']->value['user_role'];?>
</p>

<h3>Ses sections</h3>
<form method="POST" class="form-inline" action="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"invit_section",'user'=>$_smarty_tpl->tpl_vars['user']->value['user_id']),$_smarty_tpl);?>
">
    <p>Adhésion
        <select name="us_section" class="form-control" style="width:200px;">
            <?php  $_smarty_tpl->tpl_vars["sec"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["sec"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['section_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["sec"]->key => $_smarty_tpl->tpl_vars["sec"]->value) {
$_smarty_tpl->tpl_vars["sec"]->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['sec']->value['section_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['sec']->value['section_name'];?>
</option>
            <?php } ?>
        </select>
        <input type="submit" value="OK" class="btn btn-default" />
        </p>
</form>
<table  class="table table-striped table-hover">
    <thead>
    <th>Section</th>
    <th>Type</th>
    <th>Participation</th>
    <th>Action</th>
</thead>
<tbody>
    <?php  $_smarty_tpl->tpl_vars["line"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["line"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["line"]->key => $_smarty_tpl->tpl_vars["line"]->value) {
$_smarty_tpl->tpl_vars["line"]->_loop = true;
?>
        <tr>
            <td><a href="<?php echo mkurl_smarty(array('action'=>"section",'page'=>"detail",'section'=>$_smarty_tpl->tpl_vars['line']->value['section_id']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['line']->value['section_name'];?>
</a></td>
            <td><?php echo $_smarty_tpl->tpl_vars['line']->value['section_type'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['line']->value['us_type'];?>
</td>
            <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('acl', array('level'=>"SUPERUSER")); $_block_repeat=true; echo acl_smarty(array('level'=>"SUPERUSER"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<a href="<?php echo mkurl_smarty(array('action'=>"user",'page'=>"quit",'section'=>$_smarty_tpl->tpl_vars['line']->value['section_id'],'user'=>$_smarty_tpl->tpl_vars['user']->value['user_id']),$_smarty_tpl);?>
" class="btn btn-danger">Quitter</a><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo acl_smarty(array('level'=>"SUPERUSER"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
        </tr>
    <?php } ?>
</tbody>
</table>
<h3>Ses events</h3>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
