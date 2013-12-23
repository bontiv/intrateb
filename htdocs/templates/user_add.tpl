{include "head.tpl"}

{if $succes}
    <div class="success alert-success">Insertion OK</div>
{/if}
{if $error}
    <div class="alert-danger danger">Insertion fail</div>
{/if}


<h1>Administration</h1>
<h2>Utilisateurs</h2>

<ul class="nav nav-pills">
  <li><a href="{mkurl action="user"}">Liste</a></li>
  <li class="active"><a href="{mkurl action="user" page="add"}" class="btn"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<form method="POST" action="{mkurl action="user" page="add"}">
    <p>
        Pseudo :<br/>
        <input type="text" name="user_name" />
    </p>
    <p>
        Nom :<br/>
        <input type="text" name="user_lastname" />
    </p>
    <p>
        Prénom :<br/>
        <input type="text" name="user_firstname" />
    </p>
    <p>
        Type :<br/>
        <select name="user_type">
        {foreach from=$types item="t"}
            <option value="{$t.ut_id}">{$t.ut_name}</option>
        {/foreach}
        </select>
    </p>
    <p>
        Login IONIS :<br/>
        <input type="text" name="user_login" />
    </p>
    <p>
        Email :<br/>
        <input type="text" name="user_email" />
    </p>
    <p>
        Téléphone :<br/>
        <input type="text" name="user_phone" />
    </p>
    <p>
        <input type="submit" name="Ajouter" class="btn btn-default" />
    </p>
</form>
{include "foot.tpl"}