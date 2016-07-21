{include "head.tpl"}

<h1>Administration</h1>
<h3>Gestion des mandats</h3>

<ul class="nav nav-pills">
  <li class="active"><a href="#">Liste</a></li>
  <li><a href="{mkurl action="admin_modeles" page="addinst" modele=$mandate.name key=$line.{$mandate.key}}" class="btn" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>

{if $result == "success"}
    <div class="alert alert-success"><p><strong>Succes :</strong> l'enregistrement a bien été supprimé.</p></div>
{elseif $result == "error"}
    <div class="alert alert-danger"><p><strong>Erreur :</strong> une erreur a empeché la suppression de l'enregistrement.</p></div>
{/if}

<table class="table table-striped table-hover">
  <thead>
    <tr>
        {foreach from=$fields item="data"}
            <th>{$data.label}</th>
        {/foreach}
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
{foreach from=$insts item="line"}
    <tr>
        {foreach from=$fields item="data"}
            <td>{$line.{$data.name}}</td>
        {/foreach}
      <td><div class="btn-group-xs btn-group">
          <a href="{mkurl action="admin_modeles" page="delinst" modele=$mandate.name key=$line.{$mandate.key}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
          <a href="{mkurl action="admin_modeles" page="modinst" modele=$mandate.name key=$line.{$mandate.key}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
          {if $line.mandate_select == "FALSE"}
              <a href="{mkurl action="mandate" page="change" mandate=$line.mandate_id}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-ok"></span></a>
          {else}
              <a href="{mkurl action="mandate" page="change" mandate=$line.mandate_id}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
          {/if}
      </div></td>
    </tr>
{/foreach}
  </tbody>
</table>
    

{include "foot.tpl"}