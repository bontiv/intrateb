<?php /* Smarty version 2.6.26, created on 2013-08-19 22:22:39
         compiled from offre.html */ ?>
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
				   
<h2>Ajouter des credits par groupe</h2>
<?php if ($this->_tpl_vars['msg']): ?>
<h2 style="color:#FF0000">Opperation effectue</h2>
<?php echo $this->_tpl_vars['msg']; ?>

<?php endif; ?>

<form method="post">
<table class="table table-striped">
	<tr>
		<td></td>
		<td><b>Ajouter des credits par groupe</b></td>
		<td><b>Defini les credits par groupe</b></td>
	</tr>
	<tr>
		<td>Groupe</td>
		<td><select style="float:right;" name="type" class="form-control">
				<option value="all" selected>Tous</option>
				<?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
					<option value="<?php echo $this->_tpl_vars['row']['t_id']; ?>
"><?php echo $this->_tpl_vars['row']['t_desc']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
		<td><select style="float:right;" name="type" class="form-control">
				<option value="all" selected>Tous</option>
				<?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
					<option value="<?php echo $this->_tpl_vars['row']['t_id']; ?>
"><?php echo $this->_tpl_vars['row']['t_desc']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Credits</td>
		<td><input style="float:right;" type="text" name="credits" class="form-control"/></td>
		<td><input style="float:right;" type="text" name="define" class="form-control" /></td>
	</tr>
	<tr>
		<td></td>
		<td><button style="float:right;" class="btn" type="submit" value="Go !">Go !</button></td>
		<td><button style="float:right;" class="btn" type="submit" value="Go !">Go ! </button></td>
	</tr>
</table>
</form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>