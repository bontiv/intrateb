{include "head.tpl"}

{include "event_staff_head.tpl"}

<p>Vous avez besoin de <strong>{$section.es_needed}</strong> staffs.</p>


<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Pseudo</th>
      <th>Type</th>
      <th>Status</th>
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
          <td>{if $line.est_status=="OK"}<span class="label label-success">Accepté</span>{elseif $line.est_status=="NO"}<span class="label label-danger">Refusé</span>{else}<span class="label label-default">Candidat</span>{/if}</td>
          <td>{$line.user_login}</td>
          <td>{$line.user_email}</td>
          <td>{$line.user_phone}</td>
          <td>
            <div class="btn-group">
              {if $line.est_status!="NO"}
                  <a title="Refuser cette personne" href="{mkurl action="event" page="staff_reject" user=$line.user_id section=$section.section_id event=$event.event_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
                  {/if}
                  {if $line.est_status!="OK"}
                  <a title="Accepter cette personne" href="{mkurl action="event" page="staff_accept" user=$line.user_id section=$section.section_id event=$event.event_id}" class="btn btn-success"><span class="glyphicon-thumbs-up glyphicon"></span></a>
                  {/if}
            </div>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>
{include "foot.tpl"}