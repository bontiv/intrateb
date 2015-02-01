{include "head.tpl"}
{include "admin_note_head.tpl"}

<div class="tab-content">
  <div class="tab-pane active">
    <p>
      <a href="{mkurl action="admin_note" page="addmandate"}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter</a>
    </p>

    {if isset($mandates)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Début</th>
              <th>Fin</th>
              <th>Periodes</th>
              <th>Membres</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$mandates item="m"}
                <tr>
                  <td>{$m->mandate_label}</td>
                  <td>{$m->mandate_start}</td>
                  <td>{$m->mandate_end}</td>
                  <td>{$m->reverse("periods")->count()}</td>
                  <td>{$m->reverse("user_mandate")->count()}</td>
                  <td><a href="{mkurl action="admin_note" page="delmandate" mandate=$m->mandate_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
                </tr>
            {/foreach}
          </tbody>
        </table>
    {else}
        <div class="alert alert-danger">
          <strong>Attention !</strong>
          <p>Aucun mandat n'a été défini.</p>
        </div>
    {/if}
  </div>
</div>

{include "foot.tpl"}
