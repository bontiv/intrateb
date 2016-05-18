{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="trip" page="view" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li class="active">Cars</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>

<div class="container container-fluid" style="margin-top: 30px;">

  {include "{$extendTpls}/trip_admin_head.tpl"}

  <div class="col-md-9">
    <h2>Gestion des utilisateurs</h2>
    {if isset($ufiles)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Places prises</th>
              <th>Places disponibles</th>
              <th>Gestion</th>
            </tr>
          </thead>
          <tbody>
            {foreach $ufiles as $ufile}
                <tr>
                  <td>TODO: DISPLAY NAME</td>
                  <td> 
                  {if $ufile->raw_tu_payment=="YES"}
                    <div class="text-success">Déposé</div>
                  {else}
                    <div class="text-danger">Non déposé</div>
                  {/if}
                  </td>
                  <td>
                    {if $ufile->raw_tu_caution=="YES"}
                        <div class="text-success">Déposé</div>
                    {else}
                        <div class="text-danger">Non déposé</div>
                    {/if}
                  </td>
                  <td>
                    {if $ufile->raw_tu_responsability_agreement=="YES"}
                        <div class="text-success">Déposé</div>
                    {else}
                        <div class="text-danger">Non déposé</div>
                    {/if}
                  </td>
                  <td>
                    <div class="btn-group btn-group-xs">
                      <a href="{mkurl action="trip" page="files_edit" file=$ufile->tu_id}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                        Edition
                      </a>
                      <a href="{mkurl action="trip" page="files_delete" file=$ufile->tu_id}" class="btn btn-danger btn-xs">
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
        <div class="alert alert-warning">
          Aucun utilisateur sur ce voyage.
        </div>
    {/if}
  </div>
</div>
{include "foot.tpl"}
