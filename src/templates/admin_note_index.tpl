{include "head.tpl"}
{include "admin_note_head.tpl"}

{if isset($parts)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Date</th>
          <th>Titre</th>
          <th>Evenement</th>
          <th>Durée</th>
          <th>Section</th>
        </tr>
      </thead>
      <tbody>
        {foreach $parts as $part}
            <tr>
              <td><a href="{mkurl action=admin_note page=viewactivity activity=$part->part_id}">{$part->part_attribution_date}</a></td>
              <td>{$part->part_title}</td>
              <td>
                {if $part->part_event}
                    <a href="{mkurl action=event page=view event=$part->part_event->event_id}">{$part->part_event->event_name}</a>
                {else}<div class="text-muted">Non lié</div>{/if}
              </td>
              <td>{$part->part_duration}h</td>
              <td>
                {if $part->part_section}
                    <a href="{mkurl action=section page=details section=$part->part_section->section_id}">{$part->part_section->section_name}</a>
                {else}<div class="text-muted">Non lié</div>
                {/if}</td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <p class="alert alert-info">
      Aucune note à valider.
    </p>
{/if}
{include "foot.tpl"}
