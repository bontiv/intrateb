{include "head.tpl"}

<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="trip" page="view" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li><a href="{mkurl action="trip" page="admin_options" trip=$trip->tr_id}">Compléments</a></li>
  <li><a href="{mkurl action="trip" page="opt_list" option=$option->topt_id}">{$option->topt_label|escape}</a></li>
  <li class="active">Edition</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Edition d'une option <small>Complément {$option->topt_label} = {$ooption->too_value}</small></h2>

<p>{$option->topt_question}</p>

<form action="{mkurl action="trip" page="opt_add" option=$option->topt_id}" method="POST" class="form-horizontal">
  <fieldset>
    {$form}
  </fieldset>
  <fieldset>
    <div class="form-group">
      <div class="col-md-4 col-md-offset-4">
        <input class="btn btn-primary" value="Envoyer" type="submit" />
      </div>
    </div>
  </fieldset>
</form>

{include "foot.tpl"}