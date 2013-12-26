{include "head.tpl"}

<h1>Fiche d'événement</h1>

<h2>Description</h2>
<p>
    <strong>Event :</strong> {$event.event_name}<br/>
    <strong>Description :</strong> {$event.event_desc}<br/>
    <strong>Début :</strong> {$event.event_start}<br/>
    <strong>Fin :</strong> {$event.event_end}<br/>
    <strong>Verrouillage des inscriptions :</strong> {$event.event_lock}<br/>
    <strong>Première étape de notation :</strong> {$event.event_note1}<br/>
    <strong>Deuxième étape de notation :</strong> {$event.event_note2}<br/>
    <strong>Créateur de l'événement :</strong> <a href="{mkurl action="user" page="view" user=$event.user_id}">{$event.user_name}</a><br/>
    <strong>Evénement de la section :</strong> <a href="{mkurl action="section" page="details" section=$event.section_id}">{$event.section_name}</a><br/>
    <strong>Coef de l'évent :</strong> {$event.event_coef}<br/>
</p>

<h2>Sections</h2>

<h2>Participants</h2>

{include "foot.tpl"}