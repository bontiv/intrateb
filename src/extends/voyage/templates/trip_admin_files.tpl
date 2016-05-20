{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="trip" page="view" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li class="active">Participants</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>

<div class="container container-fluid" style="margin-top: 30px;">

  {include "{$extendTpls}/trip_admin_head.tpl"}

  <div class="col-md-9">
    <h2>Gestion des participants</h2>

    <form class="form-inline" method="POST" action="{mkurl action="trip" page="search" trip=$trip->tr_id}">
      <div class="form-group">
        <input type="search" name="search" placeholder="Recherche" class="form-control" />
      </div>
      <div class="form-group">
        <button type="submit" class="form-actions btn btn-primary">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </div>
    </form>

    {if isset($ufiles)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Paiement</th>
              <th>Caution</th>
              <th>Décharge</th>
              <th>Gestion</th>
            </tr>
          </thead>
          <tbody>
            {foreach $ufiles as $ufile}
                <tr>
                  <td>
                    <a href="{mkurl action="tripadm" file=$ufile->tu_id}">
                      {if $ufile->raw_tu_participant==0}
                          {$ufile->tu_user->user_firstname|escape} {$ufile->tu_user->user_lastname|escape}
                      {else}
                          {$ufile->tu_participant->ta_firstname} {$ufile->tu_participant->ta_lastname}
                      {/if}
                  </td>
                  <td>
                    {if $ufile->raw_tu_payment=="YES"}
                        <div class="text-success">Déposé</div>
                    {else}
                        <div class="text-danger">Non déposé</div>
                    {/if}
                    </a>
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
                      <a href="{mkurl action="tripadm" page="index" file=$ufile->tu_id}" class="btn btn-warning btn-xs">
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
