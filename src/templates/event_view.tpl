{include "head.tpl"}

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
    <strong>Créateur de l'événement :</strong> <a href="{mkurl action="user" page="view" user=$event.user_id}">{$event.user_name}</a><br/>
    <strong>Evénement de la section :</strong> <a href="{mkurl action="section" page="details" section=$event.section_id}">{$event.section_name}</a><br/>
    <strong>Coef de l'évent :</strong> {$event.event_coef}<br/>
</p>

<h2>Sections</h2>
{acl action="event" page="addsection"}
<form action="{mkurl action="event" page="addsection" event=$event.event_id}" method="POST">
    <select name="es_section">
    {foreach from=$sections item="i"}
        <option value="{$i.section_id}">{$i.section_name}</option>
    {/foreach}
    </select>
    <input type="submit" class="btn btn-default" value="ajouter" />
</form>
    {/acl}
    <table width="100%" class="table table-striped">
        <thead>
            <th>Section</th>
            <th>Nombre de staffs</th>
            <th>Action</th>
        </thead>
        <tbody>
            {foreach from=$es item="i"}
                <tr>
                    <td><a href="{mkurl action="event" page="staff" section=$i.section_id event=$event.event_id}">{$i.section_name}</a></td>
                    <td>LOL</td>
                    <td><a class="btn btn-danger" href="{mkurl action="event" page="delsection" event=$event.event_id admsec=$i.section_id}"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
            {/foreach}
        </tbody>
    </table>

<h2>Participants</h2>
<p><i>Fonctionnalité à venir ... Ou pas !</i></p>

{include "foot.tpl"}