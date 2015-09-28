{include "head.tpl"}

{include "developer_head.tpl"}

<h2>Application : {$apli->ac_name}</h2>

<div class="btn-group">
  <a class="btn btn-warning" href="{mkurl action=developer page=edit appli=$apli->ac_id}"><i class="glyphicon glyphicon-edit"></i> Editer</a>
  {if $apli->raw_ac_active != 'VALID'}
      <a class="btn btn-success" href="{mkurl action=developer page=valid appli=$apli->ac_id}"><i class="glyphicon glyphicon-check"></i> Autoriser</a>
  {/if}
  {if $apli->raw_ac_active != 'WAITING' and $apli->raw_ac_active != 'VALID'}
      <a class="btn btn-primary" href="{mkurl action=developer page=send appli=$apli->ac_id}"><i class="glyphicon glyphicon-check"></i> Envoyer</a>
  {/if}
  {if $apli->raw_ac_active != 'REFUSED'}
      <a class="btn btn-danger" href="{mkurl action=developer page=refuse appli=$apli->ac_id}"><i class="glyphicon glyphicon-remove-sign"></i> Refuser</a>
  {/if}
  <a class="btn btn-default" href="{mkurl action=developer page=refresh appli=$apli->ac_id}"><i class="glyphicon glyphicon-refresh"></i> Regénérer</a>
</div>

<dl class="dl-horizontal">
  <dt>Api client ID</dt>
  <dd>{$apli->ac_client}</dd>
  <dt>Statut</dt>
  <dd>
    <div class="label
         {if $apli->raw_ac_active == 'VALID'}
             label-success
         {elseif $apli->raw_ac_active == 'REFUSED'}
             label-danger
         {elseif $apli->raw_ac_active == 'WAITING'}
             label-warning
         {else}
             label-default
         {/if}
         ">
      {$apli->ac_active}
    </div>
    {if $apli->raw_ac_trust == 'CONFIDENTIAL'}
        <div class="label label-success">Confiance absolue</div>
    {/if}
  </dd>
  <dt>Api client secret</dt>
  <dd>{$apli->ac_secret}</dd>
  <dt>Callback autorisées</dt>
  <dd>
    <ul>
      {foreach $callbacks as $cb}
          <li>
            {$cb}
          </li>
      {/foreach}
    </ul>
  </dd>
  <dt>Clé api RSA</dt>
  <dd>{$apli->ac_apikey|nl2br}</dd>
</dl>

{include "foot.tpl"}
