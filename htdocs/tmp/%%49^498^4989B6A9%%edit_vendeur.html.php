<?php /* Smarty version 2.6.26, created on 2013-08-13 09:35:09
         compiled from edit_vendeur.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="container span6" style="
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
<h2>Détail des ventes de <?php echo $this->_tpl_vars['data_vendeur']['prenom']; ?>
 <?php echo $this->_tpl_vars['data_vendeur']['nom']; ?>
</h2>
<a href="?page=edit_vendeur&amp;id_vendeur=<?php echo $this->_tpl_vars['data_vendeur']['id_vendeur']; ?>
&amp;action=connectas" target="_blank">Se connecter en tant que <?php echo $this->_tpl_vars['data_vendeur']['prenom']; ?>
 <?php echo $this->_tpl_vars['data_vendeur']['nom']; ?>
</a>
<table class="table table-striped">	
	<thead>
		<tr>
			<td>Série</td>
			<td>Date</td>
			<td>Tickets vendus</td>
			<td>Tickets restant</td>
			<td>Total tickets</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	<?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
		<tr>
			<td><?php echo $this->_tpl_vars['row']['id_serie']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['date']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['vendu']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['total']-$this->_tpl_vars['row']['vendu']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['total']; ?>
</td>
			<td><?php if ($this->_tpl_vars['row']['vendu'] == 0): ?><a href="?page=edit_vendeur&amp;id_vendeur=<?php echo $this->_tpl_vars['data_vendeur']['id_vendeur']; ?>
&amp;supp=<?php echo $this->_tpl_vars['row']['id_serie']; ?>
" onclick="return confirm('Etes-vous sur de vouloir supprimer cette serie ?')">Supp</a><?php endif; ?></td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>
<div class="boiteSession">

	<h3>Ajouter une nouvelle série</h3>

	<form method='POST' action="?page=edit_vendeur&amp;id_vendeur=<?php echo $this->_tpl_vars['data_vendeur']['id_vendeur']; ?>
" name="add_serie" onsubmit="return confirm('Ajouter une serie de ' + add_serie.nouveaux_tickets.value + '?')">
	Tickets à vendre : <input class="span2" type='text' name='nouveaux_tickets' size=5><br />
	<button class="btn" type='submit' value='Donner une nouvelle série de tickets'>Donner une nouvelle série de tickets</button>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>