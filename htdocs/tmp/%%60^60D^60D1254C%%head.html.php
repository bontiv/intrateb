<?php /* Smarty version 2.6.26, created on 2013-12-22 17:04:32
         compiled from head.html */ ?>
<!DOCTYPE html>
<html>
  <head>
  	<!-- Css -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- /Css -->

    <!-- Scripts -->
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- /Scripts -->

	<title>Systeme de prevente - BDE EPITECH</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

	<body background="../images/bg3.png" style="background-attachment: fixed; width: 100%; height: 100%; background-position: top center; z-index: 1; position: relative;">

<nav class="navbar navbar-default" role="navigation">
    <div class="navar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" >
    		<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="?page=series">Intra Rising</a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse" >
      	<ul class="nav navbar-nav">
			<li><a href="?page=series" <?php if ($_GET['page'] == 'series'): ?>class="active"<?php endif; ?>>Series</a></li>
			<li><a href="?page=offre10" <?php if ($_GET['page'] == 'offre10'): ?>class="active"<?php endif; ?>>Offre groupe</a></li>
			<li><a href="?page=print" <?php if ($_GET['page'] == 'print'): ?>class="active"<?php endif; ?>>Impression</a></li>
			<li><a href="?page=encaisse" <?php if ($_GET['page'] == 'encaisse'): ?>class="active"<?php endif; ?>>Information</a></li>
	    </ul>
	    <p class="navbar-text pull-right" style="color:grey"> Nb. Tickets <?php echo $this->_tpl_vars['tot_vgr']; ?>
 / Restant <?php echo $this->_tpl_vars['rest']; ?>
</p>
	</div>
</nav>
	<?php if ($this->_tpl_vars['complet']): ?>
	<div class="alert alert-danger">
    	<button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Attention!</strong> Le nombre maximum de ventes est atteint.
    </div>
	<?php endif; ?>
<div class="container row">
