{include "head.tpl"}

{if $succes}
    <div class="alert success alert-success" role="alert">
      Inscription passé avec succès. Vous pouvez dès à présent vous connecter.
    </div>
{/if}
{if $error}
    <div class="alert alert-danger danger" role="alert"><strong>Erreur !</strong> {$error}</div>
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
        <span class="input-group-addon">Pseudo (*)</span>
        <input class="form-control" type="text" name="user_name" value="{$user['user_name']}" required/>
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Nom</span>
        <input class="form-control" type="text" name="user_lastname" value="{$user['user_lastname']}"/>
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Prénom</span>
        <input class="form-control" type="text" name="user_firstname" value="{$user['user_firstname']}"/>
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Mot de passe (*)</span>
        {literal}
        <input class="form-control" type="password" name="user_pass" pattern=".{4,}" title="Le mot de passe doit faire au moins 4 caractères" required/>
        {/literal}
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Confirmation (*)</span>
        <input class="form-control" type="password" name="confirmPassword" placeholder="Confirmez le mot de passe" required/>
      </div>
      <br/>
    </div>

    <div class="col-lg-3">
      <div class="input-group">
        <span class="input-group-addon">Type</span>
        <select name="user_type" class="form-control" value="{$user['user_type']}">
          {foreach from=$types item="t"}
              <option value="{$t.ut_id}">{$t.ut_name}</option>
          {/foreach}
        </select>
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Login IONIS</span>
        <input class="form-control" type="text" name="user_login" value="{$user['user_login']}"/>
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Email (*)</span>
        <input class="form-control" type="email" name="user_email" value="{$user['user_email']}" required/>
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Téléphone</span>
        <input class="form-control" type="tel" name="user_phone" value="{$user['user_phone']}"/>
      </div>
      <br/>
      <div class="g-recaptcha" data-sitekey="{$siteKey}"></div>
    </div>
    <div class="col-lg-4">
      <div>
        <input type="submit" name="Inscription" class="btn btn-success" />
      </div>
    </div>
  </form>
</div>
{include "foot.tpl"}