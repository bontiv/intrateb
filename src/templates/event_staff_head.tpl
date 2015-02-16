<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li><a href="{mkurl action="event" page="view" event=$event.event_id}">{$event.event_name}</a></li>
  <li class="active">{$section.section_name}</li>
</ol>

<h1>{$event.event_name}</h1>
<h2>Section {$section.section_name}</h2>

<p>
<div>
  {if not $section.inType}
      <a href="{mkurl action="event" page="goout" event=$event.event_id section=$section.section_id}" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Quitter</a>
  {else}
      <a href="{mkurl action="event" page="goin" event=$event.event_id section=$section.section_id}" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i> Rejoindre</a>
  {/if}
  <a href="{mkurl action="event" page="edit_needed" event=$event.event_id section=$section.section_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i> Editer</a>
  <a href="{mkurl action="event" page="addpoints" event=$event.event_id section=$section.section_id}" class="btn btn-default"><i class="glyphicon glyphicon-gift"></i> Ajout activité</a>
</div>
</p>

<ul class="nav nav-tabs">
  <li role="presentation"{if $smarty.get.page=='staff'} class="active"{/if}>
    <a href="{mkurl action="event" page="staff" event=$event.event_id section=$section.section_id}">Staffs</a>
  </li>
  <li role="presentation"{if $smarty.get.page=='staff_activities'} class="active"{/if}>
    <a href="{mkurl action="event" page="staff_activities" event=$event.event_id section=$section.section_id}">Activités</a>
  </li>
</ul>
