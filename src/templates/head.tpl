<!DOCTYPE html>
<html>
  <head>
    <!-- Css -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <!-- /Css -->
    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/datetime-picker.min.js"></script>
    <!-- /Scripts -->

    <title>Epice Notator ! La terreur des assos !</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body background="../images/bg3.png" style="background-attachment: fixed; width: 100%; height: 100%; background-position: top center; z-index: 1; position: relative;">

    <nav class="navbar navbar-default" role="navigation">
      <div class="navar-header">
        <a class="navbar-brand" href="{mkurl action="index"}">EpiceNotator</a>
      </div>

      <div class="collapse navbar-collapse navbar-ex1-collapse" >
        <ul class="nav navbar-nav">
          {acl action="user"}
          <li><a href="{mkurl action="user"}">Utilisateurs</a></li>
            {/acl}
            {acl action="ecole"}
          <li><a href="{mkurl action="ecole"}">Ecoles</a></li>
            {/acl}
            {acl action="section"}
          <li><a href="{mkurl action="section"}">Sections</a></li>
            {/acl}
            {acl action="event"}
          <li><a href="{mkurl action="event"}">Events</a></li>
            {/acl}
            {acl action="note"}
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Notation
              <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{mkurl action="note"}">Notes</a></li>
              <li><a href="{mkurl action="bulletin"}">Bulletin</a></li>
              <li><a href="{mkurl action="reclam"}">Reclamation</a></li>
            </ul>
          </li>
          {/acl}
          {acl action="admin"}
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Admin
              <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{mkurl action="admin_modeles"}">Instances de donnée</a></li>
              <li><a href="{mkurl action="admin"}">Droits d'accès</a></li>
              <li><a href="{mkurl action="cards"}">Gestion des cartes</a></li>
            </ul>
          </li>
          {/acl}
        </ul>
        <div class="nav navbar-nav navbar-text pull-right dropdown">
          {if $_user}
              <a href="#" data-toggle="dropdown" role="menu" style="color:grey">
                {$_user.user_name}</a><b class="caret"></b>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li><a href="{mkurl action="index" page="logout"}">Déconnexion</a></li>
                <li><a href="{mkurl action="index" page="profile"}">Mon profile</a></li>
              </ul>
          {else}
              <a href="{mkurl action="index" page="login"}" style="color:grey">
                Connexion</a> - <a href="{mkurl action="index" page="create"}" style="color:grey">
                Inscription</a>
              {/if}
        </div>
      </div>

    </nav>
    <div class="container row col-md-offset-1">

      {if isset($hsuccess)}
          {if $hsuccess}
              <div class="alert alert-success"><p>Opération effectué avec succès.</p></div>
          {else}
              <div class="alert alert-danger"><p>Une erreur a empêché l'opération.</p></div>
          {/if}
      {/if}