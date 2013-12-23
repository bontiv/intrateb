<?php /* Smarty version 2.6.26, created on 2013-09-18 00:17:15
         compiled from step3-1.tpl */ ?>
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
	<div class="progress-bar progress-bar-info" style="width: 75%"></div>
</div>


<h3>Etape 3 - Groupe et tarif</h3>

<p>Le choix du groupe permet d'avoir un tarif préférentiel. Suivant le groupe
choisi, il peut y avoir une étape de validation supplémentaire auprès du 
représentant du groupe.</p>

<form method="POST">
<p>Groupes disponibles :</p>
<table class="table table-striped table-hover">
    <tr>
        <td></td>
        <td>Code</td>
        <td>Nom du groupe</td>
        <td>Prix de base</td>
        <td>Points de base*</td>
    </tr>
    <?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?>
        <tr>
            <td><input type="radio" name="type" value="<?php echo $this->_tpl_vars['type']['t_id']; ?>
" <?php if ($this->_tpl_vars['default']['type'] == $this->_tpl_vars['type']['t_id']): ?>checked<?php endif; ?> /></td>
            <td><?php echo $this->_tpl_vars['type']['t_code']; ?>
</td>
            <td><?php echo $this->_tpl_vars['type']['t_desc']; ?>
 <?php if ($this->_tpl_vars['type']['restricted']): ?><span style="color: #006dcc">(groupe restreint)</span><?php endif; ?> <?php if (! $this->_tpl_vars['type']['t_sell'] && $this->_tpl_vars['type']['nbModerate']): ?><span style="color: #f00"> (groupe modéré)</span><?php endif; ?></td>
            <td><?php echo $this->_tpl_vars['type']['t_price']; ?>
 &euro;</td>
            <td><?php echo $this->_tpl_vars['type']['t_defcredits']; ?>
</td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>

<button style="float:right;" class="btn" type="submit" value="Etape suivante" name="next">Étape suivante</button>
</form>
<br/>
<small><p><em>* Pour les événements faisant intervenir des crédits à point.</em></p></small>
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>