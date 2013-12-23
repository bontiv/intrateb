<?php /* Smarty version 2.6.26, created on 2013-09-12 15:22:45
         compiled from connect.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div class="row col-md-12"></div>
	<div class="container col-md-4 md-offset-3" style="
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

	<?php if ($this->_tpl_vars['error']): ?>

	<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Des erreurs sont survenues lors de l'opération :</strong>
        <ul>
	    <?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
	        <li><?php echo $this->_tpl_vars['msg']; ?>
</li>
	    <?php endforeach; endif; unset($_from); ?>
	    </ul>
      </div>
<?php endif; ?>

	<h1><?php echo $this->_tpl_vars['event']; ?>
</h1>
	<ul class="nav nav-tabs">
        <li class="active"><a href="#pane1" data-toggle="tab">Compte existant</a></li>
        <li><a href="#pane2" data-toggle="tab">Nouveau compte</a></li>
      </ul>

	<div class="tab-content">
		<div class="tab-pane active" id="pane1">
			<h3>Connexion</h3>
			<br/>
			<form method="POST">
				<div class="row">
			    	<div class="col-lg-8">
			    		<div class="input-group">
					      <span class="input-group-btn">
					        <button class="btn btn-default" disabled="disable" type="button">Utilisateur</button>
					      </span>
					      <input type="text" name="login" class="form-control">
					    </div><!-- /input-group -->
			    	<br/>
			    	<div class="input-group">
					  	<span class="input-group-btn">
					        <button class="btn btn-default" disabled="disable" type="button">Mot de passe</button>
					    </span>
					    <input type="password" name="password" class="form-control">
					</div><!-- /input-group -->
					<br/>
				        Captcha :
				        <img class="thumbnail" src="../libs/securimage/securimage_show.php" id="captcha"/><br/>
				        <div class="input-group">
					      <input type="text" name="captcha" class="form-control" placeholder="Récrire le captcha">
					      <span class="input-group-btn">
					        <button name="connect" class="btn btn-default" type="submit">Valider</button>
					      </span>
					    </div><!-- /input-group -->
			    	</div>
				</div>
			</form>
		<br/>
		</div>
		<div class="tab-pane" id="pane2">
			<h3>Inscription</h3>
			<br/>
			<form method="POST">
				<div class="row">
			    	<div class="col-lg-8">
			    		<div class="input-group">
							<span class="input-group-btn">
					        <button class="btn btn-default" disabled="disable" type="button"><small>Utilisateur</small></button>
					      </span>
					      <input type="text" name="login" class="form-control">
					    </div><!-- /input-group -->
			    	<br/>
					<div class="input-group">
					  	<span class="input-group-btn">
					        <button class="btn btn-default" disabled="disable" type="button"><small>Mot de passe</small></button>
					    </span>
					    <input type="password" name="password" class="form-control">
					</div><!-- /input-group -->
					<br/>
					    <input style="float:right;" placeholder="Retaper le mot de passe" type="password" name="password2" class="form-control"><br/><br/>
					<br/>
					<div class="input-group">
					  	<span class="input-group-btn">
					        <button class="btn btn-default" disabled="disable" type="button">Email</button>
					    </span>
					    <input type="email" name="email" class="form-control">
					</div><!-- /input-group -->
					<br/>
			        <button style="float:right;" class="btn btn-primary" type="submit" name="create" value="Inscription">Inscription</button>
			        <br/><br/>
			        <em>Pensez à vérifier vos spams !</em>
			    </p>
			</form>
		</div>
	</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>