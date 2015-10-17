
<table class="table">
  <tr>
    <th class="col-md-4">ID</th>
    <td class="col-md-8">{$activity->part_id}</td>
  </tr>
  <tr>
    <th>Titre</th>
    <td>{$activity->part_title}</td>
  </tr>
  <tr>
    <th>Section</th>
    <td>
      {if $activity->part_section}
          <a href="{mkurl action=section page=details section=$activity->part_section->section_id}">{$activity->part_section->section_name}</a>
      {else}
          <span class="text-muted">Non lié</span>
      {/if}
    </td>
  </tr>
  <tr>
    <th>Event</th>
    <td>
      {if $activity->part_event}
          <a href="{mkurl action=event page=view event=$activity->part_event->event_id}">{$activity->part_event->event_name}</a>
      {else}
          <span class="text-muted">Non lié</span>
      {/if}
    </td>
  </tr>
  <tr>
    <th>Durée</th>
    <td>{$activity->part_duration}</td>
  </tr>
  <tr>
    <th>Date</th>
    <td>{$activity->part_attribution_date}</td>
  </tr>
  <tr>
    <th>Validation</th>
    <td>{$activity->part_validation_date}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>{$activity->part_status}</td>
  </tr>
</table>

<h2>Justification</h2>
<div class="container contains">
  <p>
    {$activity->part_justification}
  </p>
</div>

<h2>Participants</h2>
{if isset($staffs)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Pseudo</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Période</th>
          <th>Note (sur 20)</th>
        </tr>
      </thead>
      <tbody>
        {foreach $staffs as $staff}
            <tr>
              <td>{$staff->mark_user->user_name|escape}</td>
              <td>{$staff->mark_user->user_lastname|escape}</td>
              <td>{$staff->mark_user->user_firstname|escape}</td>
              <td>{$staff->mark_period->period_label}</td>
              <td>{$staff->mark_mark}</td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <p class="alert alert-danger">Aucun participant !</p>
{/if}