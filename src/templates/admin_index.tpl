{include "head.tpl"}

<style type="text/css">
  .admCol {
      width: 90%;margin-left: 5%;
  }
</style>

<h1>Administration</h1>
<h2>Droits d'accès</h2>
<form method="POST" action="{mkurl action="admin" page="update"}">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    {foreach from=$acls item="page" key="section"}
        <div class="panel panel-default">

          {* Header *}
          <div class="panel-heading" role="tab" id="heading{$section}">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#{$section}" aria-expanded="false" aria-controls="{$section}">
                Action {$section}
              </a>
            </h4>
          </div>

          <div id="{$section}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{$section}">
            <div class="panel-body">
              <table  class="table table-striped table-hover">
                <thead>
                <th>Module</th>
                <th>Page</th>
                <th>Niveau</th>
                <th>Groupes responsables</th>
                </thead>
                <tbody>
                  {foreach from=$page item="line"}
                      <tr>
                        <td>{$line.acl_action}</td>
                        <td>{$line.acl_page}</td>
                        <td><select class="admCol" name="acl{$line.acl_id}">
                            <option {if $line.acl_acces=="ANNONYMOUS"}selected="selected"{/if} value="ANNONYMOUS">Libre</option>
                            <option {if $line.acl_acces=="GUEST"}selected="selected"{/if} value="GUEST">Visiteur</option>
                            <option {if $line.acl_acces=="USER"}selected="selected"{/if} value="USER">Membre</option>
                            <option {if $line.acl_acces=="SUPERUSER"}selected="selected"{/if} value="SUPERUSER">Responsable</option>
                            <option {if $line.acl_acces=="ADMINISTRATOR"}selected="selected"{/if} value="ADMINISTRATOR">Admin</option>
                          </select>
                        </td>
                        <td>
                          <select name="groups{$line.acl_id}[]" class="admCol" multiple="multiple" size="5">
                            {foreach from=$grps item="grp"}
                                <option value="{$grp.section_id}"{if isset($aclGrps[$line.acl_id]) and in_array($grp.section_id, $aclGrps[$line.acl_id])} selected="selected"{/if}>{$grp.section_name}</option>
                            {/foreach}
                          </select>
                        </td>
                      </tr>
                  {/foreach}
                </tbody>
              </table>
            </div>
          </div>
        </div>
    {/foreach}
  </div>
  <p></p>
  <p><input class="btn btn-default" type="submit"/></p>
</form>

{include "foot.tpl"}