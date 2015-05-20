{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li><a href='{mkurl action="event" page="view" event=$event.event_id}'>{$event.event_name}</a></li>
  <li><a href='{mkurl action="event" page="bocal_list" event=$event.event_id}'>Tickets Bocal</a></li>
  <li class="active">Ticket {$ticket->id}</li>
</ol>

<h2>Ticket Bocal {$ticket->id} <small>{$ticket->title}</small></h2>

<dl class="dl-horizontal">
  <dt>Assignation</dt>
  <dd>
    {foreach $ticket->assignation as $user}
        {$user}{if not $user@last},{/if}
    {/foreach}
  </dd>
  <dt>Diffusion</dt>
  <dd>
    {foreach $ticket->diffusion as $user}
        {$user}{if not $user@last},{/if}
    {/foreach}
  </dd>
</dl>

<table class="table table-bordered table-striped">
  <tbody>
    {foreach $ticket->answers as $reply}
        <tr>
          <td>
            <strong>{$reply->user}</strong><br />
            <img height="200px" width="150px" src="{$reply->image}" />
          </td>
          <td>
            <p><strong>{$reply->date}</strong></p>
            <p>{$reply->content}</p>
            <p><strong>Statut:</strong><i>{$reply->state}</i></p>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}