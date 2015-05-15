{include "head.tpl"}

<h2>Synchronisation Google ML</h2>

<a href="{mkurl action="user" page="execSync"}" class="btn btn-warning">Executer</a>

<h3>ML membres</h3>

<h4>Membres à ajouter</h4>
<p>{foreach from=$add item="email"}{$email}, {/foreach}</p>

<h4>Membres à supprimer</h4>
<p>{foreach from=$del item="email"} {$email}, {/foreach}</p>

{include "foot.tpl"}