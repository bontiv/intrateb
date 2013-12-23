<?php /* Smarty version 2.6.26, created on 2013-08-10 01:51:01
         compiled from step3-4.tpl */ ?>
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
	<div class="progress-bar progress-bar-info" style="width: 87.75%"></div>
</div>

<h3>Etape 3.2 - Informations complémentaires</h3>

<p>Nous avons besoin de quelques informations supplémentaires relatives à votre statut.</p>

<form method="POST">
<table>
	<tr>
		<tbody>
			<tr>
				<td>Taille de T-Shirt</td>
				<td>
					<select name="ionisLogin">
					    <option>S</option>
					    <option>M</option>
					    <option>L</option>
					    <option>XL</option>
					</select>
				</td>
			</tr>
		</tbody>
	</tr>
</table>
<br/>
<button class="btn" type="submit" value="Etape suivante" name="next">Étape suivante</button>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>