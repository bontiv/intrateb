{include "head.tpl"}

<h1>Events</h1>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Evenement</th>
      <th>Date début</th>
      <th>Date fin</th>
      <th>Description</th>
      <th>Coef</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
{foreach from=$ptable.rows item="line"}
    <tr>
      <td><a href="{mkurl action="event" page="view" event=$line.event_id}">{$line.event_name}</a></td>
      <td>{$line.event_start}</td>
      <td>{$line.event_end}</td>
      <td>{$line.event_desc}</td>
      <td>{$line.event_coef}</td>
      <td>
        <div class="btn-group">
          <a href="{mkurl action="user" page="delete" user=$line.user_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
          <a href="{mkurl action="user" page="edit" user=$line.user_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
        </div>
      </td>
    </tr>
{/foreach}
  </tbody>
</table>
    

{include "foot.tpl"}