{include "head.tpl"}
{include "admin_note_head.tpl"}

<div class="tab-content">
  <div class="tab-pane active">
    <p>
      <a href="{mkurl action="admin_note" page="addbulletin"}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter</a>
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
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$periods item="m"}
                <tr>
                  <td><a href="{mkurl action="admin_note" page="viewbulletin" id=$m->period_id}">{$m->period_label}</a></td>
                  <td>{$m->period_start}</td>
                  <td>{$m->period_end}</td>
                  <td>{$m->period_type->ut_name}</td>
                  <td>{$m->reverse("marks")->count()}</td>
                  <td>
                    {if $m->raw_period_state == "DRAFT"}
                        <div class="label label-info">Brouillon</div>
                    {elseif $m->raw_period_state == "ACTIVE"}
                        <div class="label label-success">Terminé</div>
                    {/if}
                  </td>
                </tr>
            {/foreach}
          </tbody>
        </table>
    {else}
        <div class="alert alert-danger">
          <strong>Attention !</strong>
          <p>Il n'existe aucun bulletin.</p>
        </div>
    {/if}


  </div>
</div>


{include "foot.tpl"}

