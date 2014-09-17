{include "head.tpl"}

<h2>Gestion des cartes de membre</h2>
{if $nbNeeded>0}
    <div class="contains panel panel-warning">
      <div class="panel-heading">Cartes en attente</div>
      <div class="panel-body">
        <p>Il y a <strong>{$nbNeeded}</strong> carte(s) en attente de validation.</p>
        <a href="{mkurl action="cards" page="validate"}" class="btn btn-default">Valider les cartes</a>
      </div>
    </div>
{/if}

{if $nbWait>0}
    <div class="contains panel panel-default">
      <div class="panel-heading">Bundle possible</div>
      <div class="panel-body">
        <p>Il y a <strong>{$nbWait}</strong> carte(s) en attente de bundle pour impression.</p>
        <a href="{mkurl action="cards" page="mkbundle"}" class="btn btn-default">Créer le bundle</a>
      </div>
    </div>
{/if}

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Date</th>
      <th>Statut</th>
      <th>Nombre de carte</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$bundles item="l"}
        <tr>
          <td>{$l.cbundle_date}</td>
          <td>
            {if $l.cbundle_status=='CREATED'}
                <span class="label label-danger">Non envoyé</span>
            {elseif $l.cbundle_status=='WAIT'}
                <span class="label label-default">Téléchargé</span>
            {else}
                <span class="label label-success">Réceptionné</span>
            {/if}
          </td>
          <td>{$l.count}</td>
          <td>
            {if $l.cbundle_status=='CREATED'}<a href="{mkurl action="cards" page="delbundle" bundle=$l.cbundle_id}" class="btn btn-danger glyphicon glyphicon-trash"></a>{/if}
            {if $l.cbundle_status=='WAIT'}<a title="Set de cartes récéptionné" href="{mkurl action="cards" page="bundleok" bundle=$l.cbundle_id}" class="btn btn-success glyphicon glyphicon-check"></a>{/if}
            <a title="Télécharger le set de cartes" href="{mkurl action="cards" page="download" bundle=$l.cbundle_id}" class="btn btn-primary glyphicon glyphicon-download"></a>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}