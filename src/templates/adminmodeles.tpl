{include "head.tpl"}

<h1>Administration</h1>
<ol class="breadcrumb">
  <li class="active">Admin Instances</li>
</ol>
<h3>Gestion des modèles</h3>
<p>A noter que cette page est destiné aux développeurs et aux utilisateurs avancés.</p>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Fichier</th>
      <th>Nombre d'instances</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$tables item="line"}
        <tr>
          <td>
            <a href="{mkurl action="admin_modeles" page="modele" modele=$line.name}">{$line.name}</a>
          </td>
          <td>{if isset($line.mod)}<abbr title="Modèle de module">{$line.mod}</abbr>::{/if}{$line.file}</td>
          <td>{$line.nbr}</td>
          <td><a href="{mkurl action="admin_modeles" page="addinst" modele=$line.name}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a></td>
        </tr>
    {/foreach}
  </tbody>
</table>


{include "foot.tpl"}