{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="section"}">Sections</a></li>
  <li><a href="{mkurl action="section" page="details" section=$section->section_id}">{$section->section_name}</a></li>
  <li><a href="{mkurl action="section" page="activities" section=$section->section_id}">Activités</a></li>
  <li class="active">{$part->part_title}</li>
</ol>

<h1>{$part->part_title}</h1>


{include "foot.tpl"}
