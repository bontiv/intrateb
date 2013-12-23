{include "head.tpl"}

{if $succes}
    <div class="success alert-success">Inscription passé avec succès.</div>
{/if}
{if $error}
    <div class="alert-danger danger"><strong>Erreur !</strong> {$error}</div>
{/if}


<h1>Inscription</h1>
<div class="alert alert-info">
    <p><strong>Attention !</strong> L'inscription sur ce site ne tient pas lieu
        d'inscription à l'association. Vous devez vous inscrire et cotiser en
        tant qu'adhérent pour bénéficier de tous les services de ce site.
        </p>
</div>

<form method="POST" action="{mkurl action="index" page="create"}">
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
        Mot de passe :<br/>
        <input type="password" name="user_pass" />
    </p>
    <p>
        Confirmez le mot de passe :<br/>
        <input type="password" name="confirmPassword" />
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
        <input type="submit" name="Inscription" class="btn btn-default" />
    </p>
</form>
{include "foot.tpl"}