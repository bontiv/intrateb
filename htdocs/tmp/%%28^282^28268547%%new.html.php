<?php /* Smarty version 2.6.26, created on 2013-08-19 22:20:36
         compiled from new.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="row col-lg-1"></div>
<div class="col-lg-4" style="
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
<?php if ($this->_tpl_vars['mesg']): ?>
<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Message </strong> <?php echo $this->_tpl_vars['mesg']; ?>

</div>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Erreur ! </strong> <?php echo $this->_tpl_vars['error']; ?>

</div>
<?php endforeach; endif; unset($_from); ?>
<form method="POST" class="form-search">
  <h2>Ajout manuel de participant</h2>
  <div >
    <table cellpadding="10px">
      <tr>
	<td><label for="lastname">Nom</label></td>
	<td><input style="float:right;" type="text" name="lastname" id="lastname" class="form-control"/></td>
      </tr>
      <tr>
	<td><label for="firstname">Prenom</label></td>
	<td><input style="float:right;" type="text" name="firstname" id="firstname" class="form-control"/></td>
      </tr>
      <tr>
	<td><label for="type">Type</label></td>
	<td><select class="form-control" style="float:right;" name="type" id="type"><?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?><option value="<?php echo $this->_tpl_vars['row']['t_id']; ?>
" <?php if ($_POST['type'] == $this->_tpl_vars['row']['t_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['row']['t_desc']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
      </tr>
      <tr>
	<td><label for="ticket">Bracelet (facultatif)</label></td>
	<td><input style="float:right;" type="text" name="ticket" id="ticket" class="form-control"/></td>
      </tr>
    </table>
    <button style="float:right;" type="submit" name="newParticipant" value="Enregistrer" class="btn btn-success"> Enregistrer </button>
  </div>
</form>

<script type="text/javascript">
  document.getElementById('lastname').focus();
</script>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>