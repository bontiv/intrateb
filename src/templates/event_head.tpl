<h1>Fiche d'événement</h1>

<div class="btn-group">
  <a class="btn btn-danger" href="{mkurl action="event" page="delete" event=$event.event_id}">Supprimer</a>
  <a class="btn btn-warning" href="{mkurl action="event" page="edit" event=$event.event_id}">Modifier</a>
</div>

<h2>Description</h2>
<p>
  <strong>Event :</strong> {$event.event_name}<br/>
  <strong>Description :</strong> {$event.event_desc}<br/>
  <strong>Début :</strong> {$event.event_start}<br/>
  <strong>Fin :</strong> {$event.event_end}<br/>
  <strong>Verrouillage des inscriptions :</strong> {$event.event_lock}<br/>
  <strong>Première étape de notation :</strong> {$event.event_note1}<br/>
  <strong>Deuxième étape de notation :</strong> {$event.event_note2}<br/>
  <strong>Créateur de l'événement :</strong> <a href="{mkurl action="user" page="view" user=$event.user_id}">{$event.user_name|escape}</a><br/>
  <strong>Evénement de la section :</strong> <a href="{mkurl action="section" page="details" section=$event.section_id}">{$event.section_name}</a><br/>
  <strong>Coef de l'évent :</strong> {$event.event_coef}<br/>
</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="{if $smarty.get.page == "view"}active{/if}"><a href="{mkurl action="event" page="view" event=$event.event_id}">Sections</a></li>
  <li class="disabled"><a>Participants</a></li>
  <li class="disabled"><a>Fiche event</a></li>
  <li class="{if $smarty.get.page == "bocal_list"}active{/if}"><a href="{mkurl action="event" page="bocal_list" event=$event.event_id}">Tickets Bocal</a></li>
</ul>
