<?php /* Smarty version 2.6.26, created on 2013-09-18 00:10:58
         compiled from step4-1.tpl */ ?>
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
	<div class="progress-bar progress-bar-success" style="width: 94%"></div>
</div>

<h3>Etape 4 - Complétion du dossier</h3>

<p>Votre commande est maintenant passé. Vous pouvez télécharger votre bon de
    commande. Vous devez maintenant terminer de compléter votre dossier.</p>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
    <table class="table">
        <tr>
            <th>Document</th>
            <th>Statut</th>
            <th>Téléchargement</th>
        </tr>
        <tr>
            <td>CGV</td>
            <td><span style="color: #00CF0E">Validé</span></td>
            <td><a href="extra/CGV.pdf" target="cgv">Télécharger</a></td>
        </tr>
        <tr>
            <td>Bon de commande</td>
            <td><span style="color: #00CF0E">Validé</span></td>
            <td>Non disponible<!--<a href="?page=dossier&amp;step=4&amp;id=<?php echo $this->_tpl_vars['default']['insc_id']; ?>
&amp;action=command" target="cgv">Télécharger</a>--></td>
        </tr>
        <tr>
            <td>Décharge</td>
            <td><?php if ($this->_tpl_vars['default']['resp']): ?><span style="color: #00CF0E">Validé</span><?php else: ?><span style="color: red"> Requis</span><?php endif; ?></td>
            <td><a href="extra/decharge.pdf" target="decharge">Télécharger</a></td>
            <!--<td><input type="file" name="decharge" /></td>-->
        </tr>
        <tr>
            <td>Autorisation parentale</td>
            <td><?php if ($this->_tpl_vars['auth_need']): ?><?php if ($this->_tpl_vars['default']['parent']): ?><span style="color: #00CF0E">Validé</span><?php else: ?><span style="color: red"> Requis</span><?php endif; ?> <?php else: ?><span style="color: #2B6FB6">Non nécessaire</span><?php endif; ?></td>
            <td><a href="extra/parent.pdf" target="decharge">Télécharger</a></td>
            <!--<td><input type="file" name="decharge" /></td>-->
        </tr>
        <tr>
            <td>Caution de <?php echo $this->_tpl_vars['caution']; ?>
&euro;</td>
            <td><?php if ($this->_tpl_vars['default']['caution']): ?><span style="color: #00CF0E">Validé</span><?php else: ?><span style="color: red"> Requis</span><?php endif; ?></td>
            <td> - </td>
        </tr>
        <tr>
            <td>Paiement de <?php echo $this->_tpl_vars['default']['price']; ?>
&euro;</td>
            <td><?php if ($this->_tpl_vars['default']['paie']): ?><span style="color: #00CF0E">Validé</span><?php else: ?><?php if ($this->_tpl_vars['default']['price'] == 0): ?> <span style="color: #00CF0E">Non nécessaire</span> <?php else: ?><span style="color: red"> Requis</span><?php endif; ?><?php endif; ?></td>
            <td> - </td>
        </tr>
    </table>
</form>

<br/>
<small><p><em>Le dossier passera automatiquement à l'étape suivante une fois toutes les pièces fournies au BDE. Les chèques sont à remettre à l'ordre de "BDE EPITECH", et vous pouvez envoyez les pièces au BDE à l'adresse : "BDE Epitech, 24 Rue Pasteur, 94270 Le Kremlin-Bicêtre" ou bien les remettre au local du BDE. Pour toutes question merci de nous contacter par email à <a href="mailto:contact@bde-epitech.fr?subject=WEI 2013">contact@bde-epitech.fr</a> </em></p></small>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>