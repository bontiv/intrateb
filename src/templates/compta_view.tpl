{include "head.tpl"}

<h2>Comptabilité</h2>

<ol class="breadcrumb">
  <li><h href="{mkurl action="compta"}">Comptabilité</a></li>
    <li class="active">En attente</li>
</ol>
<p>
<ul class="nav nav-pills">
  <li role="presentation"><a href="{mkurl action="compta" page="index"}">Comptes</a></li>
  <li role="presentation" class="active"><a href="{mkurl action="compta" page="view"}">Remboursements en attente</a></li>
  <li role="presentation"><a href="{mkurl action="compta" page="ended"}">Remboursements terminés</a></li>
</ul>
</p>

<div class="alert alert-info">
  <p>
    Vous n'avez aucun remboursement en attente.
  </p>
</div>

{include "foot.tpl"}
