<?php /* Smarty version 2.6.26, created on 2013-09-12 15:23:09
         compiled from createEmail.tpl */ ?>
<div class="row col-lg-1"></div>
	<div class="container col-lg-4 col-lg-offset-3" style="
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
	<h1><?php echo $this->_tpl_vars['event']; ?>
</h1>
	
	<p>Félicitation ! Vous venez de créer un compte pour créer des dossiers <?php echo $this->_tpl_vars['event']; ?>
.</p>
	<p>Avant que votre compte soit pleinement fonctionnel, vous devez cliquer sur le lien ci-dessous :</p>
	
	<p><a href="<?php echo $this->_tpl_vars['link']; ?>
">Cliquer ici</a></p>
</div>