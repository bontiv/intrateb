<?php /* Smarty version Smarty-3.1.13, created on 2013-05-05 18:29:04
         compiled from "/var/www/EpiceNote/templates/admin_events.tpl" */ ?>
<?php /*%%SmartyHeaderCode:881854046518688aff3a6e4-53045854%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b2240b2be2683c8efe7a1ad69d799998a2073ae' => 
    array (
      0 => '/var/www/EpiceNote/templates/admin_events.tpl',
      1 => 1367771343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '881854046518688aff3a6e4-53045854',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_518688b001a2f5_45646748',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518688b001a2f5_45646748')) {function content_518688b001a2f5_45646748($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="modal hide fade" id="addEvent" tabindex="-1" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Ajouter un événement</h3>
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
<h3>Gestion des événements</h3>
<a class="btn" href="#addEvent" role="button" data-toggle="modal"><i class="icon-plus"></i> Ajouter</a>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Evenement</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Statut</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Wei 2013</td>
      <td>27-09-2013 20:00:00</td>
      <td>29-09-2013 20:00:00</td>
      <td>Inscription jusqu'au 30-08-2013</td>
      <td>
        <div class="btn-group">
          <button class="btn btn-danger"><i class="icon-trash"></i></button>
          <button class="btn"><i class="icon-pencil"></i></button>
          <button class="btn btn-warning"><i class="icon-lock"></i></button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>