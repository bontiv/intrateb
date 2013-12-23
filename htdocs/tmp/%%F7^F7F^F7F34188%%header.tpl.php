<?php /* Smarty version 2.6.26, created on 2013-09-12 15:15:10
         compiled from header.tpl */ ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Css -->
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/datepicker.css" rel="stylesheet">
        <!-- /Css -->

        <!-- Scripts -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.js"></script>
        <script src="../bootstrap/js/bootstrap-datepicker.js"></script>
	    <?php echo '<script>
		  $(function() {		    
		    $(\'#datepicker\').datepicker({
				format: \'yyyy-mm-dd\'
			});
		    
		  });
	   </script>'; ?>

        
        <!-- /Scripts -->
        <title><?php echo $this->_tpl_vars['event']; ?>
</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body  background="../images/bg3.png" style="background-attachment: fixed; width: 100%; height: 100%; background-position: top center; z-index: 1; position: relative;">
    
    
  <nav class="navbar navbar-default" role="navigation">
    <div class="navar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" >
    		<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="http://event.bde-epitech.fr/inscript/">Intra Rising</a>
    </div>
    
    <div class="collapse navbar-collapse navbar-ex1-collapse" >
      	<ul class="nav navbar-nav">
		  	<?php if ($this->_tpl_vars['session']): ?>
		  	<li><a href='?page=start'><span>Nouveau dossier</span></a></li>
		</ul>
        <ul class="nav navbar-nav navbar-right">
	    	<li class='dropdown'>
		    	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->_tpl_vars['session']['userLogin']; ?>

		        	<b class="caret"></b>
		        </a>
		        <ul class="dropdown-menu">
		        	<li><a href='?page=profile'><span>Profile de facturation</span></a></li>
					<li><a href='?page=connect&amp;logout=true'><span>Déconnexion</span></a></li>
		        </ul>
			</li>
        </ul>
        <?php else: ?>
        <ul class="nav navbar-nav pull-right">
        	<li class="dropdown">
            	<a href='?page=connect'><span>Connexion</span></a>
            </li>
		</ul>
        <?php endif; ?>
	</div>
 </nav>
 <div class="container row">
	 <div class="col-md-12">