<?php /* Smarty version 2.6.26, created on 2013-09-11 23:51:21
         compiled from caisse.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="row col-lg-1"></div>
<div class="container col-lg-5" style="
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
<h3>Caisses
	<a data-toggle="modal" href="#myModal" class="label label-info">
		<span class="glyphicon glyphicon-plus-sign"></span>
	</a>
</h3>
<br/>
  <table class="table table-striped">
    <tr>
      <td>ID</td>
      <td>Description</td>
      <td>Max</td>
      <td>Montant</td>
      <td></td>
    </tr>
    <?php $_from = $this->_tpl_vars['caisse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
    <tr>
      <td><?php echo $this->_tpl_vars['row']['caisse_id']; ?>
</td>
      <td><a href="?page=caisse-row&caisse=<?php echo $this->_tpl_vars['row']['caisse_id']; ?>
"><?php echo $this->_tpl_vars['row']['caisse_desc']; ?>
</a></td>
      <td><?php echo $this->_tpl_vars['row']['caisse_max']; ?>
 &euro;</td>
      <td><?php echo $this->_tpl_vars['row']['caisse_montant']; ?>
 &euro;</td>
      <td><a href="?page=caisse&supp=<?php echo $this->_tpl_vars['row']['caisse_id']; ?>
">Supp</a></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>

<!-- modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content col-md-8">
			<form method="POST" class="form-search">
				<div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		            <h4 class="modal-title"><strong >Ajout d'une caisse</strong></h4>
				</div>
				<div class="modal-body">
					<table class="table">
				      <tr>
						<td>
							<div class="input-group">
							  <span class="input-group-addon">Déscription</span>
							  <input type="text" name="desc" class="form-control">
							</div>
						</td>
				      </tr>
				      <tr>
						<td>
							<div class="input-group">
							  <span class="input-group-addon">Montant maximum</span>
							  <input type="number" name="max" class="form-control">
							</div>
						</td>
				      </tr>
				    </table>
				</div>
				<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
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