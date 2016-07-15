{include "head.tpl"}
<script type="text/javascript" >
    function crytogun(form)
  {ldelim}
          var login = form.elements;
          var chain = My_Crypt(login.login.value + ":" + login.password.value);
          login.password.value = (chain);
  {rdelim}
</script>
<script type="text/javascript" src="crypt.js" >alert("Impossible de lancer l'algo de cryptage")</script>

{if isset($msg)}
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Oups! </strong> {$msg}
    </div>
{/if}

{if isset($msuccess)}
    <div class="alert {if $msuccess}alert-success{else}alert-danger{/if}">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {if $msuccess}
          Un email de vérification a été envoyé.
      {else}
          <strong>Oups! </strong> l'email n'a pas pu être envoyé.
      {/if}
    </div>
{/if}


<form class="form-horizontal" action="{mkurl action="index" page="password"}" method="POST">
  <fieldset>

    <!-- Form Name -->
    <legend>Mot de passe perdu</legend>

    <!-- Text input-->
    <div class="form-group{if isset($error_mail) && $error_mail} has-error{/if}">
      <label class="col-md-4 control-label" for="mail">Adresse email</label>
      <div class="col-md-4">
        <input id="mail" name="mail" placeholder="bontiv@exemple.com" class="form-control input-md" required="" type="email"{if isset($smarty.post.mail)} value="{$smarty.post.mail}"{/if}>
        <span class="help-block">Entrez votre adresse email</span>
      </div>
    </div>
    <!-- Text input-->
    <div class="form-group{if isset($error_captcha) && $error_captcha} has-error{/if}">
      <label class="col-md-4 control-label" for="captcha_code">Vérification Captcha</label>
      <div class="col-md-4">
        <div class="g-recaptcha" data-sitekey="{$siteKey}"></div>
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="valider">Réinitialiser mon mot de passe</label>
      <div class="col-md-4">
        <button id="valider" name="valider" class="btn btn-primary">Envoyer</button>
      </div>
    </div>

  </fieldset>
</form>


{include "foot.tpl"}
