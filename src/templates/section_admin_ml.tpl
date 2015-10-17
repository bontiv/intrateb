{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="section"}">Sections</a></li>
  <li><a href="{mkurl action="section" page="details" section=$section->section_id}">{$section->section_name}</a></li>
  <li><a href="{mkurl action="section" page="mls" section=$section->section_id}">Groupes de diffusion</a></li>
  <li class="active">Groupes de diffusion</li>
</ol>

<h2>Groupe {$group->name}</h2>

<h3>Details</h3>

<dl class="dl-horizontal">
  <dt>Nom</dt>
  <dd>{$group->name}</dd>
  <dt>Adresse</dt>
  <dd>{$group->email}</dd>
  <dt>Description</dt>
  <dd>{$group->description}</dd>
</dl>


<h3>Membres</h3>
{acl action="section" page="admin_ml_add" section=$section->section_id}
<form class="form-inline" method="POST" action="{mkurl action="section" page="admin_ml_add" ml=$group->id section=$section->section_id}">
  <div class="row">
    <div class="col-lg-6">
      <div class="input-group">
        <span class="input-group-addon">Ajout</span>
        <input type="text" class="form-control" name="email" placeholder="Email">
        <span class="input-group-btn">
          <button class="btn btn-primary" type="submit"><div class="glyphicon glyphicon-plus-sign"></div></button>
        </span>
      </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
  </div><!-- /.row -->
</form>
{/acl}
{if isset($members)}
    <table class="table table-striped">
      <thead>
        <tr>
          <td>Email</td>
          <td>Utilisateur</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        {foreach $members as $member}
            <tr>
              <td>
                {if $member.isSave}
                    <div class="label label-default">Sauvegarde</div>
                {elseif $member.obj->role == "OWNER"}
                    <div class="label label-danger">Admin</div>
                {elseif $member.obj->role == "MANAGER"}
                    <div class="label label-warning">Modérateur</div>
                {/if}
                {$member.obj->email}
              </td>
              <td>
                {if $member.user}
                    <a href="{mkurl action="user" page="view" user=$member.user.user_id}">{$member.user.user_name|escape}</a>
                {elseif $member.obj->type == "GROUP"}
                    <div class="label label-info">Groupe</div>
                {else}
                    <div class="text-muted">N/A</div>
                {/if}
              </td>
              <td>
                {if not ($member.isSave or $member.obj->type == "GROUP")}
                    <div class="btn-group btn-group-xs">
                      {if $member.obj->role == "OWNER"}
                          <a class="btn btn-warning" title="Passer en membre" href="{mkurl action="section" page="admin_ml_noadmin" ml=$group->id section=$section->section_id member=$member.obj->id}">
                            <i class="glyphicon glyphicon-thumbs-down"></i>
                          </a>
                      {else}
                          <a class="btn btn-success" title="Passer en admin" href="{mkurl action="section" page="admin_ml_setadmin" ml=$group->id section=$section->section_id member=$member.obj->id}">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                          </a>
                      {/if}
                      <a class="btn btn-danger btn-xs" href="{mkurl action="section" page="admin_ml_del" ml=$group->id section=$section->section_id member=$member.obj->id}">
                        <i class="glyphicon glyphicon-trash"></i>
                      </a>
                    </div>
                {/if}
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-warning">
      <p>
        Aucun membres dans le groupe.
      </p>
    </div>
{/if}

{include "foot.tpl"}