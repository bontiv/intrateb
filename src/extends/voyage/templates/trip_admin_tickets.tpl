{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="tripusr" page="index" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li class="active">Types billets</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>

<div class="container container-fluid" style="margin-top: 30px;">

  {include "{$extendTpls}/trip_admin_head.tpl"}

  <div class="col-md-9">
    <h2>Gestion des types de billet</h2>
    <p>
      <a class="btn btn-default" href="{mkurl action="trip" page="ticket_add" trip=$trip->tr_id}">
        <span class="glyphicon glyphicon-plus"></span>
        Ajout
      </a>
    </p>
    {if isset($tickets)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Prix</th>
              <th>Restriction</th>
              <th>Places utilisées</th>
              <th>Gestion</th>
            </tr>
          </thead>
          <tbody>
            {foreach $tickets as $ticket}
                <tr>
                  <td>
                    {$ticket->tt_name}
                    {if $trip->raw_tr_deftype==$ticket->tt_id}
                        <div class="label label-primary">
                          Défault
                        </div>
                    {/if}
                  </td>
                  <td>{$ticket->tt_price}</td>
                  <td>{$ticket->tt_restriction}</td>
                  <td>???</td>
                  <td>
                    <div class="btn-group btn-group-xs">
                      <a href="{mkurl action="trip" page="ticket_edit" ticket=$ticket->tt_id}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                        Edition
                      </a>
                      <a href="{mkurl action="trip" page="ticket_delete" ticket=$ticket->tt_id}" class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-trash"></span>
                        Supprimer
                      </a>
                      {if $trip->raw_tr_deftype!=$ticket->tt_id}
                          <a href="{mkurl action="trip" page="ticket_default" ticket=$ticket->tt_id}" class="btn btn-info btn-xs">
                            <span class="glyphicon glyphicon-star"></span>
                            Défaut
                          </a>
                      {/if}
                    </div>
                  </td>
                </tr>
            {/foreach}
          </tbody>
        </table>
    {else}
        <div class="alert alert-danger">
          Aucun types de billet.
        </div>
    {/if}
  </div>
</div>
{include "foot.tpl"}
