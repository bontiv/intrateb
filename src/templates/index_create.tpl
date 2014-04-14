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

<div class="container col-lg-12">
    <form method="POST" action="{mkurl action="index" page="create"}">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Pseudo</span>
                <input class="form-control" type="text" name="user_name" />
            </div>
            <br/>
            <div class="input-group">
                <span class="input-group-addon">Nom</span>
                <input class="form-control" type="text" name="user_lastname" />
            </div>
            <br/>
            <div class="input-group">
                <span class="input-group-addon">Prénom</span>
                <input class="form-control" type="text" name="user_firstname" />
            </div>
            <br/>
            <div class="input-group">
                <span class="input-group-addon">Mot de passe</span>
                <input class="form-control" type="password" name="user_pass" />
            </div>
            <br/>
                <input class="form-control" type="password" name="confirmPassword" placeholder="Confirmez le mot de passe" />
            <br/>
        </div>

        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Type</span>
                <select name="user_type" class="form-control">
                {foreach from=$types item="t"}
                    <option value="{$t.ut_id}">{$t.ut_name}</option>
                {/foreach}
                </select>
            </div>
            <br/>
            <div class="input-group">
                <span class="input-group-addon">Login IONIS</span>
                <input class="form-control" type="text" name="user_login" />
            </div>
            <br/>
            <div class="input-group">
                <span class="input-group-addon">Email</span>
                <input class="form-control" type="text" name="user_email" />
            </div>
            <br/>
            <div class="input-group">
                <span class="input-group-addon">Téléphone</span>
                <input class="form-control" type="text" name="user_phone" />
            </div>
            <br/>
        </div>
        <div class="col-lg-4">
            <div class="btn btn-default btn-disable">
                Captcha <br/>
                <!-- Captcha ICI !!! -->
            </div>
            <br/><br/>
            <div>
                <input type="submit" name="Inscription" class="btn btn-success" />
            </div>
        </div>
    </form>
</div>
{include "foot.tpl"}