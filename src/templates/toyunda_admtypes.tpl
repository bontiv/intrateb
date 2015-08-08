{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li>Toyunda</li>
  <li class="active"><a href="{mkurl action="toyunda" page="admtypes"}" class="active">Gestion des types</a></li>
</ol>

{include "toyunda_menu.tpl"}
<h2>Gestion des types</h2>

<a href="{mkurl action="toyunda" page="admaddtype"}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>

{if isset($types)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Code</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach $types as $st}
            <tr>
              <td>{$st->tt_code}</td>
              <td>{$st->tt_name}</td>
              <td><a href="{mkurl action="toyunda" page="admdeltype" id=$st->tt_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-warning">
      <p>Aucun type actuellement défini</p>
    </div>
{/if}

{include "foot.tpl"}
