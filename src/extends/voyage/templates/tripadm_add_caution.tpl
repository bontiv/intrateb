{include "head.tpl"}

<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation"><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li role="presentation"><a href="{mkurl action="trip" page="admin_files" trip=$trip->tr_id}">Participants</a></li>
  <li role="presentation"><a href="{mkurl action="tripadm" page="order" file=$ufile->tu_id}">Trésorerie</a></li>
  <li role="presentation" class="active">Ajout d'un dépôt</li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Dossier participant {$ufile->tu_id}</h2>
<h3>Ajout d'une caution</h3>

<form class="form-horizontal" method="POST" action="{mkurl action="tripadm" page="add_caution" file=$ufile->tu_id}">
  <div class="panel-group">

    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Détails de la caution
      </div>

      <div class="panel panel-body">
        {include "$extendTpls/tripadm_cheq.tpl"}
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-footer">
        <input class="btn btn-primary" type="submit" value="Enregistrer" />
      </div>
    </div>
  </div>
</form>
