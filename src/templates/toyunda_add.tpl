{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li><a href="{mkurl action="toyunda" page="index"}" class="active">Toyunda</a></li>
  <li><a href="{mkurl action="toyunda" page="add"}" class="active">Ajout d'une demande</a></li>
</ol>

{include "toyunda_menu.tpl"}

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
        <select class="form-control" name="version">
          {foreach $types as $type}
              <option value="{$type->tt_code}">{$type->tt_name}</option>
          {/foreach}
        </select>
        <span class="help-block">Version</span>
      </div>
    </div>

    <!-- Multiple Radios (inline) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="langue">Langue</label>
      <div class="col-md-4">
        {foreach $langs as $lang}
            <label class="radio-inline" for="langue-{$lang@index}">
              <input name="langue" id="langue-{$lang@index}" value="{$lang->tl_code}" {if $lang@first}checked="checked"{/if} type="radio">
              <img src="images/flags/png/{$lang->tl_flag}" alt="{$lang->tl_code}" />
            </label>
        {/foreach}
        <span class="help-block">Langue du titre</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="transition">Statut du titre</label>
      <div class="col-md-4">
        <select class="form-control" name="transition" id="transition">
          {foreach $trans as $tr}
              <option value="{$tr->tr_id}">{$tr->tr_to->ts_name}</option>
          {/foreach}
        </select>
        <span class="help-block">Statut de base</span>
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
