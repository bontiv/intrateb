{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="trip" page="view" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li class="active">Présentation</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>

<div class="container container-fluid" style="margin-top: 30px;">

  {include "{$extendTpls}/trip_admin_head.tpl"}

  <div class="col-md-9">
    <h2>Présentation du voyage</h2>
    <a class="btn btn-warning" href="{mkurl action="trip" page="edit" trip=$trip->tr_id}"><span class="glyphicon glyphicon-edit"></span> Modifier</a>
    <a class="btn btn-danger" href="{mkurl action="trip" page="delete" trip=$trip->tr_id}"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>


    <dl class="dl-horizontal">
      <dt>Départ</dt>
      <dd>{$trip->tr_start|date_format:'%d/%m/%Y à %H:%M'}</dd>
      <dt>Retour</dt>
      <dd>{$trip->tr_end|date_format:'%d/%m/%Y à %H:%M'}</dd>
      <dt>Caution</dt>
      <dd>{$trip->tr_caution} €</dd>
      <dt>Nombre de places</dt>
      <dd>{$trip->tr_places}</dd>
    </dl>
  </div>
</div>
{include "foot.tpl"}