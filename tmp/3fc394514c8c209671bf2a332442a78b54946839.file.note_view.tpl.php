<?php /* Smarty version Smarty-3.1.13, created on 2013-05-07 00:17:10
         compiled from "/var/www/EpiceNote/templates/note_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8160243815186c253624e38-76308679%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fc394514c8c209671bf2a332442a78b54946839' => 
    array (
      0 => '/var/www/EpiceNote/templates/note_view.tpl',
      1 => 1367878382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8160243815186c253624e38-76308679',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5186c2536457c0_18522897',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5186c2536457c0_18522897')) {function content_5186c2536457c0_18522897($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<h1>Palmares</h1>
<ul class="nav nav-pills">
  <li class="active"><a href="#">Semestre 1</a></li>
  <li><a href="#">Semestre 2</a></li>
  <li><a href="#">Annuel</a></li>
</ul>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Classement</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Login</th>
      <th>NST</th>
      <th>NI</th>
      <th>Points</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>FOLLET</td>
      <td>Estelle</td>
      <td>follet_e</td>
      <td>20</td>
      <td>140%</td>
      <td>28</td>
    </tr>
    <tr class="info">
      <td>2</td>
      <td>BONNET</td>
      <td>Remi</td>
      <td>bonnet_f</td>
      <td>17</td>
      <td>100%</td>
      <td>17</td>
    </tr>
  </tbody>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>