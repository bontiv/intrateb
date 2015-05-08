{include "head.tpl"}

<h2>Bulletin {$bulletin->period_label}</h2>

<p>
  {if $bulletin->raw_period_state=="DRAFT"}
      <a href="{mkurl action="admin_note" page="editbulletin" id=$bulletin->period_id}" class="btn btn-warning">Modifier</a>
      <a href="{mkurl action="admin_note" page="validbulletin" id=$bulletin->period_id}" class="btn btn-primary">Valider</a>
  {/if}
  {if $bulletin->raw_period_state=="VALID" or $bulletin->raw_period_state=="SENT"}
  <div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Télécharger <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="{mkurl action="admin_note" page="downbulletin" format="hoarau" id=$bulletin->period_id}">Format CSV hoarau</a></li>
      <li><a href="{mkurl action="admin_note" page="downbulletin" format="intra" id=$bulletin->period_id}">Format CSV Intra</a></li>
    </ul>
  </div>
{/if}
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
