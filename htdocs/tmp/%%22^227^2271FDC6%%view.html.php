<?php /* Smarty version 2.6.26, created on 2013-09-18 00:17:30
         compiled from view.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
  tinyMCE.init({
  // General options
  mode : "textareas",
  theme : "advanced",
  plugins : "table,inlinepopups,save",

  // Theme options
  theme_advanced_buttons1 : "save,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,|,table,removeformat,code",
  theme_advanced_buttons2 : "",
  theme_advanced_buttons3 : "",
  theme_advanced_buttons4 : "",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_resizing : true
  });
</script>
'; ?>


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


  <h2>Fiche de <?php echo $this->_tpl_vars['member']['firstname']; ?>
 <?php echo $this->_tpl_vars['member']['lastname']; ?>
</h2>

  <div style="float:right;">
    <div class="btn-group">
      <button class="btn btn-warning btn-mini" onclick="self.location.href='?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
'">Actualiser</button>
    </div>
    <div class="btn-group">
      <a class="btn btn-danger btn-mini" role="button" data-toggle="modal" style="color:white; text-decoration:none;" href="#modalSupp">Supprimer</a>
    </div>
  </div>

  <br/><br/>

  <ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#Contact" data-toggle="tab">Contact</a></li>
    <li class=""><a href="#Info" data-toggle="tab">Information</a></li>
    <li class=""><a href="#Voyage" data-toggle="tab">Voyages</a></li>
    <li class=""><a href="#Divers" data-toggle="tab">Divers</a></li>
    <li class=""><a href="#Cheques" data-toggle="tab">Chèques</a></li>
    <li class=""><a href="#Conso" data-toggle="tab">Consomations</a></li>
  </ul>

  <br/>
  <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="Contact">
      <!-- Contact -->
      <table class="table table-striped table-hover">
	<tr>
	  <td><b>Nom</b></td>
	  <td><?php echo $this->_tpl_vars['member']['lastname']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Prenom</b></td>
	  <td><?php echo $this->_tpl_vars['member']['firstname']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Login</b></td>
	  <td><?php echo $this->_tpl_vars['member']['login']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Email</b></td>
	  <td><?php echo $this->_tpl_vars['member']['email']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Téléphone</b></td>
	  <td><?php echo $this->_tpl_vars['member']['phone']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Adresse</b></td>
	  <td><?php echo $this->_tpl_vars['member']['address']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>CP</b></td>
	  <td><?php echo $this->_tpl_vars['member']['cp']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Ville</b></td>
	  <td><?php echo $this->_tpl_vars['member']['town']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Date de naissance</b></td>
	  <td><?php echo $this->_tpl_vars['member']['born']; ?>
</td>
	  <td></td>
	</tr>
      </table>
      </div>
      <!-- /Contact -->

      <!-- Information -->
    <div class="tab-pane fade" id="Info">
      <table class="table table-striped table-hover">
    <tr>
	  <td><b>Database</b></td>
	  <td><?php echo $this->_tpl_vars['member']['insc_id']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Code</b></td>
	  <td><?php echo $this->_tpl_vars['member']['token']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Ticket</b></td>
	  <td><form method="POST" action="?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
" style="margin:0px;"><input class="span2" style="border:none;min-width:100px;width:100%;background:<?php if ($this->_tpl_vars['member']['ticket']): ?>#CCFFCC<?php else: ?>#FFA78F<?php endif; ?>" type="text" name="ticket" value="<?php echo $this->_tpl_vars['member']['ticket']; ?>
" /></form></td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Credits</b></td>
	  <td><form method="POST" action="?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
">
	      <input type="hidden" name="action" value="credits" />
	      <input class="span2" style="border:none;min-width:100px;width:100%;background:<?php if ($this->_tpl_vars['member']['credits']): ?>#CCFFCC<?php else: ?>#FFA78F<?php endif; ?>" type="text" name="val" value="<?php echo $this->_tpl_vars['member']['credits']; ?>
" />
	  </form></td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Type</b></td>
	  <td><?php echo $this->_tpl_vars['member']['t_desc']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Associations</b></td>
	  <td><?php echo $this->_tpl_vars['member']['assos']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>PNJ</b></td>
	  <td><?php echo $this->_tpl_vars['member']['pnj']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Agent</b></td>
	  <td><?php echo $this->_tpl_vars['member']['agent']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Email de validation</b></td>
	  <td><?php echo $this->_tpl_vars['member']['mailok_txt']; ?>
</td>
	  <td><?php if ($this->_tpl_vars['member']['mailok']): ?><a href="?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
&action=mailok&val=0">Renvoyer</a><?php endif; ?></td>
	</tr>
      </table>
    </div>
    <!-- /Information -->

    <!-- Voyage -->
    <div class="tab-pane fade" id="Voyage">
      <table class="table table-striped table-hover">
	<tr>
	  <td><b>Prix</b></td>
	  <td><form method="GET" action="index.php">
	      <input type="hidden" value="view" name="page" />
	      <input type="hidden" value="<?php echo $this->_tpl_vars['member']['insc_id']; ?>
" name="uid" />
	      <input type="hidden" value="price" name="action" />
	      <input class="span2" type="text" style="border:none;min-width:100px;width:100%;" name="val" value="<?php echo $this->_tpl_vars['member']['price']; ?>
" />
	  </form></td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Car</b></td>
	  <td><?php if ($this->_tpl_vars['member']['id_cars']): ?><a href="?page=view_cars&id=<?php echo $this->_tpl_vars['member']['id_cars']; ?>
"><?php echo $this->_tpl_vars['member']['car_name']; ?>
</a><?php else: ?>Orphelin<?php endif; ?></td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Decharge</b></td>
	  <td><?php echo $this->_tpl_vars['member']['resp_txt']; ?>
</td>
	  <td><a href="?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
&action=resp&val=<?php echo $this->_tpl_vars['member']['resp']; ?>
">Changer</a></td>
	</tr>
	<tr>
	  <td><b>Autorisation parental</b></td>
	  <td><?php echo $this->_tpl_vars['member']['parent_txt']; ?>
</td>
	  <td><?php if ($this->_tpl_vars['member']['parent'] >= 0): ?><a href="?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
&action=parent&val=<?php echo $this->_tpl_vars['member']['parent']; ?>
">Changer</a><?php endif; ?></td>
	</tr>
	<tr>
	  <td><b>Paiement</b></td>
	  <td><?php echo $this->_tpl_vars['member']['paie_txt']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Caution</b></td>
	  <td><?php echo $this->_tpl_vars['member']['caution_txt']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Phobie</b></td>
	  <td><?php echo $this->_tpl_vars['member']['phob']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Vertige</b></td>
	  <td><?php echo $this->_tpl_vars['member']['vertig']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Transpot</b></td>
	  <td><?php echo $this->_tpl_vars['member']['transp']; ?>
</td>
	  <td></td>
	</tr>
	<tr>
	  <td><b>Alergies</b></td>
	  <td><?php echo $this->_tpl_vars['member']['alli']; ?>
</td>
	  <td></td>
	</tr>
      </table>
    </div>
    <!-- /Voyage -->

    <!-- Divers -->
    <div class="tab-pane fade" id="Divers">
      <form method="POST" action="?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
">
	<textarea name="memo"><?php echo $this->_tpl_vars['member']['memo']; ?>
</textarea>
      </form>
    </div>
    <!-- /Divers -->

    <!-- Chèques -->
    <div class="tab-pane fade" id="Cheques">
      <div>
	<a style="float:right;" data-toggle="modal" href="#myModal" class="btn btn-info">Ajouter un chèque
	  <span class="glyphicon glyphicon-plus-sign"></span>
	</a>
      </div>

      <table class="table table-striped table-hover">
	<tr>
	  <td><b>Numero</b></td>
	  <td><b>Emetteur</b></td>
	  <td><b>Banque</b></td>
	  <td><b>Montant</b></td>
	  <td><b>Type</b></td>
	  <td><b>Encaissement</b></td>
	  <td></td>
	</tr>
	<?php $_from = $this->_tpl_vars['cq']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<tr>
	  <td><?php echo $this->_tpl_vars['row']['numero']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['row']['emeteur']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['row']['banque']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['row']['montantcq']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['row']['type']; ?>
</td>
	  <td><?php if ($this->_tpl_vars['row']['encaisse']): ?><a href="?page=encaisse&details=<?php echo $this->_tpl_vars['row']['ecai_id']; ?>
"><?php echo $this->_tpl_vars['row']['encaisse']; ?>
 / <?php echo $this->_tpl_vars['row']['date']; ?>
</a><?php endif; ?></td>
	  <td><?php if (! $this->_tpl_vars['row']['encaisse']): ?><a href="?page=view&uid=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
&suppcq=<?php echo $this->_tpl_vars['row']['cq_id']; ?>
">Supp.</a><?php endif; ?></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
      </table>
    </div>
    <!-- /Chèques -->

    <!-- Consomation -->
    <div class="tab-pane fade" id="Conso">
      <table width="100%" class="table table-striped table-hover">
	<tr>
	  <th>Date</th>
	  <th>Utilisateur</th>
	  <th>Produit</th>
	  <th>Description</th>
	  <th>Montant</th>
	</tr>
	<?php $_from = $this->_tpl_vars['conso']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['line']):
?>
	<tr>
	  <td><?php echo $this->_tpl_vars['line']['Date']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['line']['User']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['line']['prod_cb']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['line']['Desc']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['line']['Amount']; ?>
</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
      </table>
    </div>
    <!-- !Consomation -->
  </div>




  <!-- modal Supp-->

  <div id="modalSupp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content col-md-8">
		<form method="POST" class="form-search">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h4 class="modal-title"><strong >Suppression de la fiche</strong></h4>
		  </div>
		  <div class="modal-body">
		  	<p>Êtes-vous sur de vouloir supprimer la fiche de <?php echo $this->_tpl_vars['member']['firstname']; ?>
 <?php echo $this->_tpl_vars['member']['lastname']; ?>
 ?</p>
		  </div>
		  <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <a type="submit" href="?page=search&supp=<?php echo $this->_tpl_vars['member']['insc_id']; ?>
" class="btn btn-primary">Enregistrer</a>
          </div>
		</form>
      </div>
    </div>
  </div>


  <!-- modal Cheque-->

  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content col-md-8">
	<form method="POST" class="form-search">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h4 class="modal-title"><strong >Ajout d'un chèque</strong></h4>
	  </div>
	  <div class="modal-body">
	    <table class="table">
	      <tr>
		<td>
		  <div class="input-group">
		    <span class="input-group-addon">Emeteur</span>
		    <input type="text" name="emeteur" class="form-control">
		  </div>
		</td>
		<td>
		  <div class="input-group">
		    <span class="input-group-addon">Banque</span>
		    <input type="text" name="banque" class="form-control">
		  </div>
		</td>
	      </tr>
	      <tr>
		<td>
		  <div class="input-group">
		    <span class="input-group-addon">Montant</span>
		    <input type="number" name="montant" class="form-control">
		  </div>
		</td>
		<td>
		  <div class="input-group">
		    <span class="input-group-addon">Numéro</span>
		    <input type="number" name="numero" class="form-control">
		  </div>
		</td>
	      </tr>
	      <tr>
		<td>
		  Type <label for="paie">Paiement <input  type="radio" id="paie" name="type" value="paie"/></label>
		</td>
		<td>
		  <label for="caution">Caution <input type="radio" id="caution" name="type" value="caution"/></label>
		</td>
	      </tr>
	    </table>
	  </div>
	  <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" name="ncq" class="btn btn-primary">Enregistrer</button>
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