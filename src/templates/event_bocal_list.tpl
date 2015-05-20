{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li><a href='{mkurl action="event" page="view" event=$event.event_id}'>{$event.event_name}</a></li>
  <li class="active">Tickets Bocal</li>
</ol>

{include "event_head.tpl"}

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="sections">
    {* Formulaire d'ajout *}
    {acl level="ADMINISTRATOR"}
    <form class="form-inline" method="POST" action="{mkurl action="event" page="bocal_add" event=$event.event_id}">
      <div class="row">
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Ajout</span>
            <input type="text" class="form-control" name="ticketid" placeholder="TicketID">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="submit"><div class="glyphicon glyphicon-plus-sign"></div></button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    </form>
    {/acl}
    {* Fin formulaire d'ajout *}

    {if isset($tickets)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Ticket ID</th>
              <th>Titre</th>
              <th>Statut</th>
              <th>Dernière MAJ</th>
            </tr>
          </thead>
          <tbody>
            {foreach $tickets as $t}
                <tr>
                  <td>{$t->eb_ticket}</td>
                  <td><a href="{mkurl action="event" page="bocal_view" event=$event.event_id ticket=$t->eb_id}">{$t->eb_title}</a></td>
                  <td>{$t->eb_state}</td>
                  <td>{$t->eb_last_update}</td>
                </tr>
            {/foreach}
          </tbody>
        </table>
    {else}
        <p class="alert alert-info">
          Il n'y a encore aucun ticket bocal pour cet événement.
        </p>
    {/if}
  </div>
</div>

{include "foot.tpl"}
