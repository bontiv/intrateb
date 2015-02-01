{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="note" page="index" type=$period->period_type->ut_id}">Notation {$period->period_type->ut_name}</a></li>
  <li class="active">{$period->period_label}</li>
</ol>

<h1>Notations {$period->period_label}</h1>
{if isset($marks)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Date</th>
          <th>Status</th>
          <th>Titre</th>
          <th>Evenement</th>
          <th>Qualité</th>
          <th>Durée</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$marks item="m"}
            <tr>
              <td>{$m->mark_participation->part_attribution_date}</td>
              <td><span class="label {if $m->mark_participation->raw_part_status=='ACCEPTED'}label-success{elseif $m->mark_participation->raw_part_status=='REFUSED'}label-danger{elseif $m->mark_participation->raw_part_status=='SUBMITTED'}label-info{else}label-default{/if}">{$m->mark_participation->part_status}</span></td>
              <td>{$m->mark_participation->part_title}</td>
              <td>{if $m->mark_participation->part_event}{$m->mark_participation->part_event->event_name}{else}<span class="text-muted">Individuel</span>{/if}</td>
              <td>{$m->mark_mark}</td>
              <td>{$m->mark_participation->part_duration}h</td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <p class="alert alert-warning">Vous n'avez aucune note sur cette période</p>
{/if}
{include "foot.tpl"}
