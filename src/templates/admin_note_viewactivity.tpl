{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="admin_note"}">Admin notes</a></li>
  <li class="active">{$activity->part_title}</li>
</ol>

<h1>{$activity->part_title}</h1>

<p>
  <a href="{mkurl action=admin_note page=delactivity activity=$activity->part_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>
  <a href="{mkurl action=admin_note page=validactivity activity=$activity->part_id}" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Valider</a>
  <a href="{mkurl action=admin_note page=refuseactivity activity=$activity->part_id}" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Refuser</a>
</p>

{include "inc_activity.tpl"}

{include "foot.tpl"}
