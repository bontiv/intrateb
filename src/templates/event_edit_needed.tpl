{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li><a href="{mkurl action="event" page="view" event=$es->es_event->event_id}">{$es->es_event->event_name}</a></li>
  <li><a href="{mkurl action=event page=staff event=$es->raw_es_event section=$es->raw_es_section}">Staffs {$es->es_section->section_name}</a></li>
  <li class="active">Edition</li>
</ol>

<h1>Staffs section {$es->es_section->section_name} sur {$es->es_event->event_name}</h1>
<h2>Section {$es->es_section->section_name}</h2>

<form class="form-horizontal" method="POST">
  <fieldset>

    <div class="form-group">
      <label class="col-md-4 control-label" for="count">Nombre de staffs requis</label>
      <div class="col-md-4">
        <input id="count" name="count" value="{$es->es_needed}" class="form-control input-md" required="" type="text">
        <span class="help-block">Indiquez le nombre de staff nécessaire pour votre section.</span>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-offset-4 col-md-8">
        <button id="button1id" type="submit" class="btn btn-success">Valider</button>
        <button id="button2id" type="reset" class="btn btn-danger">Réinitialiser</button>
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}
