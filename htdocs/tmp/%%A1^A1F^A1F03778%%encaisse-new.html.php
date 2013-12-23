<?php /* Smarty version 2.6.26, created on 2013-09-11 23:51:24
         compiled from encaisse-new.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'encaisse-new.html', 21, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="?page=encaisse" method="POST">
<div class="row col-lg-1"></div>
<div class="container col-lg-4" style="
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
	<p>Montant total : <?php echo $this->_tpl_vars['montant']; ?>
 / Nombre de cheques : <?php echo $this->_tpl_vars['total']; ?>
</p>
	
		<div class="input-group">
			<span class="input-group-btn">
				<button disabled="disable" type="submit" class="btn">date</button>
			</span>
			<input type="text" name="date" value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
" class="form-control col-lg-1"/>
		</div>
</div>
</div>

<div class="row col-lg-1"></div>
<div class="container col-lg-4 col-lg-offset-3" style="
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
		<td></td>
		<td>Emetteur</td>
		<td>Banque</td>
		<td>Montant</td>
		<td>Client</td>
	</tr>
<?php $_from = $this->_tpl_vars['cheque']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
		<td><input type="checkbox" name="cheque[]" value="<?php echo $this->_tpl_vars['row']['cq_id']; ?>
" /></td>
		<td><?php echo $this->_tpl_vars['row']['emeteur']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['banque']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['montant']; ?>
</td>
		<td><a href="?page=view&uid=<?php echo $this->_tpl_vars['row']['insc_id']; ?>
"><?php echo $this->_tpl_vars['row']['lastname']; ?>
 <?php echo $this->_tpl_vars['row']['firstname']; ?>
 (<?php echo $this->_tpl_vars['row']['insc_id']; ?>
)</a></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<button style="float:right" type="submit" value="Valider" class="btn">Valider</button>
</div>
</div>

</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>