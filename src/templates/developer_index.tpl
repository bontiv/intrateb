{include "head.tpl"}

{include "developer_head.tpl"}

<h2>Liste de vos applications</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <td>Nom</td>
      <td>Statut</td>
      <td>Client ID</td>
      <td>Propriétaire</td>
    </tr>
  </thead>
  <tbody>
    {foreach $clients as $cli}
        <tr>
          <td><a href="{mkurl action=developer page=view appli=$cli->ac_id}">{$cli->ac_name}</a></td>
          <td>
            <div class="label
                 {if $cli->raw_ac_active == 'VALID'}
                     label-success
                 {elseif $cli->raw_ac_active == 'REFUSED'}
                     label-danger
                 {elseif $cli->raw_ac_active == 'WAITING'}
                     label-warning
                 {else}
                     label-default
                 {/if}
                 ">
              {$cli->ac_active}
            </div>
            {if $cli->raw_ac_trust == 'CONFIDENTIAL'}
                <div class="label label-success">Confiance absolue</div>
            {/if}
          </td>
          <td>{$cli->ac_client}</td>
          <td><a href="{mkurl action=user page=view user=$cli->ac_owner->user_id}">{$cli->ac_owner->user_name|escape}</a></td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}