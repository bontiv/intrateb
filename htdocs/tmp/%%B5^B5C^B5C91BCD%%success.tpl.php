<?php /* Smarty version 2.6.26, created on 2013-09-05 17:21:51
         compiled from success.tpl */ ?>
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
		<h3>Redirection</h3>
		<p>Vous allez être rediriger dans quelques seconde. Ne recharger pas la page.</p>
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