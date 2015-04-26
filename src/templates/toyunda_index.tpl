{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li>Toyunda</li>
  <li><a href="#" class="active">Liste des demandes</a></li>
</ol>

<ul class="nav nav-pills">
  <li role="presentation" class="active"><a href="#">Liste des demandes</a></li>
  <li role="presentation"><a href="{mkurl action="toyunda" page="add"}">Ajout d'une demande</a></li>
  <li role="presentation" class="disabled"><a href="#">Liste complète</a></li>
</ul>

<br />

<div class="panel panel-default">
  <div class="panel-body">
    <p>
      La section Toyunda s'occupe de la Toyunda. La Toyunda est le système permetant
      la réalisation des karaoké à EPITANIME. Les responsables de la section
      Toyunda s'applique à faire évoluer la base de donnée des karaokés disponibles.
    </p>
  </div>
</div>

<table class="table table-striped" id="karaoke-list">
  <thead>
    <tr>
      <th>Serie</th>
      <th>Titre</th>
      <th>Version</th>
      <th>Langue</th>
      <th>Statut</th>
    </tr>
  </thead>
  <tbody>
    {foreach $list as $task}
        <tr>
          <td>{$task.serie}</td>
          <td>{$task.title}</td>
          <td>{$task.version}</td>
          <td>
            {if $task.language == "FR"}
                <img src="images/flags/png/fr.png" alt="{$item[0]}" />
            {elseif $task.language == "JAP"}
                <img src="images/flags/png/jp.png" alt="{$item[0]}" />
            {elseif $task.language == "ANG"}
                <img src="images/flags/png/us.png" alt="{$item[0]}" />
            {else}
                {$task.language}
            {/if}
          </td>
          <td>
            {if $task.compl == 1}
                <span class="label label-success">Fini</span>
            {else}
                {if $task.prio < 0}
                    <span class="label label-default">En attente</span>
                {elseif $task.prio == 1}
                    <span class="label label-warning">En cours</span>
                {elseif $task.prio >= 2}
                    <span class="label label-info">A intégrer</span>
                {/if}
            {/if}
          <td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}
