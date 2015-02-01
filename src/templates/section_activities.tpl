{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="section"}">Sections</a></li>
  <li><a href="{mkurl action="section" page="details" section=$section->section_id}">{$section->section_name}</a></li>
  <li class="active">Activités</li>
</ol>

{include "section_head.tpl"}

<h3>Activités (notations)</h3>
{if isset($activities)}
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Date</th>
          <th>Durée</th>
          <th>Event</th>
          <th>Description</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$activities item="line"}
            <tr>
              <td>{$line->part_attribution_date}</td>
              <td>{$line->part_duration}h</td>
              <td>{if $line->part_event}{$line->part_event->event_name}{else}<span class="text-muted">Non lié</span>{/if}</td>
              <td><a href="{mkurl action="section" page="viewactivity" section=$section->section_id activity=$line->part_id}">{$line->part_title}</a></td>
              <td><span class="label {if $line->raw_part_status=='ACCEPTED'}label-success{elseif $line->raw_part_status=='REFUSED'}label-danger{elseif $line->raw_part_status=='SUBMITTED'}label-info{else}label-default{/if}">{$line->part_status}</span></td>
              <td>
                {*<a href="{mkurl action="section" page="activityMod" activity=$line->part_id section=$section->section_id}" class="btn btn-warning"><span class="glyphicon-pencil glyphicon"></span>*}
                <a href="{mkurl action="section" page="activityDel" activity=$line->part_id section=$section->section_id}" class="btn btn-danger"><span class="glyphicon-trash glyphicon"></span>
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-danger" role="alert">Attention, cette section n'a pas encore réalisé d'activités</div>
{/if}

{include "foot.tpl"}