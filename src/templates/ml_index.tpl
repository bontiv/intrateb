{include "head.tpl"}

<h2>Gestion des groupes de diffusion</h2>

<p>
  <a href="{mkurl action="ml" page="autoUpdate"}" class="btn btn-warning">MAJ Auto</a>
</p>

{if isset($groups)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Section</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        {foreach $groups as $group}
            <tr>
              <td>
                {if $group.isMembersList}
                    <div class="label label-default">G.D. Membres</div>
                {elseif $group.isSection}
                    <div class="label label-primary">Section</div>
                {elseif $group.isManaged}
                    <div class="label label-info">Géré</div>
                {elseif $group.obj->directMembersCount == 1}
                    <div class="label label-warning">Alias</div>
                {/if}

                <a href="{mkurl action="ml" page="view" ml=$group.obj->id}">{$group.obj->name}</a></td>
              <td>{$group.obj->email}</td>
              <td>
                {if $group.isSection}
                    <a class="text-info" style="font-style: italic; font-size: 0.8em" href="{mkurl action="section" page="details" section=$group.isSection.section_id}">{$group.isSection.section_name}</a>
                {/if}
                {if $group.isManaged}
                    {foreach $group.isManaged as $section}
                        <a class="text-primary" href="{mkurl action="section" page="details" section=$section.section_id}">{$section.section_name}</a>
                    {/foreach}
                {/if}
              </td>
              <td>{$group.obj->description}</td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="panel panel-body panel-warning">
      <p>Aucun groupe détecté.</p>
    </div>
{/if}
{include "foot.tpl"}
