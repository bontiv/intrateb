{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="section"}">Sections</a></li>
  <li class="active">{$section->section_name}</li>
</ol>

{include "section_head.tpl"}

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
          <td><a href="{mkurl action="user" page="view" user=$line.user_id}">{$line.user_name|escape}</a></td>
          <td><span class="label label-primary">Manager</span></td>
          <td>{$line.user_login}</td>
          <td><a href="mailto:{$line.user_email|escape:'url'}">{$line.user_email|escape}</a></td>
          <td><a href="tel:{$line.user_phone|escape:'url'}">{$line.user_phone|escape}</a></td>
          <td><a href="{mkurl action="section" page="accept" user=$line.user_id section=$section->section_id}" class="btn btn-warning"><span class="glyphicon-thumbs-down glyphicon"></span></td>
        </tr>
    {/foreach}
    {foreach from=$users item="line"}
        <tr>
          <td>{$line.user_name|escape}</td>
          <td><span class="label label-success">Staff</span></td>
          <td>{$line.user_login|escape}</td>
          <td><a href="mailto:{$line.user_email|escape:'url'}">{$line.user_email|escape}</a></td>
          <td><a href="tel:{$line.user_phone|escape:'url'}">{$line.user_phone|escape}</a></td>
          <td>
            <div class="btn-group">
              <a href="{mkurl action="section" page="reject" user=$line.user_id section=$section->section_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
              <a href="{mkurl action="section" page="manager" user=$line.user_id section=$section->section_id}" class="btn btn-warning"><span class="glyphicon-thumbs-up glyphicon"></span></a>
            </div>
          </td>
        </tr>
    {/foreach}
    {foreach from=$guests item="line"}
        <tr>
          <td>{$line.user_name|escape}</td>
          <td><span class="label label-default">En attente</span></td>
          <td>{$line.user_login|escape}</td>
          <td><a href="mailto:{$line.user_email|escape:'url'}">{$line.user_email|escape}</a></td>
          <td><a href="tel:{$line.user_phone|escape:'url'}">{$line.user_phone|escape}</a></td>
          <td>
            <div class="btn-group">
              <a href="{mkurl action="section" page="reject" user=$line.user_id section=$section->section_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
              <a href="{mkurl action="section" page="accept" user=$line.user_id section=$section->section_id}" class="btn btn-primary"><span class="glyphicon-plus glyphicon"></span></a>
            </div>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>
{include "foot.tpl"}