{include "head.tpl"}

{include "developer_head.tpl"}

<h2>Log des connexions API</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Début</th>
      <th>Fin</th>
      <th>Validité</th>
      <th>Utilisateur</th>
      <th>Application</th>
      <th>URL</th>
      <th>Scope</th>
    </tr>
  </thead>
  <tbody>
    {foreach $logs as $log}
        <tr>
          <td>{$log.at_start|date_format:'%d/%m/%y %T'}</td>
          <td>{$log.at_expire|date_format:'%d/%m/%y %T'}</td>
          <td>
            {if $log.at_expire > $smarty.now}
                <div class="label label-success">Valide</div>
            {else}
                <div class="label label-default">Expiré</div>
            {/if}
          </td>
          <td><a href="{mkurl action=user page=view user=$log.user_id}">{$log.user_name|escape}</a></td>
          <td><a href="{mkurl action=developer page=view appli=$log.ac_id}">{$log.ac_name}</a></td>
          <td><a href="{$log.at_uri}">{$log.at_uri}</a></td>
          <td>{$log.at_scope}</td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include 'foot.tpl'}