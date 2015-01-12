{include "head.tpl"}
<h1>Gestion FTP</h1>

<div class="alert alert-warning" role="alert">
  <p><strong>Attention !</strong> Les mots de passe FTP ne sont pas chiffrés et
    visible par les responsables du service. Veuillez ne pas utiliser un mot de passe
    commun à plusieurs services.</p>
</div>

{if isset($badpass)}
    <div class="alert alert-danger" role="alert">
      <p><strong>Erreur,</strong> {$badpass}</p>
    </div>
{/if}

<form class="form-horizontal" method="POST" action="{mkurl action="ftp" page="edit" account=$account->fu_id}">
  <fieldset>

    <!-- Form Name -->
    <legend>Modification de mot de passe de {$account->fu_user}</legend>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="textinput">Mot de passe</label>
      <div class="col-md-4">
        <input id="textinput" name="password" placeholder="*******" class="form-control input-md" type="password">
        <span class="help-block">Veuillez utiliser au moins 8 caractères.</span>
      </div>
    </div>

    <!-- Button (Double) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="button1id"></label>
      <div class="col-md-8">
        <button id="button1id" name="button1id" type="submit" class="btn btn-success">Valider</button>
        <button id="button2id" name="button2id" type="button" onclick="location = '{mkurl action="ftp"}'" class="btn btn-danger">Retour</button>
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}
