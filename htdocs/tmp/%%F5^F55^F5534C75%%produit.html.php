<?php /* Smarty version 2.6.26, created on 2013-10-10 20:57:06
         compiled from produit.html */ ?>
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
<h3>Produits
	<a data-toggle="modal" href="#myModal" class="label label-info">
		<span class="glyphicon glyphicon-plus-sign"></span>
	</a>
</h3>
<br/>


  <table class="table table-striped">
    <tr><label>
      <td><label>Code</label></td>
      <td><label>Alcool</label></td>
      <td><label>Credits</label></td>
      <td><label>Description</label></td>
      <td><label>Nb. Vendu</label></td>
      <td></td>
    </tr>
    <?php $_from = $this->_tpl_vars['encaisse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
    <tr>
      <td><?php echo $this->_tpl_vars['row']['prod_cb']; ?>
</td>
      <td><?php if ($this->_tpl_vars['row']['alcool']): ?>Oui<?php else: ?>Non<?php endif; ?></td>
      <td><?php echo $this->_tpl_vars['row']['prod_price']; ?>
</td>
      <td><?php echo $this->_tpl_vars['row']['prod_desc']; ?>
</td>
      <td><?php echo $this->_tpl_vars['row']['ventes']; ?>
</td>
      <td><a href="?page=produit&supp=<?php echo $this->_tpl_vars['row']['prod_id']; ?>
"><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
  <hr>
  <table>
  	<tr>
  		<td>Total Alcool :</td>
  		<td><?php echo $this->_tpl_vars['VentesA']; ?>
</td>
  	</tr>
  	<tr>
  		<td>Total Soft :</td>
  		<td><?php echo $this->_tpl_vars['VentesS']; ?>
</td>
  	</tr>
  	<tr>
  		<td>Total des ventes :</td>
  		<td><?php echo $this->_tpl_vars['VentesA']+$this->_tpl_vars['VentesS']; ?>
</td>
  	</tr>
  </table>


<!-- modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" class="form-search">
				<div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		            <h4 class="modal-title"><strong >Ajout d'un produit</strong></h4>
				</div>
				<div class="modal-body">
					<table cellpadding="10px">
				      <tr>
					<td><label>CB</label></td>
					<td><input style="float:right;" type="text" name="cb" class="form-control"/></td>
				      </tr>
				      <tr>
					<td><label >Crédits</label></td>
					<td><input style="float:right;" type="text" name="credits" class="form-control"/></td>
				      </tr>
				      <tr>
					<td><label>Déscription</label></td>
					<td><input style="float:right;" type="text" name="desc" class="form-control"/></td>
				      </tr>
				      <tr>
					<td><label>Alcool</label></td>
					<td><input style="float:right;" type="checkbox" name="alcool" value="yes" class="input-medium search-query"/></td>
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