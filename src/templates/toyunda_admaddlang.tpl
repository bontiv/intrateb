{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li>Toyunda</li>
  <li><a href="{mkurl action="toyunda" page="admlangs"}">Gestion des langues</a></li>
  <li class="active"><a href="{mkurl action="toyunda" page="admaddlang"}">Ajout d'une langue</a></li>
</ol>

{include "toyunda_menu.tpl"}

<form method="POST" action="{mkurl action="toyunda" page="admaddlang"}" class="form-horizontal">
  <fieldset>
    {$form}

    <div class="form-group">
      <label class="col-md-4 control-label" for="flag">Drapeau</label>
      <div class="col-md-4">
        <select name="tl_flag" class="form-control" id="flag">
          {foreach $flags as $flag}
              <option value="{$flag}">{$flag}</option>
          {/foreach}
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}