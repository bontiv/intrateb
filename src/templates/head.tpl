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

    <title>Intranet EPITANIME</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{mkurl action="index"}">Intra EPITANIME</a>
        </div>


        <div class="collapse navbar-collapse" >
          <ul class="nav navbar-nav">
            {acl action="section"}
            <li><a href="{mkurl action="section"}">Sections</a></li>
              {/acl}
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">Outils
                <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{mkurl action="karaoke" page="play"}">Karaoke Play</a></li>
                <li><a href="{mkurl action="ftp" page="index"}">Comptes FTP</a></li>
                <li><a href="{mkurl action="toyunda" page="index"}">Toyunda</a></li>
                <li><a href="{mkurl action="developer" page="index"}">Développeurs</a></li>
              </ul>
            </li>
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
                {acl action="user"}
                <li><a href="{mkurl action="user"}">Utilisateurs</a></li>
                  {/acl}
                  {acl action="ecole"}
                <li><a href="{mkurl action="ecole"}">Ecoles</a></li>
                  {/acl}
                <li><a href="{mkurl action="admin_note"}">Notation</a></li>
                <li><a href="{mkurl action="ml"}">Mailling list</a></li>
                <li><a href="{mkurl action="admin_modeles"}">Instances de donnée</a></li>
                <li><a href="{mkurl action="admin"}">Droits d'accès</a></li>
                <li><a href="{mkurl action="cards"}">Gestion des cartes</a></li>
                <li><a href="{mkurl action="wifi"}">Gestion du wifi</a></li>
                <li><a href="{mkurl action="config"}">Configurations</a></li>
              </ul>
            </li>
            {/acl}
          </ul>
          <ul class="nav navbar-nav navbar-right">

            {if $_user}
                <li class="dropdown">
                  <a href="#" data-toggle="dropdown" role="menu" style="color:grey">
                    {$_user.user_name|escape} <b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="{mkurl action="index" page="logout"}">Déconnexion</a></li>
                    <li><a href="{mkurl action="index" page="profile"}">Mon profil</a></li>
                    <li><a href="{mkurl action="compta"}">Ma compta</a></li>
                  </ul>
                </li>
            {else}
                <li>
                  <a href="{mkurl action="index" page="login"}" style="color:grey">
                    Connexion
                  </a>
                </li>
                <li>
                  <a href="{mkurl action="index" page="create"}" style="color:grey">
                    Inscription
                  </a>
                </li>
            {/if}
          </ul>
        </div>
      </div>{* /container *}
    </div>{* /navbar *}
    <div class="container container-fluid">

      {if isset($hsuccess) or isset($smarty.get.hsuccess)}
          {if (isset($smarty.get.hsuccess) and $smarty.get.hsuccess==1) or (isset($hsuccess) and $hsuccess===true)}
              <div class="alert alert-success"><p>Opération effectué avec succès.</p></div>
          {elseif isset($hsuccess) and $hsuccess!==0 and $hsuccess!==false}
              <div class="alert alert-danger"><p>Une erreur a empêché l'opération : {$hsuccess}.</p></div>
          {else}
              <div class="alert alert-danger"><p>Une erreur a empêché l'opération.</p></div>
          {/if}
      {/if}