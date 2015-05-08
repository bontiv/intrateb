{include "head.tpl"}

<h2>Vos bulletins</h2>

{if isset($bulletins)}
    <table class="table table-striped">
      <thead>
      <th>Libéllé</th>
      <th>Début</th>
      <th>Fin</th>
      <th>Statut</th>
    </thead>
    <tbody>
      {foreach $bulletins as $bulletin}
          <tr>
            <td><a href="{mkurl action="bulletin" page="viewbulletin" id=$bulletin.bu_id}">{$bulletin.period_label}</a></td>
            <td>{$bulletin.period_start}</td>
            <td>{$bulletin.period_end}</td>
            <td>
              {if $bulletin.period_state == "DRAFT"}
                  <span class="label label-info">En cours</span>
              {elseif $bulletin.period_state == "VALID"}
                  <span class="label label-warning">En validation</span>
              {elseif $bulletin.period_state == "SENT"}
                  <span class="label label-success">Validé</span>
              {else}
                  {$bulletin.period_state}
              {/if}
            </td>
          </tr>
      {/foreach}
    </tbody>
</table>
{else}
    <div class="panel panel-info">
      <div class="panel-body">Vous n'avez pas encore de bulletin attitré.</div>
    </div>
{/if}

{include "foot.tpl"}