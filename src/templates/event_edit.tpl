{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li><a href="{mkurl action="event" page="view" event=$event->event_id}">{$event->event_name}</a></li>
  <li class="active">Edition</li>
</ol>


{if $success}
    <p class="alert alert-success">Enregistré !</p>
{/if}

{if $error}
    <p class="alert alert-danger">{$error}</p>
{/if}

<h1>Events</h1>
<h2>{$event->event_name}</h2>
<form action="{mkurl action="event" page="editpost" event=$event->event_id}" method="POST" class="form-horizontal">
  <fieldset>
    {$event->edit()}
  </fieldset>
  <p><input type="submit" class="btn btn-default" value="Sauvegarder" /></p>
</form>

{include "foot.tpl"}