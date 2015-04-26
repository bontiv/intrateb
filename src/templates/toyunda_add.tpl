{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li><a href="{mkurl action="toyunda" page="index"}" class="active">Toyunda</a></li>
  <li><a href="#" class="active">Ajout d'une demande</a></li>
</ol>

<ul class="nav nav-pills">
  <li role="presentation"><a href="{mkurl action="toyunda" page="index"}">Liste des demandes</a></li>
  <li role="presentation" class="active"><a href="#">Ajout d'une demande</a></li>
  <li role="presentation" class="disabled"><a href="#">Liste complète</a></li>
</ul>

<br />

{if isset($errmsg)}
    <div class="panel panel-danger">
      <div class="panel-heading">
        Erreur
      </div>
      <div class="panel-body">
        <p>
          {$errmsg}
        </p>
      </div>
    </div>
{/if}

<form class="form-horizontal" method="POST">
  <fieldset>

    <!-- Form Name -->
    <legend>Ajout de demande</legend>

    <div class="panel panel-default">
      <div class="panel-body">
        <p>
          Vous pouvez utiliser ce formulaire pour proposer à l'équipe des
          timers de rajouter un titre dans la liste.
        </p>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="title">Titre</label>
      <div class="col-md-4">
        <input id="title" name="title" placeholder="" class="form-control input-md" required="" type="text">
        <span class="help-block">Titre de la musique</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="serie">Série</label>
      <div class="col-md-4">
        <input id="serie" name="serie" placeholder="" class="form-control input-md" type="text">
        <span class="help-block">Nom de la série - Optionnel</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="version">Version</label>
      <div class="col-md-4">
        <input id="version" name="version" placeholder="" class="form-control input-md" type="text">
        <span class="help-block">Version (OP / OST) - Optionnel</span>
      </div>
    </div>

    <!-- Multiple Radios (inline) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="langue">Langue</label>
      <div class="col-md-4">
        <label class="radio-inline" for="langue-0">
          <input name="langue" id="langue-0" value="FR" checked="checked" type="radio">
          <img src="images/flags/png/fr.png" alt="FR" />
        </label>
        <label class="radio-inline" for="langue-1">
          <input name="langue" id="langue-1" value="ANG" type="radio">
          <img src="images/flags/png/us.png" alt="ANG" />
        </label>
        <label class="radio-inline" for="langue-2">
          <input name="langue" id="langue-2" value="JAP" type="radio">
          <img src="images/flags/png/jp.png" alt="JAP" />
        </label>
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton"></label>
      <div class="col-md-4">
        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Valider</button>
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}
