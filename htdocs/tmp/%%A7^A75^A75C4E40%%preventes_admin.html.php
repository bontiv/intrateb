<?php /* Smarty version 2.6.26, created on 2013-08-19 22:23:39
         compiled from preventes_admin.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'preventes_admin.html', 75, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="row col-lg-1"></div>
<div class="container col-lg-6" style="
				      padding: 19px 29px 29px;
				      margin: 0 auto 20px;
				      background-color: #fff;
				      border: 1px solid #e5e5e5;
				      -webkit-border-radius: 5px;
				      -moz-border-radius: 5px;
				      border-radius: 5px;
				      -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				      -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				      box-shadow: 0 1px 2px rgba(0,0,0,.05);">
<h2>Administrations des préventes</h2>
<p>Gestion des tickets et vendeurs de préventes d'évènements.</p>


<div>
	<h3>Ajouter un vendeur</h3>
	<form method='POST'>
		<table class="table table-striped">
			<tr>
				<td>Nom</td>
				<td><input type='text' name='nom_vendeur' class="form-control"></td>
				<td>Prénom</td>
				<td><input type='text' name='prenom_vendeur' class="form-control"></td>
			</tr>
			<tr>
				<td>Organisme</td>
				<td><input type='text' name='organisme_vendeur' class="form-control"></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Identifiant</td>
				<td><input type='text' name='login_vendeur' class="form-control"></td>
				<td>Mot de passe</td>
				<td><input type='password' name='password_vendeur' class="form-control"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><button style="float:right;" class="btn" type='submit' value='Ajouter'>Ajouter</button></td>
			</tr>
		</table>
	</form>
<p>

<div class="col-lg-6">
<h3>Liste des vendeurs</h3>
<p>
Page <?php echo $this->_tpl_vars['index']+1; ?>
 sur <?php echo $this->_tpl_vars['counter']+1; ?>
, Total : <?php echo $this->_tpl_vars['total']; ?>
<br />
<?php if ($this->_tpl_vars['index'] > 0): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']-1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Précédent</a><?php endif; ?>
 -
 <?php if ($this->_tpl_vars['counter'] > $this->_tpl_vars['index']): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']+1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Suivant</a><?php endif; ?>
</p>
</div>

<p>
<table class="table table-striped span12">
	<tr>
		<td>Id</td>
		<td>Nom</td>
		<td>Organisme</td>
		<td>Tickets vendus</td>
		<td>Tickets restants</td>
		<td>Total tickets</td>
		<td></td>
	</tr>
<?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
		<td><?php echo $this->_tpl_vars['row']['id_vendeur']; ?>
</td>
		<td><a href="?page=edit_vendeur&id_vendeur=<?php echo $this->_tpl_vars['row']['id_vendeur']; ?>
"><?php echo $this->_tpl_vars['row']['prenom']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['row']['nom'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a></td>
		<td><?php echo $this->_tpl_vars['row']['organisme']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['vendu']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['total']-$this->_tpl_vars['row']['vendu']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['total']; ?>
</td>
		<td>
		    <?php if ($this->_tpl_vars['row']['vendu'] == 0): ?><a href="?page=preventes_admin&action=suppr&id_vendeur=<?php echo $this->_tpl_vars['row']['id_vendeur']; ?>
"
		       onclick="return confirm('Voulez-vous vraiment supprimer <?php echo $this->_tpl_vars['row']['prenom']; ?>
 <?php echo $this->_tpl_vars['row']['nom']; ?>
?')">Supprimer</a><?php endif; ?>
		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</p>

<p>
Page <?php echo $this->_tpl_vars['index']+1; ?>
 sur <?php echo $this->_tpl_vars['counter']+1; ?>
<br />
<?php if ($this->_tpl_vars['index'] > 0): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']-1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Précédent</a><?php endif; ?>
 -
 <?php if ($this->_tpl_vars['counter'] > $this->_tpl_vars['index']): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']+1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Suivant</a><?php endif; ?>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>