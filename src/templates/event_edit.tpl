{include "head.tpl"}

{if $success}
    <p class="alert alert-success">Enregistré !</p>
{/if}

{if $error}
    <p class="alert alert-danger">{$error}</p>
{/if}

<h1>Events</h1>
<h2>{$event->event_name}</h2>    
<form action="{mkurl action="event" page="editpost" event=$event->event_id}" method="POST">
{$event->edit()}
<p><input type="submit" class="btn btn-default" value="Sauvegarder" /></p>
</form>

{include "foot.tpl"}