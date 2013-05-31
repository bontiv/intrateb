<?php /* Smarty version Smarty-3.1.13, created on 2013-05-06 23:55:57
         compiled from "/var/www/EpiceNote/templates/admin_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144543586951867e8576e825-19889846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e31567ccf1d212b8def9baca5ef87bd7961fe36c' => 
    array (
      0 => '/var/www/EpiceNote/templates/admin_users.tpl',
      1 => 1367865532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144543586951867e8576e825-19889846',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51867e8583b5c9_67370037',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51867e8583b5c9_67370037')) {function content_51867e8583b5c9_67370037($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="modal hide fade" id="addUser" tabindex="-1" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Ajouter un utilisateur</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>

<h1>Administration</h1>
<h3>Gestion des utilisateurs</h3>
<a class="btn" href="#addUser" role="button" data-toggle="modal"><i class="icon-plus"></i> Ajouter</a>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Téléphone</th>
      <th>email</th>
      <th>Login</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>BONNET</td>
      <td>Remi</td>
      <td>06.83.56.27.46</td>
      <td><a href="mailto:prog.bontiv@gmail.com">prog.bontiv@gmail.com</a></td>
      <td><a href="https://intra.epitech.eu/user/bonnet_f/">bonnet_f</a></td>
      <td>
        <div class="btn-group">
          <button class="btn btn-danger"><i class="icon-trash"></i></button>
          <button class="btn"><i class="icon-pencil"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>FOLLET</td>
      <td>Estelle</td>
      <td class="muted">Non renseigné</td>
      <td><a href="mailto:prog.bontiv@gmail.com">prog.bontiv@gmail.com</a></td>
      <td><a href="https://intra.epitech.eu/user/bonnet_f/">bonnet_f</a></td>
      <td>
        <div class="btn-group">
          <button class="btn btn-danger"><i class="icon-trash"></i></button>
          <button class="btn"><i class="icon-pencil"></i></button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>