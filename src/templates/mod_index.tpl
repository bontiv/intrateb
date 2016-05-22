{include "head.tpl"}
<h1>
  Extensions
</h1>
<p>
  Gestion des extensions.
</p>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Module</th>
      <th>Description</th>
      <th>Statut</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    {foreach $extends as $ext}
        <tr>
          <td><strong>{$ext.infos.name}</strong></td>
          <td>{$ext.infos.description}<br><div class="text-muted"><i>Par {$ext.infos.author|escape}</i></div></td>
          <td>
            {if $ext.enabled}
                <div class="label label-primary">Activé</div>
            {else}
                <div class="label label-default">Désactivé</div>
            {/if}
          </td>
          <td>
            {if $ext.enabled}
                <div class="btn-group">
                  <a class="btn btn-danger" href="{mkurl action="mod" page="desactivate" mod=$ext.sysdir}">Désactiver</a>
                  <a class="btn btn-warning" href="{mkurl action="mod" page="update" mod=$ext.sysdir}">Mise à jour</a>
                </div>
            {else}
                <a class="btn btn-success" href="{mkurl action="mod" page="activate" mod=$ext.sysdir}">Activer</a>
            {/if}
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>
{include "foot.tpl"}
