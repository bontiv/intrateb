<?php /* Smarty version Smarty-3.1.13, created on 2013-05-05 22:43:41
         compiled from "/var/www/EpiceNote/templates/events_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12951039405186b9d825b025-54038978%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b123846b4b3932112f748f067138e956a2e6c861' => 
    array (
      0 => '/var/www/EpiceNote/templates/events_view.tpl',
      1 => 1367786620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12951039405186b9d825b025-54038978',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5186b9d833db15_19322775',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5186b9d833db15_19322775')) {function content_5186b9d833db15_19322775($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<h1>Evenements</h1>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Evenement</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Statut</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Epigliss 2014 <span class="label label-info">Bonus</span></td>
      <td>25-01-2014 20:00:00</td>
      <td>2-02-2014 20:00:00</td>
      <td>Inscription possible jusqu'au 30-12-2013</td>
      <td><div class="dropdown btn-group">
          <a href="#" class="btn">Inscription</a>
        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="events/view/1/unsuscribe"><i class="icon-certificate"></i> Disponibilités</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-calendar"></i> Planning</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-remove"></i> Désinscription</a></li>
        </ul>
      </div></td>
    </tr>
    <tr>
      <td>Wei 2013 <span class="label label-success">Inscrit !</span></td>
      <td>27-09-2013 20:00:00</td>
      <td>29-09-2013 20:00:00</td>
      <td>Désinscription possible jusqu'au 30-08-2013</td>
      <td><div class="dropdown btn-group">
          <a href="#" class="btn disabled btn-info">Mon planning</a>
        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="events/view/1/unsuscribe"><i class="icon-certificate"></i> Disponibilités</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-calendar"></i> Planning</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-remove"></i> Désinscription</a></li>
        </ul>
      </div></td>
    </tr>
    <tr>
      <td>Campagne BDE 2013 <span class="label label-success">Inscrit !</span></td>
      <td>27-03-2013 20:00:00</td>
      <td>29-03-2013 20:00:00</td>
      <td>événement fini et noté</td>
      <td><div class="dropdown btn-group">
          <a href="#" class="btn btn-info">Mon planning</a>
        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="events/view/1/unsuscribe"><i class="icon-certificate"></i> Disponibilités</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-calendar"></i> Planning</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-remove"></i> Désinscription</a></li>
        </ul>
      </div></td>
    </tr>
    <tr>
      <td>Epigliss 2013 <span class="label label-inverse">Organisateur</span></td>
      <td>25-01-2013 20:00:00</td>
      <td>2-02-2013 20:00:00</td>
      <td>Notation effectué</td>
      <td><div class="dropdown btn-group">
          <a href="#" class="btn btn-inverse">Notation</a>
        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="events/view/1/unsuscribe"><i class="icon-certificate"></i> Disponibilités</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-calendar"></i> Planning</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-remove"></i> Désinscription</a></li>
        </ul>
      </div></td>
    </tr>
    <tr class="error">
      <td>Wei 2012 <span class="label label-important">Inscription requise</span></td>
      <td>27-09-2013 20:00:00</td>
      <td>29-09-2013 20:00:00</td>
      <td>Délai d'inscription passé</td>
      <td><div class="dropdown btn-group">
          <a href="#" class="btn disabled btn-primary">Inscription</a>
        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="events/view/1/unsuscribe"><i class="icon-certificate"></i> Disponibilités</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-calendar"></i> Planning</a></li>
          <li><a href="events/view/1/unsuscribe"><i class="icon-remove"></i> Désinscription</a></li>
        </ul>
      </div></td>
    </tr>
  </tbody>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>