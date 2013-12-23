<?php /* Smarty version 2.6.26, created on 2013-08-19 22:22:43
         compiled from pointor.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'pointor.html', 82, false),)), $this); ?>
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
<table class="table table-striped">
	<tr>
		<td>Nom</td>
		<td>Code</td>
		<td>Credits</td>
		<td>Types concerne</td>
		<td></td>
	</tr>
<?php $_from = $this->_tpl_vars['pointor']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
		<td<?php if ($_GET['list'] == $this->_tpl_vars['row']['p_id']): ?> class="active" style="font-weight: bold;"<?php endif; ?>><a href="?page=pointor&list=<?php echo $this->_tpl_vars['row']['p_id']; ?>
"><?php echo $this->_tpl_vars['row']['p_desc']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['row']['p_cb']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['p_cred']; ?>
</td>
		<td><?php $_from = $this->_tpl_vars['row']['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['typeRow']):
?><?php echo $this->_tpl_vars['typeRow']['t_desc']; ?>
,<?php endforeach; endif; unset($_from); ?></td>
		<td><a href="?page=pointor&supp=<?php echo $this->_tpl_vars['row']['p_id']; ?>
">Supp</a>
		<a href="?page=codes&code=<?php echo $this->_tpl_vars['row']['p_cb']; ?>
&label=<?php echo $this->_tpl_vars['row']['p_desc']; ?>
&format=PDF">Impr</a></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php if ($this->_tpl_vars['pointor_type']): ?>
<hr />
<?php if ($this->_tpl_vars['error']): ?>
<p style="color:red;font-size:18px;"><?php echo $this->_tpl_vars['error']; ?>
</p>
<?php endif; ?>
<form method="POST" action="?page=pointor&list=<?php echo $_GET['list']; ?>
">
<p>Ajout: <input class="form-control" type="text" id="add" name="addbc" /></p>
</form>

<?php echo '
<script type="text/javascript">
window.onload = function() {
	document.getElementById(\'add\').focus();
}
</script>
'; ?>


<table border="1">
	<tr style="font-weight:bold;">
		<td>Type</td>
		<td>Inscrit</td>
		<td>Restant</td>
		<td>Total</td>
	</tr>
<?php $_from = $this->_tpl_vars['pointor_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pt']):
?>
	<tr>
		<td<?php if ($_GET['type'] == $this->_tpl_vars['pt']['pt_type']): ?> class="active"<?php endif; ?>><?php echo $this->_tpl_vars['pt']['t_desc']; ?>
</td>
		<td><a href="?page=pointor&list=<?php echo $_GET['list']; ?>
&extend=ok&type=<?php echo $this->_tpl_vars['pt']['pt_type']; ?>
"><?php echo $this->_tpl_vars['pt']['pt_counter']; ?>
</a></td>
		<td><a href="?page=pointor&list=<?php echo $_GET['list']; ?>
&extend=ko&type=<?php echo $this->_tpl_vars['pt']['pt_type']; ?>
"><?php echo $this->_tpl_vars['pt']['total']-$this->_tpl_vars['pt']['pt_counter']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['pt']['total']; ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>
<br/>
<p><a href="?page=pointor&list=<?php echo $_GET['list']; ?>
&op=truncate">Vider</a></p>
<hr id="list" />

<?php if ($this->_tpl_vars['table']): ?>
<p>
Page <?php echo $this->_tpl_vars['index']+1; ?>
 / <?php echo $this->_tpl_vars['counter']+1; ?>
, Total <?php echo $this->_tpl_vars['total']; ?>
<br />
<?php if ($this->_tpl_vars['index'] > 0): ?><a href="?page=pointor&list=<?php echo $_GET['list']; ?>
&extend=<?php echo $_GET['extend']; ?>
&type=<?php echo $this->_tpl_vars['pt']['pt_type']; ?>
&index=<?php echo $this->_tpl_vars['index']-1; ?>
#list" >Prev</a><?php endif; ?>
 -
 <?php if ($this->_tpl_vars['counter'] > $this->_tpl_vars['index']): ?><a href="?page=pointor&list=<?php echo $_GET['list']; ?>
&extend=<?php echo $_GET['extend']; ?>
&type=<?php echo $this->_tpl_vars['pt']['pt_type']; ?>
&index=<?php echo $this->_tpl_vars['index']+1; ?>
#list" >Suiv</a><?php endif; ?>
</p>

<?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
<a href="?page=view&uid=<?php echo $this->_tpl_vars['row']['insc_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['lastname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo $this->_tpl_vars['row']['firstname']; ?>
 &lt;<?php echo $this->_tpl_vars['row']['email']; ?>
&gt;</a>,<br />
<?php endforeach; endif; unset($_from); ?>

<p>
Page <?php echo $this->_tpl_vars['index']+1; ?>
 / <?php echo $this->_tpl_vars['counter']+1; ?>
<br />
<?php if ($this->_tpl_vars['index'] > 0): ?><a href="?page=pointor&list=<?php echo $_GET['list']; ?>
&extend=<?php echo $_GET['extend']; ?>
&type=<?php echo $this->_tpl_vars['pt']['pt_type']; ?>
&index=<?php echo $this->_tpl_vars['index']-1; ?>
#list" >Prev</a><?php endif; ?>
 -
 <?php if ($this->_tpl_vars['counter'] > $this->_tpl_vars['index']): ?><a href="?page=pointor&list=<?php echo $_GET['list']; ?>
&extend=<?php echo $_GET['extend']; ?>
&type=<?php echo $this->_tpl_vars['pt']['pt_type']; ?>
&index=<?php echo $this->_tpl_vars['index']+1; ?>
#list" >Suiv</a><?php endif; ?>
</p>
<hr />
<?php endif; ?>
<div class="col-lg-6">
<form method="POST">
	<table class="table table-striped">
		<tr>
			<td><i>Nom</i></td>
			<td><input type="text" name="name" class="form-control"/></td>
		</tr>
		<tr>
			<td><i>Crédits</i></td>
			<td><input type="text" name="credits" class="form-control"/></tr>
		</tr>
		<tr>
			<td><i>Code</i></td>
			<td><input type="text" name="cb" class="form-control" onKeyPress="if (event.keyCode == 13) return (false);" /></td>
		</tr>
		<tr>
			<td><i>Concerne</i></td>
			<td><ul><?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?><li><input style="float:right;" type="checkbox" name="concerne[]" id="concerne_<?php echo $this->_tpl_vars['row']['t_id']; ?>
" value="<?php echo $this->_tpl_vars['row']['t_id']; ?>
" /><label for="concerne_<?php echo $this->_tpl_vars['row']['t_id']; ?>
"><?php echo $this->_tpl_vars['row']['t_desc']; ?>
</label></li><?php endforeach; endif; unset($_from); ?></ul></td>
		</tr>
		<tr>
			<td></td>
			<td><button  style="float:right;" class="btn" type="submit" value="Ajout">Ajout</button></td>
		</tr>
	</table>
</form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>