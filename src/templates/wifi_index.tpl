{include "head.tpl"}

<h2>Gestion du WIFI</h2>

<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#">Connexion actives</a></li>
  <li role="presentation"><a href="{mkurl action="wifi" page="tokens"}">Vouchers</a></li>
</ul>


<div class="container-fluid">
  {if isset($lines)}
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Roll</th>
            <th>Token</th>
            <th>Utilisateur</th>
            <th>Date d'ajout</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$lines item="line"}
              <tr>
                <td>{$line.wtg_roll}</td>
                <td>{$line.wt_token}</td>
                <td><a href="{mkurl action="user" page="view" user=$line.user_id}">{$line.user_name|escape}</a></td>
                <td>{$line.wt_date}</td>
              </tr>
          {/foreach}
        </tbody>
      </table>
  {else}
      <p>Connexion WIFI active en cours.</p>
  {/if}
</div>

{include "foot.tpl"}
