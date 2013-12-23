<?php /* Smarty version 2.6.26, created on 2013-08-10 16:30:39
         compiled from step3-2.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
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


<h2>Création de dossier <?php echo $this->_tpl_vars['event']; ?>
</h2>

<div class="progress progress-striped active">
	<div class="progress-bar progress-bar-info" style="width: 81.5%"></div>
</div>

<h3>Etape 3.1 - Validation du statut d'étudiant</h3>

<p>Nous avons besoin de vos identifier. Veillez vous connecter via votre pass SOCKS.</p>

<form method="POST">
	<table>
		<tr>
			<tbody>
				<tr>
					<td>Login</td>
					<td><input class="form-control" type="text" name="ionisLogin" /></td>
				</tr>
				<tr>
					<td>Pass SOCKS</td>
					<td><input class="form-control" type="password" name="ionisPass" /></td>
				</tr>
			</tbody>
		</tr>
	</table>

    <p><button class="btn" type="submit" value="Annuler ce groupe" name="previous">Annuler ce groupe</button>
    
<button style="float:right;" class="btn" type="submit" value="Etape suivante" name="next">Vérification</button></p>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>