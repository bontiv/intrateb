{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="ml"}">Maillings</a></li>
  <li class="active">{$group->name}</li>
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
<form class="form-inline" method="POST" action="{mkurl action="ml" page="addMember" ml=$group->id}">
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
                {/if}
                {$member.obj->email}
              </td>
              <td>
                {if $member.user}
                    <a href="{mkurl action="user" page="view" user=$member.user.user_id}">{$member.user.user_name}</a>
                {else}
                    <div class="text-muted">N/A</div>
                {/if}
              </td>
              <td>
                {if not $member.isSave}
                    <a class="btn btn-danger btn-xs" href="{mkurl action="ml" page="delMember" ml=$group->id member=$member.obj->id}"><i class="glyphicon glyphicon-trash"></i></a>
                    {/if}
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="panel panel-body panel-warning">
      <p>
        Aucun membres dans le groupe.
      </p>
    </div>
{/if}
{include "foot.tpl"}
