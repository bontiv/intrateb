<?php /* Smarty version 2.6.26, created on 2013-08-09 20:17:23
         compiled from profile.tpl */ ?>
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



<h2>Profile de facturation</h2>

<p>Cette etape vous permet de renseigner des informations civiles. Ces informations
nous sont nécessaire pour que notre assurance puisse vous couvrir durant le voyage.
et pour votre facturation.</p>
<br/>

<form method="POST">
<div class="col-lg-8">
	<table class="table">
		<tr>
			<tbody>
				<tr>
					<td>Nom</td>
					<td><input class="form-control" value="<?php echo $this->_tpl_vars['profile']->lastname; ?>
" type="text" <?php if ($this->_tpl_vars['profile']->lastname): ?>disabled<?php endif; ?> name="lastname" /></td>
				</tr>
				<tr>
					<td>Prénom</td>
					<td><input class="form-control" value="<?php echo $this->_tpl_vars['profile']->firstname; ?>
" type="text" <?php if ($this->_tpl_vars['profile']->firstname): ?>disabled<?php endif; ?> name="firstname"/></td>
				</tr>
				<tr>
					<td>Sexe</td>
					<td><label>Homme <input type="radio" name="sexe" value="MR" <?php if ($this->_tpl_vars['profile']->civilite_id == 'MR'): ?>checked<?php endif; ?> <?php if ($this->_tpl_vars['profile']->civilite_id): ?>disabled<?php endif; ?> /></label> - <label>Femme <input type="radio" name="sexe" <?php if ($this->_tpl_vars['profile']->civilite_id == 'MME'): ?>checked<?php endif; ?> value="MME" <?php if ($this->_tpl_vars['profile']->civilite_id): ?>disabled<?php endif; ?> /></label></td>
				</tr>
				<tr>
					<td>Adresse</td>
					<td><textarea class="form-control" name="address"><?php echo $this->_tpl_vars['profile']->address; ?>
</textarea></td>
				</tr>			
				<tr>
					<td>Code Postal</td>
					<td><input class="form-control" type="number" value="<?php echo $this->_tpl_vars['profile']->zip; ?>
" name="cp" /></td>
				</tr>
				<tr>
					<td>Ville</td>
					<td><input class="form-control" type="text" value="<?php echo $this->_tpl_vars['profile']->town; ?>
" name="town" /></td>
				</tr>
				<tr>
					<td>Téléphone</td>
					<td><input class="form-control" type="tel" value="<?php echo $this->_tpl_vars['profile']->phone; ?>
" name="tel" /></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input class="form-control" type="email" value="<?php echo $this->_tpl_vars['profile']->email; ?>
" <?php if ($this->_tpl_vars['profile']->email): ?>disabled<?php endif; ?> name="email" /></td>
				</tr>
			</tbody>
		</tr>
	</table>
	<button class="btn" type="submit" name="save" value="Sauvegarder">Sauvegarder</button>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>