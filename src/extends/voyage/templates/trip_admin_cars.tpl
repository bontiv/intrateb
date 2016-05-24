{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="tripusr" page="index" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li class="active">Cars</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>

<div class="container container-fluid" style="margin-top: 30px;">

  {include "{$extendTpls}/trip_admin_head.tpl"}

  <div class="col-md-9">
    <h2>Gestion du transport</h2>
    <p>
      <a class="btn btn-default" href="{mkurl action="trip" page="car_add" trip=$trip->tr_id}">
        <span class="glyphicon glyphicon-plus"></span>
        Ajout
      </a>
    </p>
    {if isset($cars)}
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
            {foreach $cars as $car}
                <tr>
                  <td>{$car->tc_name}</td>
                  <td>{$car->tc_places}</td>
                  <td>???</td>
                  <td>
                    <div class="btn-group btn-group-xs">
                      <a href="{mkurl action="trip" page="car_edit" car=$car->tc_id}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                        Edition
                      </a>
                      <a href="{mkurl action="trip" page="car_delete" car=$car->tc_id}" class="btn btn-danger btn-xs">
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
          Aucun transport sur ce voyage.
        </div>
    {/if}
  </div>
</div>
{include "foot.tpl"}
