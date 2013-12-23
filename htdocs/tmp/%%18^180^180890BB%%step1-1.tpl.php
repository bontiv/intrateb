<?php /* Smarty version 2.6.26, created on 2013-09-18 00:16:41
         compiled from step1-1.tpl */ ?>
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
	<div class="progress-bar progress-bar-danger" style="width: 25%"></div>
</div>

<h3>Etape 1 - Informations civiles sur le participant</h3>

<p>Cette etape vous permet de renseigner des informations civiles sur le voyageur (surement vous ?). Ces informations
nous sont nécessaire pour que notre assurance puisse vous couvrir durant le voyage.</p>

<br/>

<form method="POST">
<div class="col-lg-8">
	<table class="table">
		<tr>
			<tbody>
				<tr>
					<td>Nom</td>
					<td><input class="form-control" type="text" value="<?php echo $this->_tpl_vars['default']['lastname']; ?>
" name="lastname"/></td>
				</tr>
				<tr>
					<td>Prénom</td>
					<td><input class="form-control" type="text" value="<?php echo $this->_tpl_vars['default']['firstname']; ?>
" name="firstname"/></td>
				</tr>
				<tr>
					<td>Adresse</td>
					<td><textarea class="form-control" name="address"><?php echo $this->_tpl_vars['default']['address']; ?>
</textarea></td>
				</tr>			
				<tr>
					<td>Code Postal</td>
					<td><input class="form-control" type="text" value="<?php echo $this->_tpl_vars['default']['cp']; ?>
" name="cp" /></td>
				</tr>
				<tr>
					<td>Ville</td>
					<td><input class="form-control" type="text" value="<?php echo $this->_tpl_vars['default']['town']; ?>
" name="town" /></td>
				</tr>
				<tr>
					<td>Téléphone</td>
					<td><input class="form-control" type="tel" value="<?php echo $this->_tpl_vars['default']['phone']; ?>
" name="phone" /></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input class="form-control" type="email" value="<?php echo $this->_tpl_vars['default']['email']; ?>
" name="email" /></td>
				</tr>
				<tr>
					<td>Date de naissance</td>
                    <td><input id="datepicker" class="form-control" type="text"   value="<?php echo $this->_tpl_vars['default']['born']; ?>
" name="born" /></td>
				</tr>
				<tr>
					<td>Cochez la case pour accepter les <a target="cgv" href="extra/CGV.pdf">CGV</a>.</td>
                    <td><input class="form-control" type="checkbox" value="true" name="cgv" /></td>
				</tr>
				<tr>
					<td></td>
					<td><button style="float:right;" class="btn" type="submit" name="next" value="Etape suivante">Étape suivante</button></td>
				</tr>
			</tbody>
		</tr>
	</table>
</div>  
</form>
</div>