{include "head.tpl"}

<h2>Bulletin {$bulletin->period_label}</h2>

<p>
  <a href="{mkurl action="admin_note" page="editbulletin" id=$bulletin->period_id}" class="btn btn-warning">Modifier</a>
  <a href="" class="btn btn-primary">Valider</a>
</p>

<table class="table">
  <thead>
    <tr>
      <th>Utilisateur</th>
        {foreach $colums as $colum}
        <th>{$colum}</th>
        {/foreach}
    </tr>
  </thead>
  <tbody>
    {foreach $marks as $mark}
        <tr>
          <td>{$mark.user->user_name}</td>
          {foreach $colums as $colum}
              {if isset($mark[$colum])}
                  <td>{$mark[$colum]} h</td>
              {else}
                  <td><span class="text-muted">N/A</span></td>
              {/if}
          {/foreach}
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}
