<?php /* Smarty version 2.6.26, created on 2013-08-19 22:23:34
         compiled from view_cars.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<a href="?page=view_cars&id=<?php echo $this->_tpl_vars['member']; ?>
">Actualiser</a>

<?php if ($this->_tpl_vars['error']): ?>
<p style="color:red;font-size:18px;"><?php echo $this->_tpl_vars['error']; ?>
</p>
<?php endif; ?>

<p>
<table border="1">
	<tr style="font-weight: bold;">
		<td>Nb.</td>
		<td>Participant</td>
		<td> </td>
	</tr>
<?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['car_part'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['car_part']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['row']):
        $this->_foreach['car_part']['iteration']++;
?>
	<tr>
		<td><?php echo ($this->_foreach['car_part']['iteration']-1)+1; ?>
</td>
		<td><a href="?page=view&uid=<?php echo $this->_tpl_vars['row']['insc_id']; ?>
"><?php echo $this->_tpl_vars['row']['firstname']; ?>
 <?php echo $this->_tpl_vars['row']['lastname']; ?>
</a></td>
		<td><a href="?page=view_cars&action=supp&id2=<?php echo $this->_tpl_vars['row']['insc_id']; ?>
&id=<?php echo $this->_tpl_vars['member']; ?>
">Sup</a></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</p>

<p>
<form method='POST' action="?page=view_cars&id=<?php echo $this->_tpl_vars['member']; ?>
">
code barre <input type='text' name='add_cb' id="add">
<script type="text/javascript">
document.getElementById('add').focus();
</script>
<input type='hidden' name='id_cars' value='<?php echo $this->_tpl_vars['member']; ?>
'>
<input type='submit' value='Ajouter'>
</form>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>