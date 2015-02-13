{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="section"}">Sections</a></li>
  <li><a href="{mkurl action="section" page="details" section=$section->section_id}">{$section->section_name}</a></li>
  <li class="active">Events</li>
</ol>

{include "section_head.tpl"}

<h3>Evénements organisés</h3>
{if isset($events)}
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Début</th>
          <th>Fin</th>
          <th>Event</th>
          <th>Coef</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$events item="line"}
            <tr>
              <td>{$line->event_start}</td>
              <td>{$line->event_end}</td>
              <td><a href="{mkurl action=event page=view event=$line->event_id}">{$line->event_name}</a></td>
              <td>{$line->event_coef}</td>
              <td>{$line->event_state}</td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-danger" role="alert">Attention, cette section n'a pas encore réalisé d'événements</div>
{/if}

{include "foot.tpl"}