{include "head.tpl"}

<h1>Administration</h1>
<h2>Section {$section.section_name}</h2>
<p>Section crée par {$section.user_name}. C'est une {if $section.section_type="primary"}section principale{else}sous section{/if}.</p>

<div class="btn-group">
  {if $section.inType}
      <a href="{mkurl action="section" page="goout" section=$section.section_id}" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Quitter</a>
  {else}
      <a href="{mkurl action="section" page="goin" section=$section.section_id}" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i> Adhérer</a>
  {/if}
  <a href="{mkurl action="section" page="mkevent" section=$section.section_id}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Créer event</a>
</div>

{* Les onglets *}
<ul class="nav nav-pills" style="margin-top: 20px;">
  <li class="active">
    <a href="{mkurl action=section page=details section=$section.section_id}">Membres</a>
  </li>
  <li><a href="{mkurl action=section page=activities section=$section.section_id}">Activités</a></li>
</ul>

<h3>Membres</h3>
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
    {foreach from=$managers item="line"}
        <tr>
          <td>{$line.user_name}</td>
          <td><span class="label label-primary">Manager</span></td>
          <td>{$line.user_login}</td>
          <td><a href="mailto:{$line.user_email}">{$line.user_email}</a></td>
          <td><a href="tel:{$line.user_phone}">{$line.user_phone}</a></td>
          <td><a href="{mkurl action="section" page="accept" user=$line.user_id section=$section.section_id}" class="btn btn-warning"><span class="glyphicon-thumbs-down glyphicon"></span></td>
        </tr>
    {/foreach}
    {foreach from=$users item="line"}
        <tr>
          <td>{$line.user_name}</td>
          <td><span class="label label-success">Staff</span></td>
          <td>{$line.user_login}</td>
          <td><a href="mailto:{$line.user_email}">{$line.user_email}</a></td>
          <td><a href="tel:{$line.user_phone}">{$line.user_phone}</a></td>
          <td>
            <div class="btn-group">
              <a href="{mkurl action="section" page="reject" user=$line.user_id section=$section.section_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
              <a href="{mkurl action="section" page="manager" user=$line.user_id section=$section.section_id}" class="btn btn-warning"><span class="glyphicon-thumbs-up glyphicon"></span></a>
            </div>
          </td>
        </tr>
    {/foreach}
    {foreach from=$guests item="line"}
        <tr>
          <td>{$line.user_name}</td>
          <td><span class="label label-default">En attente</span></td>
          <td>{$line.user_login}</td>
          <td><a href="mailto:{$line.user_email}">{$line.user_email}</a></td>
          <td><a href="tel:{$line.user_phone}">{$line.user_phone}</a></td>
          <td>
            <div class="btn-group">
              <a href="{mkurl action="section" page="reject" user=$line.user_id section=$section.section_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
              <a href="{mkurl action="section" page="accept" user=$line.user_id section=$section.section_id}" class="btn btn-primary"><span class="glyphicon-plus glyphicon"></span></a>
            </div>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>
{include "foot.tpl"}