{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="trip" page="view" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li><a href="{mkurl action="trip" page="admin_options" trip=$trip->tr_id}">Compléments</a></li>
  <li class="active">{$option->topt_label|escape}</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>

<h2>Gestion des compléments</h2>
<h3>{$option->topt_label|escape} <small>{$option->topt_question}</small></h3>
<p>
  <a class="btn btn-default" href="{mkurl action="trip" page="opt_add" option=$option->topt_id}">
    <span class="glyphicon glyphicon-plus"></span>
    Ajout
  </a>
</p>
{if isset($ooptions)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Option</th>
          <th>Prix</th>
          <th>Gestion</th>
        </tr>
      </thead>
      <tbody>
        {foreach $ooptions as $ooption}
            <tr>
              <td>{$ooption->too_value|escape}</td>
              <td>{$ooption->too_price|escape} €</td>
              <td>
                <div class="btn-group btn-group-xs">
                  <a href="{mkurl action="trip" page="opt_edit" option=$ooption->too_id}" class="btn btn-warning btn-xs">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edition
                  </a>
                  <a href="{mkurl action="trip" page="opt_delete" option=$ooption->too_id}" class="btn btn-danger btn-xs">
                    <span class="glyphicon glyphicon-trash"></span>
                    Supprimer
                  </a>
                </div>
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-danger">
      Aucune option sur ce voyage. Au moins une option est obligatoire.
    </div>
{/if}
{include "foot.tpl"}
