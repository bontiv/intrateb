{include "head.tpl"}

<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation"><a href="{mkurl action="tripusr" page="index" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li role="presentation" class="active">Dossier n&deg; {$ufile->tu_id}</li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Dossier d'inscription <small>étape finale</small></h2>

<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">100% Complete</span>
  </div>
</div>

<form method="POST" action="{mkurl action="tripusr" page="step5" file=$ufile->tu_id}" class="form-horizontal">
  <div class="panel-group">

    {* Panel santé *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Félicitaion
      </div>
      <div class="panel-body">
        <p>
            Dossier complet, bravo!
        </p>
   
        
      </div>
    </div>
    {* / Panel traveller *}


    {* Panel Footer *}
    {if $delete}
    <div class="panel panel-default">
      <div class="panel-footer">
        
        <a href="{mkurl action="tripusr" page="delete" file=$ufile->tu_id}" class="btn btn-danger" onclick="return confirm('Supprimer totalement la candidature ?');">
          <span class="glyphicon glyphicon-trash"></span>
          Supprimer
        </a>
      </div>
    </div>
    {/if}
    {* / Panel Footer *}

  </div>
</form>

{include "foot.tpl"}
