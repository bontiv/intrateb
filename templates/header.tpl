<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Epice Notator 1.0</title>
    <link rel="stylesheet" href="{$assetURL}css/bootstrap.min.css" />
    <link rel="stylesheet" href="{$assetURL}css/bootstrap-responsive.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
          <a href="#" class="brand">Asso notator</a>

            <ul class="nav" role="navigation">
              <li{if $EXEC.controller=='info'} class="active"{/if}><a href="{$baseURL}info/notation">La notation</a></li>
              <li{if $EXEC.controller=='events'} class="active"{/if}><a href="{$baseURL}events/view">Events</a></li>
              <li{if $EXEC.controller=='note'} class="active"{/if}><a href="{$baseURL}note/view">Notes</a></li>
              <li{if $EXEC.controller=='bulletin'} class="active"{/if}><a href="{$baseURL}bulletin/view">Bulletin</a></li>
              <li class="dropdown{if $EXEC.controller=='admin'} active{/if}"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Administration <b class="caret"></b>
                <ul class="dropdown-menu">
                  <li><a href="{$baseURL}admin/users">Utilisateurs</a></li>
                  <li><a href="{$baseURL}admin/events">Evenements</a></li>
                </ul>
                </a>
            </ul>
              
          <div class="pull-right">
            <ul class="nav" role="navigation">
              <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">
                login_x <b class="caret"></b>
                <ul class="dropdown-menu">
                  <li><a href="{$baseURL}profil/logout">Déconnexion</a></li>
                  <li><a href="{$baseURL}profil/edit">Mon profile</a></li>
                </ul>
              </a></li>
            </ul>

          </div>

        </div>
      </div>
    </div>
<div class="container">