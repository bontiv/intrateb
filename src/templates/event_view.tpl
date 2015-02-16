{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li class="active">{$event.event_name}</li>
</ol>

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

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#sections" aria-controls="sections" role="tab" data-toggle="tab">Sections</a></li>
    <li role="presentation" class="disabled"><a href="#participants" aria-controls="participants" role="tab" data-toggle="tab">Participants</a></li>
    <li role="presentation" class="disabled"><a href="#fiche" aria-controls="fiche" role="tab" data-toggle="tab">Fiche event</a></li>
    <li role="presentation" class="disabled"><a href="#bocal" aria-controls="bocal" role="tab" data-toggle="tab">Tickets Bocal</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="sections">
      {acl action="event" page="addsection"}
      <div>
        <form class="form-inline" action="{mkurl action="event" page="addsection" event=$event.event_id}" method="POST">
          Ajout de section :
          <div class="form-group">
            <select class="form-control input-md" name="es_section">
              {foreach from=$sections item="i"}
                  <option value="{$i.section_id}">{$i.section_name}</option>
              {/foreach}
            </select>
          </div>
          <input type="submit" class="btn btn-default" value="ajouter" />
        </form>
      </div>
      {/acl}
      <table width="100%" class="table table-striped">
        <thead>
        <th>Section</th>
        <th>Nombre de staffs</th>
        <th>Candidature</th>
        <th>Action</th>
        </thead>
        <tbody>
          {foreach from=$es item="i"}
              <tr>
                <td><a href="{mkurl action="event" page="staff" section=$i.section_id event=$event.event_id}">{$i.section_name}</a></td>
                <td><div class="{if $i.staffs->count()>$i.es_needed}text-danger{elseif $i.staffs->count()==$i.es_needed}text-success{/if}">{$i.staffs->count()} / {$i.es_needed}</<div></td>
                      <td>
                      {if $i.cdat}{if $i.cdat.est_status=="OK"}<span class="label label-success">Accepté</span>{elseif $i.cdat.est_status=="NO"}<span class="label label-danger">Refusé</span>{else}<span class="label label-default">Candidat</span>{/if}{/if}
                    </td>
                    <td>
                      <a class="btn btn-danger" href="{mkurl action="event" page="delsection" event=$event.event_id admsec=$i.section_id}"><span class="glyphicon glyphicon-remove"></span></a>
                        {if not $i.cdat}
                        <a class="btn btn-primary" href="{mkurl action="event" page="joinsection" event=$event.event_id section=$i.section_id}"><span class="">Rejoindre</span></a>
                      {else}
                          <a class="btn btn-danger" href="{mkurl action="event" page="quitsection" event=$event.event_id section=$i.section_id}"><span class="">Quitter</span></a>
                      {/if}
                    </td>
                    </tr>
                  {/foreach}
                  </tbody>
                  </table>

                </div>
                <div role="tabpanel" class="tab-pane" id="participants">
                  <p>Fonctionnalité à venir.</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="fiche">
                  <p>Fonctionnalité à venir.</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="bocal">
                  <p>Fonctionnalité à venir.</p>
                </div>
              </div>

              </div>

              {include "foot.tpl"}