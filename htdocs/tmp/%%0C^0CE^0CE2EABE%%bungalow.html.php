<?php /* Smarty version 2.6.26, created on 2013-08-19 22:23:02
         compiled from bungalow.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="row col-lg-1"></div>
<div class="container col-lg-9" style="
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
<table class="table table-striped">
	<tr>
		<td>Nom</td>
		<td>Responsable</td>
		<td>Telephone</td>
		<td>Membres</td>
		<td>Places</td>
		<td></td>
	</tr>
<?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
		<td><a href='?page=view_bungalow&id=<?php echo $this->_tpl_vars['row']['bun_id']; ?>
'><?php echo $this->_tpl_vars['row']['bun_name']; ?>
</a></td>
		<td><a href="?page=view&uid=<?php echo $this->_tpl_vars['row']['insc_id']; ?>
"><?php echo $this->_tpl_vars['row']['firstname']; ?>
 <?php echo $this->_tpl_vars['row']['lastname']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['row']['phone']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['row']['bun_place_prise']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['bun_nb_place']; ?>
</td>
		<td><a href="?page=bungalow&action=supp&id=<?php echo $this->_tpl_vars['row']['bun_id']; ?>
">Supp</a></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</p>
<div>
<p>
<div class="col-lg-6">
<form method='POST'>
	<table class="table">
		<tr>
			<td>Num.Bungalow</td>
			<td><input type='text' name='add_bus' class="form-control"></td>
		</tr>
		<tr>
			<td>Nombre de place</td>
			<td><input type='text' name='place' class="form-control"></td>
		</tr>
		<tr>
			<td>Responsable</td>
			<td><input type='text' name='respo' class="form-control" onKeyPress="if (event.keyCode == 13) return (false);"></td>
		</tr>
		<tr>
			<td></td>
			<td><button style="float:right;" class="btn" type='submit' value='Ajouter'>Ajouter</button></td>
		</tr>
	</table>
</form>
</div>
</p>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>