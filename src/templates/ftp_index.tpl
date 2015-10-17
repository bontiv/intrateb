{include "head.tpl"}

<h1>Comptes FTP</h1>

<a href="{mkurl action="ftp" page="add"}" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>

{if isset($allFtp)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Utilisateur</th>
          <th>Mot de passe</th>
          <th>Propriétaire</th>
          <th>Section</th>
          <th>Dossier</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$allFtp item="account"}
            <tr>
              <td>{$account.fu_user}</td>
              <td>
                <div id="{$account.fu_id}-pass" style="display:none;">{$account.fu_pass}</div>
                <div id="{$account.fu_id}-label">********* <a href="#" onclick="show({$account.fu_id})"><i class="glyphicon glyphicon-user"></i><span class="hide">Voir</span></a></div>
              </td>
              <td><a href="{mkurl action="user" page="view" user=$account.user_id}">{$account.user_name|escape}</a></td>
              <td><a href="{mkurl action="section" page="details" section=$account.section_id}">{$account.section_name}</a></td>
              <td>{$account.fu_path}</td>
              <td>
                <div class="btn-group">
                  {if $account.fu_deletable=="YES"}<a href="{mkurl action="ftp" page="del" account=$account.fu_id}" class="btn btn-danger glyphicon glyphicon-trash"></a>{/if}
                  <a href="{mkurl action="ftp" page="edit" account=$account.fu_id}" class="btn btn-warning glyphicon glyphicon-pencil"></a>
                </div>
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <p>
      Vous ne gérez aucun compte FTP.
    </p>
{/if}

<script type="text/javascript">
  {literal}
      function show(id) {
          $('#' + id + '-pass').show();
          $('#' + id + '-label').hide();
          setTimeout(function () {
              $('#' + id + '-pass').hide();
              $('#' + id + '-label').show();
          }, 5000);
      }
  {/literal}
</script>
{include "foot.tpl"}
