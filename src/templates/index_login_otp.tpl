{include "head.tpl"}

<div class="alert alert-warning">
  <p>
    Ce compte est protégé par l'authentification en deux facteurs. Veuillez
    entrer le code généré par l'application Google Authenticator.
  </p>
</div>

{* Affichage pour PC *}
<div class="hidden-sm hidden-xs" class="container" style="position:absolute; left:35%; top:30%; max-width: 330px;
     padding: 19px 29px 29px;
     margin: 0 auto 20px;
     background-color: #fff;
     border: 1px solid #e5e5e5;
     -webkit-border-radius: 5px;
     -moz-border-radius: 5px;
     border-radius: 5px;
     -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
     -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
     box-shadow: 0 1px 2px rgba(0,0,0,.05);">
  <form id="login" name="login" class="form-signin" onsubmit="return crytogun(this)" method="POST">
    <input type="hidden" name="login" value="{$smarty.post.login}" />
    <input type="hidden" name="password" value="{$smarty.post.password}" />
    <input type="hidden" name="redirect" value="{$smarty.request.redirect}" />
    <center><h2 class="form-signin-heading">Identifiez-vous</h2></center>
    <table border="0" style="">
      <tbody><tr>
          <td>Code OTP</td>
          <td><input class="form-control" class="input-block-level" type="text" name="otp_code" /></td>
        </tr>
      </tbody></table>
    <button style="float:right" class="btn btn-large btn-primary" type="submit" value="OK">Connexion</button>
  </form>
</div>

{* Affichage mobile *}
<div class="hidden-md hidden-lg container-fluid container">
  <form id="login-xs" name="login" class="form-signin form-horizontal" onsubmit="return crytogun(this)" method="POST">
    <input type="hidden" name="login" value="{$smarty.post.login}" />
    <input type="hidden" name="password" value="{$smarty.post.password}" />
    <input type="hidden" name="redirect" value="{$smarty.request.redirect}" />
    <legend>Identifiez-vous</legend>

    <fieldset>
      <div class="form-group">
        <label class="col-md-4 control-label" for="login">Code OTP</label>
        <div class="col-md-8">
          <input class="form-control input-md" type="text" id="login" name="otp_code" />
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-offset-4 col-md-8">
          <button style="float:right" class="btn btn-large btn-primary" type="submit" value="OK">Connexion</button>
        </div>
      </div>

    </fieldset>
  </form>
</div>

{if $msg}
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Oups! </strong> {$msg}
    </div>
{/if}


{include "foot.tpl"}
