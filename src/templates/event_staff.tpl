{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li><a href="{mkurl action="event" page="view" event=$event.event_id}">{$event.event_name}</a></li>
  <li class="active">Staffs {$section.section_name}</li>
</ol>

<h1>Staffs section {$section.section_name} sur {$event.event_name}</h1>
<h2>Section {$section.section_name}</h2>
<p>Section crée par {$section.user_name}. C'est une {if $section.section_type="primary"}section principale{else}sous section{/if}.</p>

<p>
<div>
  {if not $section.inType}
      <a href="{mkurl action="event" page="goout" event=$event.event_id section=$section.section_id}" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Quitter</a>
  {else}
      <a href="{mkurl action="event" page="goin" event=$event.event_id section=$section.section_id}" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i> Rejoindre</a>
  {/if}
  <a href="{mkurl action="event" page="edit_needed" event=$event.event_id section=$section.section_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i> Editer</a>
</div>
</p>

<p>Vous avez besoin de <strong>{$section.es_needed}</strong> staffs.</p>

<h3>Staffs</h3>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Pseudo</th>
      <th>Type</th>
      <th>Login</th>
      <th>Email</th>
      <th>Téléphone</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$users item="line"}
        <tr>
          <td>{$line.user_name}</td>
          <td>{if $line.us_type=="user"}<span class="label label-success">Staff</span>{elseif $line.us_type=="manager"}<span class="label label-primary">Manager</span>{else}<span class="label label-default">Guest</span>{/if}</td>
          <td>{$line.user_login}</td>
          <td>{$line.user_email}</td>
          <td>{$line.user_phone}</td>
          <td>
            <div class="btn-group">
              <a href="{mkurl action="section" page="reject" user=$line.user_id section=$section.section_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
              <a href="{mkurl action="section" page="manager" user=$line.user_id section=$section.section_id}" class="btn btn-warning"><span class="glyphicon-thumbs-up glyphicon"></span></a>
            </div>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>
{include "foot.tpl"}