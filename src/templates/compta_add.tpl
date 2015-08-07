{include "head.tpl"}

<h2>Comptabilité</h2>

<ol class="breadcrumb">
  <li><a href="">Comptabilité</a></li>
  <li class="active">Ajout de compte</li>
</ol>

<div class="alert alert-info">
  <p><strong>Information</strong> : seuls les comptes banquaire sont ajoutables
    pour le moment. Ces comptes permettent le remboursement par virement
    banquaire pour les différentes notes de frais.
  </p>
</div>

<form class="form-horizontal" method="POST" action="{mkurl action="compta" page="add"}">
  <fieldset>
    {$form}

    <div class="form-group">
      <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}