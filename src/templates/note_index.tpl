{include "head.tpl"}

<ol class="breadcrumb">
  <li class="active">Notation</li>
</ol>

<h1>Notations</h1>

<p>Séléctionnez une période de notation afin de visualiser les notes.</p>

<div class="row">
  <div class="col-lg-2">
    <div class="contains">
      <h4>Types</h4>
      <ul class="nav nav-pills nav-stacked">
        {foreach from=$types item="t"}
            <li role="presentation"{if (isset($smarty.get.type) and $t->ut_id==$smarty.get.type) or (not isset($smarty.get.type) and $t->ut_id==$_user.user_type)} class="active"{/if}><a href="{mkurl action="note" page="index" type=$t->ut_id}">{$t->ut_name}</a></li>
            {/foreach}
      </ul>
    </div>
  </div>

  <div class="col-lg-10">
    {if isset($periods)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Début</th>
              <th>Fin</th>
              <th>Ecole</th>
              <th>Mandat</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$periods item="p"}
                <tr>
                  <td><a href="{mkurl action="note" page="viewp" period=$p->period_id}">{$p->period_label}</a></td>
                  <td>{$p->period_start}</td>
                  <td>{$p->period_end}</td>
                  <td>{$p->period_type->ut_name}</td>
                  <td>{$p->period_mandate->mandate_label}</td>
                </tr>
            {/foreach}
          </tbody>
        </table>
    {else}
        <p class="alert alert-danger">Il n'existe pas de période de notation pour ce type !</p>
    {/if}
  </div>
</div>

{include "foot.tpl"}