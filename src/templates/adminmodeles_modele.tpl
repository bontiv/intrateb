{include "head.tpl"}

<h1>Administration</h1>
<ol class="breadcrumb">
  <li><a href="{mkurl action="admin_modeles"}">Admin Instances</a></li>
  <li class="active">Modele {$modele.name}</li>
</ol>
<h3>Gestion de {$modele.name}</h3>
<p>A noter que cette page est destiné aux développeurs et aux utilisateurs avancés.</p>
<p>Ce modèle se trouve dans le fichier {$modele.file}</p>

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
          <a href="{mkurl action="admin_modeles" page="delinst" modele=$modele.name key=$line.{$modele.key}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
          <a href="{mkurl action="admin_modeles" page="modinst" modele=$modele.name key=$line.{$modele.key}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
      </div></td>
    </tr>
{/foreach}
  </tbody>
</table>
    

{include "foot.tpl"}