{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li>Toyunda</li>
  <li class="active"><a href="{mkurl action="toyunda" page="admtrans"}" class="active">Gestion des transitions</a></li>
</ol>

{include "toyunda_menu.tpl"}
<h2>Gestion des transitions</h2>

<a href="{mkurl action="toyunda" page="admaddtrans"}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>

{if isset($trans)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>De</th>
          <th>A</th>
          <th>Verbe</th>
          <th>Participe</th>
          <th>Initial</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach $trans as $st}
            <tr>
              <td>{$st->tr_from->ts_name}</td>
              <td>{$st->tr_to->ts_name}</td>
              <td>{$st->tr_verb}</td>
              <td>{$st->tr_participle}</td>
              <td>{$st->tr_first}</td>
              <td><a href="{mkurl action="toyunda" page="admdeltrans" id=$st->tr_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
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
