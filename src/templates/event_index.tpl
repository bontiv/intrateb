{include "head.tpl"}
<ol class="breadcrumb">
  <li class="active">Events</li>
</ol>

<h1>Events</h1>
<im>Pour créer un event, passez par la page de votre section.</im>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Evenement</th>
      <th>Date début</th>
      <th>Date fin</th>
      <th>Description</th>
      {acl level="ADMINISTRATOR"}
      <th>Coef</th>
      <th>Action</th>
      {/acl}
    </tr>
  </thead>
  <tbody>
    {foreach from=$ptable.rows item="line"}
        <tr>
          <td><a href="{mkurl action="event" page="view" event=$line.event_id}">{$line.event_name}</a></td>
          <td>{$line.event_start}</td>
          <td>{$line.event_end}</td>
          <td>{$line.event_desc}</td>
          {acl level="ADMINISTRATOR"}
          <td>{$line.event_coef}</td>
          <td>
            <div class="btn-group">
              <a href="{mkurl action="event" page="delete" event=$line.event_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
              <a href="{mkurl action="event" page="edit" event=$line.event_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
            </div>
          </td>
          {/acl}
        </tr>
    {/foreach}
  </tbody>
</table>


{include "foot.tpl"}