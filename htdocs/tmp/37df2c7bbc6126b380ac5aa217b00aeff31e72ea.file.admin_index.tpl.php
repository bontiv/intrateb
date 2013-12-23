<?php /* Smarty version Smarty-3.1.16, created on 2013-12-23 01:10:26
         compiled from "/var/www/nep2/htdocs/templates/admin_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112878672852b77e04109750-34539768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37df2c7bbc6126b380ac5aa217b00aeff31e72ea' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/admin_index.tpl',
      1 => 1387757425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112878672852b77e04109750-34539768',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b77e0410c444_07424700',
  'variables' => 
  array (
    'acls' => 0,
    'line' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b77e0410c444_07424700')) {function content_52b77e0410c444_07424700($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Administration</h1>
<h2>Droits d'accès</h2>
<form method="POST" action="<?php echo mkurl_smarty(array('action'=>"admin",'page'=>"update"),$_smarty_tpl);?>
">
    <table  class="table table-striped table-hover">
        <thead>
        <th>Module</th>
        <th>Page</th>
        <th>Niveau</th>
        </thead>
        <tbody>
            <?php  $_smarty_tpl->tpl_vars["line"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["line"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['acls']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["line"]->key => $_smarty_tpl->tpl_vars["line"]->value) {
$_smarty_tpl->tpl_vars["line"]->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['line']->value['acl_action'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['line']->value['acl_page'];?>
</td>
                    <td><select name="acl<?php echo $_smarty_tpl->tpl_vars['line']->value['acl_id'];?>
">
                            <option <?php if ($_smarty_tpl->tpl_vars['line']->value['acl_acces']=="ANNONYMOUS") {?>selected="selected"<?php }?> value="ANNONYMOUS">Libre</option>
                            <option <?php if ($_smarty_tpl->tpl_vars['line']->value['acl_acces']=="GUEST") {?>selected="selected"<?php }?> value="GUEST">Visiteur</option>
                            <option <?php if ($_smarty_tpl->tpl_vars['line']->value['acl_acces']=="USER") {?>selected="selected"<?php }?> value="USER">Membre</option>
                            <option <?php if ($_smarty_tpl->tpl_vars['line']->value['acl_acces']=="SUPERUSER") {?>selected="selected"<?php }?> value="SUPERUSER">Responsable</option>
                            <option <?php if ($_smarty_tpl->tpl_vars['line']->value['acl_acces']=="ADMINISTRATOR") {?>selected="selected"<?php }?> value="ADMINISTRATOR">Admin</option>
                        </select>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p><input class="btn btn-default" type="submit"/></p>
</form>

<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
