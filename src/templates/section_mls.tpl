{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="section"}">Sections</a></li>
  <li><a href="{mkurl action="section" page="details" section=$section->section_id}">{$section->section_name}</a></li>
  <li class="active">Groupes de diffusion</li>
</ol>

{include "section_head.tpl"}

<h3>Groupes de diffusion</h3>

{if isset($groups)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        {foreach $groups as $group}
            <tr>
              <td>
                {if $group.isSection}
                    <div class="label label-primary">Section</div>
                {elseif $group.obj->directMembersCount == 1}
                    <div class="label label-warning">Alias</div>
                {/if}

                {if $group.isSection}
                    {$group.obj->name}
                {else}
                    <a href="{mkurl action="section" page="admin_ml" section=$section->section_id ml=$group.obj->id}">{$group.obj->name}</a>
                {/if}
              </td>
              <td>{$group.obj->email}</td>
              <td>{$group.obj->description}</td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-info">
      <p>Aucun groupe détecté.</p>
    </div>
{/if}

{include "foot.tpl"}
