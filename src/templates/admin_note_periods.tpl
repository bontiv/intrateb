{include "head.tpl"}
{include "admin_note_head.tpl"}

<div class="tab-content">
  <div class="tab-pane active">
    <p>
      <a href="{mkurl action="admin_note" page="addperiod"}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter</a>
    </p>

    {if isset($periods)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Début</th>
              <th>Fin</th>
              <th>Ecole</th>
              <th>Notes</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$periods item="m"}
                <tr>
                  <td>{$m->period_label}</td>
                  <td>{$m->period_start}</td>
                  <td>{$m->period_end}</td>
                  <td>{$m->period_type->ut_name}</td>
                  <td>{$m->reverse("marks")->count()}</td>
                  <td>
                    <a href="{mkurl action="admin_note" page="delperiod" id=$m->period_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                </tr>
            {/foreach}
          </tbody>
        </table>
    {else}
        <div class="alert alert-danger">
          <strong>Attention !</strong>
          <p>Aucune période active n'a été défini.</p>
        </div>
    {/if}


  </div>
</div>


{include "foot.tpl"}

