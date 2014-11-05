{include "head.tpl"}

<h2>Gestion des tokens WIFI</h2>

<p>
  <a href="{mkurl action="wifi" page="add"}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>
</p>

<div class="container-fluid">
  {if isset($lines)}
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Roll</th>
            <th>Durée / token</th>
            <th>Date d'ajout</th>
            <th>Utilisé</th>
            <th>Total</th>
            <th>Poucentage d'usage</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$lines item="line"}
              <tr>
                <td>{$line.wtg_roll}</td>
                <td>{$line.wtg_duration}</td>
                <td>{$line.wtg_date}</td>
                <td>{$line.used}</td>
                <td>{$line.sum}</td>
                <td>{($line.used*100/$line.sum)|string_format:"%.2f"} %</td>
                <td><a href="{mkurl action="wifi" page="del" roll=$line.wtg_id}" class="glyphicon glyphicon-trash btn btn-danger"></a></td>
              </tr>
          {/foreach}
        </tbody>
      </table>
  {else}
      <p>Aucun batch de vouchers n'a été ajouté.</p>
  {/if}
</div>

{include "foot.tpl"}
