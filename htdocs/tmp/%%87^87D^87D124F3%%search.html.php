<?php /* Smarty version 2.6.26, created on 2013-09-12 00:24:22
         compiled from search.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'search.html', 73, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="row col-lg-1"></div>
<div class="col-md-4" style="
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

<h3>Participants 
	<a data-toggle="modal" href="#myModal" class="label label-info">
		<span class="glyphicon glyphicon-plus-sign"></span>
	</a>
</h3>
<?php if ($this->_tpl_vars['search']): ?><h4><?php echo $this->_tpl_vars['search']; ?>
</h4><?php endif; ?>
  <br/>
  <form method="POST" action="?page=search" class="col-lg-12">
  
  
  <div class="input-group">
     <input type="text" name="search" id="search" class="form-control">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default" tabindex="-1"><span class="glyphicon glyphicon-search"></span></button>
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu pull-right" role="menu">
              	<li><a href="?page=search&action=inscrit">Inscrits</a></li>
              	<li><a href="?page=search&action=complet">Complets</a></li>
                <li><a href="?page=search&action=mineurs">Mineur</a></li>
                <li><a href="?page=search&action=resp">Sans décharge</a></li>
                <li><a href="?page=search&action=parent">Sans autorisation parental</a></li>
                <li><a href="?page=search&action=paie">Sans paiement</a></li>
                <li><a href="?page=search&action=caution">Sans caution</a></li>
              </ul>
            </div>
          </div>
  </form>  
    <script text="text/javascript">
		document.getElementById('search').focus();
    </script>
	
	<div>
	<br/><br/>
	  Page <?php echo $this->_tpl_vars['index']+1; ?>
 / <?php echo $this->_tpl_vars['counter']+1; ?>
, Total <?php echo $this->_tpl_vars['total']; ?>
<br />
	  <?php if ($this->_tpl_vars['index'] > 0): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']-1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Prev</a><?php endif; ?>
	  -
	  <?php if ($this->_tpl_vars['counter'] > $this->_tpl_vars['index']): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']+1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Suiv</a><?php endif; ?>
	</div>
	<div class="form-search">
	
	  <?php $_from = $this->_tpl_vars['table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	  <?php echo $this->_tpl_vars['row']['insc_id']; ?>
 <a href="?page=view&uid=<?php echo $this->_tpl_vars['row']['insc_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['lastname'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo $this->_tpl_vars['row']['firstname']; ?>
 &lt;<?php echo $this->_tpl_vars['row']['email']; ?>
&gt;</a>,<br />
	  <?php endforeach; endif; unset($_from); ?>
	</div>
	<p>
	  Page <?php echo $this->_tpl_vars['index']+1; ?>
 / <?php echo $this->_tpl_vars['counter']+1; ?>
<br />
	  <?php if ($this->_tpl_vars['index'] > 0): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']-1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Prev</a><?php endif; ?>
	  -
	  <?php if ($this->_tpl_vars['counter'] > $this->_tpl_vars['index']): ?><a href="?page=search&index=<?php echo $this->_tpl_vars['index']+1; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
" >Suiv</a><?php endif; ?>
	</p>
</div>

<!-- modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" class="form-search">
				<div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		            <h4 class="modal-title"><strong >Ajout manuel de participant</strong></h4>
				</div>
				<div class="modal-body">
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
				</div>
				<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name="newParticipant">Enregistrer</button>
          </div>
	   </form>
	   <script type="text/javascript">
		  document.getElementById('lastname').focus();
	   </script>
	</div>
  </div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>