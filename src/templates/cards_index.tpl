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
          <td>{$l.cbundle_status}</td>
          <td>{$l.count}</td>
          <td></td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}