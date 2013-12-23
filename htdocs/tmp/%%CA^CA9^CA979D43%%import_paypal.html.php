<?php /* Smarty version 2.6.26, created on 2013-08-19 22:23:50
         compiled from import_paypal.html */ ?>
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
<h2>Import des preventes paypal</h2>
<p>
	<form method="POST" class="form-search">
	<div class="row">
	  <div class="col-lg-6">
	  	Mot de passe d'importation :<br />
	    <div class="input-group">
	      <input type="password" name="password" class="form-control">
	      <span class="input-group-btn">
	        <button type="submit" value="valider" class="btn" >Valider</button>
	      </span>
	    </div><!-- /input-group -->
	</form>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>