{include "head.tpl"}

{include "developer_head.tpl"}

<h1>Edition {$cli->ac_name}</h1>

<form class="form-horizontal" method="POST" action="{mkurl action=developer page=edit appli=$cli->ac_id}">
  <fieldset>

    <!-- Form Name -->
    <legend>Edition des Callbacks</legend>

    <!-- Textarea -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="callback">Callbacks</label>
      <div class="col-md-6">
        <textarea class="form-control" id="callback" name="callback">{$cli->ac_callback}</textarea>
        <span class="help-block">Une adresse URL par ligne.</span>
      </div>
    </div>

    <!-- Button (Double) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="valid"></label>
      <div class="col-md-8">
        <button id="valid" name="valid" class="btn btn-success">Envoyer</button>
        <a href="{mkurl action=developer page=view appli=$cli->ac_id}" id="return" name="return" class="btn btn-danger">Retour</a>
      </div>
    </div>

  </fieldset>
</form>


{include "foot.tpl"}
