{include "head.tpl"}

<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="trip" page="view" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li><a href="{mkurl action="trip" page="admin_tickets" trip=$trip->tr_id}">Billets</a></li>
  <li class="active">Modification</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Modification billet <small>{$ticket->tt_name|escape}</small></h2>

<form action="{mkurl action="trip" page="ticket_edit" ticket=$ticket->tt_id}" method="POST" class="form-horizontal">
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
