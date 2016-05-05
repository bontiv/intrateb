{include "head.tpl"}

<ol class="breadcrumb">
  <li class="active">Voyages</li>
</ol>

<h1>Voyages</h1>

<p>
  {acl action="trip" page="add"}
  <a class="btn btn-default" href="{mkurl action="trip" page="add"}"><span class="glyphicon glyphicon-plus"></span> Ajout</a>
  {/acl}
</p>

{if isset($trips)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Voyage</th>
          <th>Départ</th>
          <th>Retour</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach $trips as $trip}
            <tr>
              <td>{$trip->tr_name|escape}</td>
              <td>{$trip->tr_start|date_format:'%d/%m/%Y à %H:%M'}</td>
              <td>{$trip->tr_end|date_format:'%d/%m/%Y à %H:%M'}</td>
              <td>
                <div class="btn-group btn-group-xs">
                  <a href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-folder-open"></span> Dossiers</a>
                  <a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-wrench"></span> Admin</a>
                </div>
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-info">
      <p>
        Aucun voyage prochainement :(
      </p>
    </div>
{/if}

{include "foot.tpl"}
