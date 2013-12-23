<?php /* Smarty version 2.6.26, created on 2013-09-05 17:22:00
         compiled from error.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Erreur...</strong> <?php echo $this->_tpl_vars['error']; ?>

</div>
        <script type="text/javascript">
        window.setTimeout('document.location = "<?php if ($this->_tpl_vars['redirect']): ?><?php echo $this->_tpl_vars['redirect']; ?>
<?php else: ?>?page=home<?php endif; ?>";', 3000);
        </script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>