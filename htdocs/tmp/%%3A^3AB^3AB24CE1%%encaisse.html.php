<?php /* Smarty version 2.6.26, created on 2013-08-14 20:38:46
         compiled from encaisse.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<hr />

<table id="gradient-style" summary="Meeting Results">
	<tr style="font-weight:bold;">
		<td>Date</td>
		<td>nb. cheques</td>
		<td>total</td>
		<td></td>
	</tr>
<?php $_from = $this->_tpl_vars['encaisse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
		<td<?php if ($_GET['details'] == $this->_tpl_vars['row']['ecai_id']): ?> class="active"<?php endif; ?>><a href="?page=encaisse&details=<?php echo $this->_tpl_vars['row']['ecai_id']; ?>
"><?php echo $this->_tpl_vars['row']['date']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['row']['nbcheq']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['montant']; ?>
</td>
		<td><a href="?page=encaisse&supp=<?php echo $this->_tpl_vars['row']['ecai_id']; ?>
">Supp</a></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<div class="boiteSearch">
TOTAL: <?php echo $this->_tpl_vars['montant']; ?>


<?php if ($this->_tpl_vars['cheq']): ?>
<hr />
<p>Date : <?php echo $this->_tpl_vars['details']['date']; ?>
 / Total : <?php echo $this->_tpl_vars['details']['montant']; ?>
 / Nb. Cheques <?php echo $this->_tpl_vars['details']['nbcheq']; ?>
<br /></p>
<table border="1">
	<tr style="font-weight: bold">
		<td>Numero</td>
		<td>Emetteur</td>
		<td>Banque</td>
		<td>Montant</td>
		<td>Type</td>
		<td>Client</td>
	</tr>
	<?php $_from = $this->_tpl_vars['cheq']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
		<td><?php echo $this->_tpl_vars['row']['numero']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['emeteur']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['banque']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['montant']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['type']; ?>
</td>
		<td><a href="?page=view&uid=<?php echo $this->_tpl_vars['row']['uid']; ?>
"><?php echo $this->_tpl_vars['row']['firstname']; ?>
 <?php echo $this->_tpl_vars['row']['lastname']; ?>
</a></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>