{include "head.tpl"}

<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation" class="active">{$trip->tr_name|escape}</li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Dossier d'inscription <small>étape 4</small></h2>

<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
    <span class="sr-only">40% Complete</span>
  </div>
</div>

{if $ufile->raw_tu_type<>0}
    <div class="alert alert-warning">
      <p><strong>Attention !</strong> Vous n'êtes pas éligible au billet séléctionné. Veuillez séléctionner un autre billet ou contacter un administrateur de l'intra (bureau).</p>
    </div>
{/if}

<form method="POST" action="{mkurl action="tripusr" page="step4" file=$ufile->tu_id}" class="form-horizontal">
  <div class="panel-group">

    {* Panel santé *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Choix du Billet
      </div>
      <div class="panel-body">
        <p>
          Choisissez le billet pour le voyage. Les billets peuvent être soumis à condition.
        </p>
      </div>

      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Billet</th>
            <th>Restriction</th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody>
          {foreach $tickets as $ticket}
              <tr>
                <th><input class="form-control" id="t{$ticket->tt_id}" name="ticket" value="{$ticket->tt_id}" type="radio" /></th>
                <td>{$ticket->tt_name|escape}</td>
                <td>{$ticket->tt_restriction|escape}</td>
                <td>{$ticket->tt_price|escape} €</td>
              </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
    {* / Panel traveller *}


    {* Panel Footer *}
    <div class="panel panel-default">
      <div class="panel-footer">
        <input type="submit" class="btn btn-primary" value="Suivant" />
      </div>
    </div>
    {* / Panel Footer *}

  </div>
</form>

{include "foot.tpl"}
