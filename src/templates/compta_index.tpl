{include "head.tpl"}

<h2>Comptabilité</h2>

<ol class="breadcrumb">
  <li class="active">Comptabilité</li>
</ol>
<p>
<ul class="nav nav-pills">
  <li role="presentation" class="active"><a href="{mkurl action="compta" page="index"}">Comptes</a></li>
  <li role="presentation"><a href="{mkurl action="compta" page="view"}">Remboursements en attente</a></li>
  <li role="presentation"><a href="{mkurl action="compta" page="ended"}">Remboursements terminés</a></li>
</ul>
</p>
<p>
  <a href="{mkurl action="compta" page="add"}"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter un compte</a>
</p>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Intitulé</th>
      <th>Type</th>
      <th>IBAN (banque) / email (PayPal)</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    {foreach $accounts as $acc}
        <tr>
          <td>
            {$acc.ua_identifier}
            {if $acc.ua_id==$smarty.session.user.user_compta}
                <div class="label label-primary">Par défaut</div>
            {/if}
          </td>
          <td>{$acc.ua_type}</td>
          <td>{$acc.ua_number}</td>
          <td>
            {if $acc.ua_id!=$smarty.session.user.user_compta}
                <a class="btn btn-default" href="{mkurl action="compta" page="setdefault" account=$acc.ua_id}">Mettre par défaut</a>
                {if $acc.ua_id!=0}
                    <a class="btn btn-danger" href="{mkurl action="compta" page="delete" account=$acc.ua_id}">
                      <div class="glyphicon glyphicon-trash"></div>
                    </a>
                {/if}
            {/if}
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>

<div class="alert alert-info">
  <p>Tous les futurs remboursements arriveront sur le compte défini par défaut.</p>

  {include "foot.tpl"}