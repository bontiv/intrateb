<?php /* Smarty version 2.6.26, created on 2013-09-18 00:16:40
         compiled from home2.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<!-- ?delete=$dossier.insc_id -->

<?php echo '
    <script type="text/javascript">
        var dossier = \'\';

        function setDossier(newDossier) {
            dossier = "?delete=" + newDossier;
        }
    </script>
'; ?>


<div class="row col-lg-12"></div>

	<div class="container col-md-6" style="
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
			<?php echo $this->_tpl_vars['error']; ?>

		</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['success']): ?>
		<div class="alert alert-success">
			<?php echo $this->_tpl_vars['success']; ?>

		</div>
	<?php endif; ?>

	<p><h3>Evenement courant : <b><?php echo $this->_tpl_vars['event']; ?>
</b></h3><br/>

	<?php if (! $this->_tpl_vars['isLocked']): ?>
		<button class="btn btn-info" onclick="self.location.href='?page=start'">Créer un dossier</button></p>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['doc']): ?>
	    <p><h4>Vous avez crée les dossiers ci-dessous</h4></p>
	    <table class="table table-striped">
	        <tr>
	            <th>Nom</th>
	            <th>Prénom</th>
	            <th>Groupe</th>
	            <th>Date</th>
	            <th>Statut</th>
	            <th>Prix</th>
	            <th></th>
	        </tr>
	        <?php $_from = $this->_tpl_vars['doc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dossier']):
?>
	            <tr>
	                <td><?php if ($this->_tpl_vars['dossier']['isDeleted']): ?><span class="label label-danger">Supprimé</span><?php else: ?><?php echo $this->_tpl_vars['dossier']['lastname']; ?>
<?php endif; ?></td>
	                <td><?php echo $this->_tpl_vars['dossier']['firstname']; ?>
</td>
	                <td><?php echo $this->_tpl_vars['dossier']['t_desc']; ?>
</td>
	                <td><?php echo $this->_tpl_vars['dossier']['date']; ?>
</td>
	                <td><?php if (! $this->_tpl_vars['dossier']['isDeleted']): ?>
	                	<span <?php if (( $this->_tpl_vars['dossier']['step'] != "3-1" && $this->_tpl_vars['dossier']['step'] != '4' && $this->_tpl_vars['dossier']['step'] != '5' )): ?>
	                				class="label label-info"
                              <?php elseif ($this->_tpl_vars['dossier']['step'] === '5'): ?>
                                  class="label label-success"
	                		  <?php else: ?>
	                		  		class="label label-warning"
	                		  <?php endif; ?>

	                		  data-toggle="tooltip" data-placement="top" title
	                		  <?php if ($this->_tpl_vars['dossier']['step'] === "1-1"): ?>
		                		  data-original-title="Vous devez remplir les informations sur le participant, pour accéder à l'étape supérieur."

		                	  <?php elseif ($this->_tpl_vars['dossier']['step'] === '2'): ?>
		                		  data-original-title="Vous devez remplir les informations sur la santé participant, pour accéder à l'étape supérieur."

							  <?php elseif ($this->_tpl_vars['dossier']['step'] === '3'): ?>
		                		  data-original-title="Vous devez séléctionner le groupe auquel vous appartenez, pour accéder à l'étape supérieur."

		                	  <?php elseif ($this->_tpl_vars['dossier']['step'] === "3-1"): ?>
		                		  data-original-title="Vous devez attendre qu'un administrateur accepte votre demande pour intégrer le groupe sélectionné, pour accéder à l'étape supérieur."

		                	  <?php elseif ($this->_tpl_vars['dossier']['step'] === '4'): ?>
		                	  	  data-original-title="Vous envoyez votre dossier complet, pour validation."
		                	  <?php elseif ($this->_tpl_vars['dossier']['step'] === '5'): ?>
		                	  	  data-original-title="Votre dossier est complet."
							  <?php endif; ?>>

	                		<a href="?page=dossier&amp;step=<?php echo $this->_tpl_vars['dossier']['step']; ?>
&amp;id=<?php echo $this->_tpl_vars['dossier']['insc_ID']; ?>
" style="color:white; text-decoration:none;">Etape <?php echo $this->_tpl_vars['dossier']['step']; ?>

							</a>
						</span>
						<script>$('span').tooltip();</script>
                        <?php endif; ?>
	                </td>
	                <td><?php echo $this->_tpl_vars['dossier']['t_price']; ?>
 €</td>
	                <td><?php if ($this->_tpl_vars['isRetractable'] && ! $this->_tpl_vars['dossier']['isDeleted']): ?><a data-toggle="modal" onclick="setDossier('<?php echo $this->_tpl_vars['dossier']['insc_ID']; ?>
');" href="#deleteDossier"><span class="glyphicon glyphicon-trash"></span></a><?php endif; ?></td>
	            </tr>
	        <?php endforeach; endif; unset($_from); ?>
	    </table>
	<?php endif; ?>
	<script>
		$("a").tooltip();
	</script>

	<?php if ($this->_tpl_vars['admin']): ?>
	<p><h4>Groupes administrés </h4></p>
	<table class="table table-striped">
	    <tr>
	        <td>Code</td>
	        <td>Nom</td>
	        <td>Prix unitaires</td>
	    </tr>
	    <?php $_from = $this->_tpl_vars['admin']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupe']):
?>
	        <tr>
	            <td><a href="?page=moderate&amp;id=<?php echo $this->_tpl_vars['groupe']['t_id']; ?>
"><?php echo $this->_tpl_vars['groupe']['t_code']; ?>
</a></td>
	            <td><?php echo $this->_tpl_vars['groupe']['t_desc']; ?>
</td>
	            <td><?php echo $this->_tpl_vars['groupe']['t_price']; ?>
 &euro;</td>
	        </tr>
	    <?php endforeach; endif; unset($_from); ?>
	</table>
	<?php endif; ?>


	<div id="deleteDossier" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content col-md-8">
			<form method="POST" class="form-search">
				<div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		            <h4 class="modal-title"><strong >Suppression d'un dossier</strong></h4>
				</div>
				<div class="modal-body">
					Etes vous sur de vouloir supprimé ce dossier ?
				</div>
				<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <a onclick="document.location = dossier;" href="#" class="btn btn-primary">Valider</a>
          </div>
	   </form>
	</div>
  </div>
</div>

<hr>
<div class="col-lg-12">
	<footer class="row col-lg-12 bs-footer">
		<p><small>Date de rétractation maximale <span class="label label-info"><?php echo $this->_tpl_vars['RetractDate']; ?>
</span> et la date de fin d'enregistrement de dossier maximale <span class="label label-warning"><?php echo $this->_tpl_vars['LockDate']; ?>
</span></small></p>
		<em style="float:right;">&COPY; BDE Epitech</em>
	</footer>
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
</body>
</html>