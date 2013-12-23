<?php /* Smarty version 2.6.26, created on 2013-09-05 17:25:47
         compiled from moderate.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="row col-lg-1"></div>
	<div class="container col-lg-8" style="
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


<h1>Administration du groupe <?php echo $this->_tpl_vars['groupe']['t_desc']; ?>
</h1>
<br/>
<table class="table table-striped table-hover">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>email</th>
        <th>Statut</th>
    </tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['person']):
?>
    <tr>
        <td><?php echo $this->_tpl_vars['person']['lastname']; ?>
</td>
        <td><?php echo $this->_tpl_vars['person']['firstname']; ?>
</td>
        <td><?php echo $this->_tpl_vars['person']['email']; ?>
</td>
        <td><?php if (! $this->_tpl_vars['person']['isSet']): ?>Non traité<?php endif; ?>
    <?php if ($this->_tpl_vars['person']['isOk']): ?>Accepté<?php endif; ?>
    <?php if ($this->_tpl_vars['person']['isSet'] && ! $this->_tpl_vars['person']['isOk']): ?>Refusé<?php endif; ?>
    -
    <?php if (! $this->_tpl_vars['person']['isOk'] || ! $this->_tpl_vars['person']['isSet']): ?><a href="?page=moderate&amp;id=<?php echo $this->_tpl_vars['groupe']['t_id']; ?>
&amp;accept=<?php echo $this->_tpl_vars['person']['insc_ID']; ?>
">Accepter</a><?php endif; ?>
    <?php if ($this->_tpl_vars['person']['isOk'] || ! $this->_tpl_vars['person']['isSet']): ?><a href="?page=moderate&amp;id=<?php echo $this->_tpl_vars['groupe']['t_id']; ?>
&amp;reject=<?php echo $this->_tpl_vars['person']['insc_ID']; ?>
">Refuser</a><?php endif; ?>
</td>
    </tr>
    <?php endforeach; else: ?>
        <tr>
            <td colspan="4">Aucune candidatures</td>
        </tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>