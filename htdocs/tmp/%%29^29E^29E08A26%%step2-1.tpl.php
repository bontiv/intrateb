<?php /* Smarty version 2.6.26, created on 2013-09-18 00:17:12
         compiled from step2-1.tpl */ ?>
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
			<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
		</div>
		
		<h3>Etape 2 - Informations santé</h3>
		
		<p>Maintenant vous devez nous donner un peu plus d'information sur votre santé.
		Ces informations seront utiles sur les activités que vous pourrez faire ainsi
		que pour les repas qui vous seront proposés.</p>
		<br/>
		
		<form method="POST">
			<div class="col-lg-9">
				<table class="table">
					<tr>
						<tbody>
							<tr>
								<td>Avez-vous le mal des transports ?</td>
								<td><label>Oui <input type="radio" name="transp" value="1" <?php if ($this->_tpl_vars['default']['transp']): ?>checked<?php endif; ?> /></label> - <label>Non <input type="radio" name="transp" value="0" <?php if (! $this->_tpl_vars['default']['transp']): ?>checked<?php endif; ?> /></label></td>
							</tr>
							<tr>
								<td>Avez-vous le vertige ?</td>
								<td><label>Oui <input type="radio" name="vertig" value="1" <?php if (! $this->_tpl_vars['default']['vertig']): ?>checked<?php endif; ?> /></label> - <label>Non <input type="radio" name="vertig" value="0" <?php if (! $this->_tpl_vars['default']['vertif']): ?>checked<?php endif; ?> /></label></td>
							</tr>
							<tr>
								<td>Avez-vous des phobies ?</td>
								<td><textarea class="form-control" name="phob"><?php echo $this->_tpl_vars['default']['phob']; ?>
</textarea></td>
							</tr>
							<tr>
								<td>Quelles sont vos allergies ?</td>
								<td><textarea class="form-control" name="allerg"><?php echo $this->_tpl_vars['default']['allerg']; ?>
</textarea></td>
							</tr>
							<tr>
								<td>Quelles sont vos restriction allimentaires ?</td>
								<td><textarea class="form-control" name="alli"><?php echo $this->_tpl_vars['default']['alli']; ?>
</textarea></td>
							</tr>
							<tr>
								<td>Avez-vous des remarques particulières ?</td>
								<td><textarea class="form-control" name="remq"><?php echo $this->_tpl_vars['default']['remq']; ?>
</textarea><br /></td>
							</tr>
						</tbody>
					</tr>
				</table>
		    <button style="float:right;" class="btn" type="submit" name="next" value="Etpe suivante">Étape suivante</button>
		</form>
	</div>
</div>


<?php echo '<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://stats.bde-epitech.fr/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "5"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>'; ?>

<!-- End Piwik Code -->

</html>