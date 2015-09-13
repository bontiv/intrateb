{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li>Toyunda</li>
  <li class="active"><a href="{mkurl action="toyunda" page="admlangs"}" class="active">Gestion des langues</a></li>
</ol>

{include "toyunda_menu.tpl"}
<h2>Gestion des langues</h2>

<a href="{mkurl action="toyunda" page="admaddlang"}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>

{if isset($langs)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>Code</th>
          <th>Langue</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach $langs as $st}
            <tr>
              <td>{if $st->tl_flag != ""}<img src="images/flags/png/{$st->tl_flag}" />{/if}</td>
              <td>{$st->tl_code}</td>
              <td>{$st->tl_name}</td>
              <td><a href="{mkurl action="toyunda" page="admdellang" id=$st->tl_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-warning">
      <p>Aucun langue actuellement défini</p>
    </div>
{/if}

{include "foot.tpl"}
