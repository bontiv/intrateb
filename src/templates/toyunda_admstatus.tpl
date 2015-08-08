{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li>Toyunda</li>
  <li class="active"><a href="{mkurl action="toyunda" page="admstatus"}" class="active">Gestion des status</a></li>
</ol>

{include "toyunda_menu.tpl"}
<h2>Gestion des statuts</h2>

<a href="{mkurl action="toyunda" page="admaddstatus"}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>

{if isset($status)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Code</th>
          <th>Nom</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach $status as $st}
            <tr>
              <td>{$st->ts_name}</td>
              <td>{$st->ts_closed}</td>
              <td><a href="{mkurl action="toyunda" page="admdelstatus" id=$st->ts_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-warning">
      <p>Aucun statut actuellement défini</p>
    </div>
{/if}

{include "foot.tpl"}
