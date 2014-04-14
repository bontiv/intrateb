{include "head.tpl"}

<h1>Administration</h1>
<h2>Droits d'accès</h2>
<form method="POST" action="{mkurl action="admin" page="update"}">
    <table  class="table table-striped table-hover">
        <thead>
        <th>Module</th>
        <th>Page</th>
        <th>Niveau</th>
        </thead>
        <tbody>
            {foreach from=$acls item="line"}
                <tr>
                    <td>{$line.acl_action}</td>
                    <td>{$line.acl_page}</td>
                    <td><select name="acl{$line.acl_id}">
                            <option {if $line.acl_acces=="ANNONYMOUS"}selected="selected"{/if} value="ANNONYMOUS">Libre</option>
                            <option {if $line.acl_acces=="GUEST"}selected="selected"{/if} value="GUEST">Visiteur</option>
                            <option {if $line.acl_acces=="USER"}selected="selected"{/if} value="USER">Membre</option>
                            <option {if $line.acl_acces=="SUPERUSER"}selected="selected"{/if} value="SUPERUSER">Responsable</option>
                            <option {if $line.acl_acces=="ADMINISTRATOR"}selected="selected"{/if} value="ADMINISTRATOR">Admin</option>
                        </select>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    <p><input class="btn btn-default" type="submit"/></p>
</form>

{include "foot.tpl"}