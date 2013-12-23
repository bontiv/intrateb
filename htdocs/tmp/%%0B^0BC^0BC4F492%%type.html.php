<?php /* Smarty version 2.6.26, created on 2013-09-12 00:18:12
         compiled from type.html */ ?>
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
<h3>Groupes
	<a data-toggle="modal" href="#myModal" class="label label-info">
		<span class="glyphicon glyphicon-plus-sign"></span>
	</a>
</h3>
<br/>

<table class="table table-striped">
	<tr>
		<td>Code</td>
		<td>Alcool</td>
		<td>Description</td>
		<td>Vendable</td>
		<td>Credits</td>
		<td>Prix</td>
		<td>Nombre</td>
		<td></td>
	</tr>
<?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
		<td><?php echo $this->_tpl_vars['row']['t_code']; ?>
</td>
		<td><?php if ($this->_tpl_vars['row']['t_alcool']): ?>Oui<?php else: ?>Non<?php endif; ?></td>
		<td><?php echo $this->_tpl_vars['row']['t_desc']; ?>
</td>
		<td><?php if ($this->_tpl_vars['row']['t_sell'] == 0): ?>Non<?php else: ?>Oui<?php endif; ?></td>
		<td><?php echo $this->_tpl_vars['row']['t_defcredits']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row']['t_price']; ?>
</td>
		<td><a href="?page=search&action=type&amp;type=<?php echo $this->_tpl_vars['row']['t_id']; ?>
"><?php echo $this->_tpl_vars['row']['count']; ?>
</a></td>
		<td><a href="?page=type&supp=<?php echo $this->_tpl_vars['row']['t_id']; ?>
"><span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" class="form-search">
				<div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		            <h4 class="modal-title"><strong >Ajout d'un groupe</strong></h4>
				</div>
				<div class="modal-body">
					<table class="table">
				      <tr>
					<td>
						<div class="input-group">
						  <span class="input-group-addon">Code</span>
						  <input type="number" name="code" class="form-control" onKeyPress="if (event.keyCode == 13) return (false);">
						</div>
					</td>
					<td>
						<div class="input-group">
						  <span class="input-group-addon">Déscription</span>
						  <input type="number" name="defcredits" class="form-control">
						</div>
					</td>
				      </tr>
				      <tr>
						<td>
							<div class="input-group">
							  <span class="input-group-addon">Crédits de base</span>
							  <input type="number" name="defcredits" class="form-control">
							</div>
						</td>
						<td>
							<div class="input-group">
							  <span class="input-group-addon">Prix</span>
							  <input type="number" name="price" class="form-control">
							</div>
						</td>
				      </tr>
				      <tr>
						<td>
							<div class="input-group">
							  <span class="input-group-addon">Alcool</span>
							  <button type="button" id="alcool" name="alcool" value="yes" class="btn btn-primary" data-toggle="button">Oui</button>
							</div>
						</td>
				      	<td>
				      		<div class="input-group">
							  <span class="input-group-addon">Vente entrée ?</span>
							  <button type="button" id="sell" name="sell" value="yes" class="btn btn-primary" data-toggle="button">Oui</button>
							</div>
				      	</td>
				      </tr>
				    </table>
				</div>
				<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" value="Ajout" class="btn btn-primary">Enregistrer</button>
          </div>
	   </form>
	</div>
  </div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>