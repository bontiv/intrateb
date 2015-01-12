{include "head.tpl"}
<h1>Gestion FTP</h1>

<div class="alert alert-warning" role="alert">
  <p><strong>Attention !</strong> Les mots de passe FTP ne sont pas chiffrés et
    visible par les responsables du service. Veuillez ne pas utiliser un mot de passe
    commun à plusieurs services.</p>
</div>

{if isset($error)}
    <div class="alert alert-danger" role="alert">
      <p><strong>Erreur,</strong> {$error}</p>
    </div>
{/if}

<form class="form-horizontal" method="POST" action="{mkurl action="ftp" page="add"}">
  <fieldset>

    <!-- Form Name -->
    <legend>Ajout d'utilisateur</legend>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="user">Utilisateur FTP</label>
      <div class="col-md-4">
        <input id="user" name="user" placeholder="bontivFTP" class="form-control input-md" type="text">
        <span class="help-block">Nom du compte FTP (utilisé pour la connexion).</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="password">Mot de passe</label>
      <div class="col-md-4">
        <input id="password" name="pass" placeholder="*******" class="form-control input-md" type="password">
        <span class="help-block">Veuillez utiliser au moins 8 caractères.</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="member">Utilisateur intranet</label>
      <div class="col-md-4">
        <input id="member" name="member" placeholder="bontiv" class="form-control input-md" type="text">
        <span class="help-block">L'utilisateur doit exister sur l'intranet.</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="section">Section gérante</label>
      <div class="col-md-4">
        <select id="section" name="section" class="form-control input-md">
          {foreach from=$groups item="section"}
              <option value="{$section.section_id}">{$section.section_name}</option>
          {/foreach}
        </select>
        <span class="help-block">Section pouvant modifier le compte.</span>
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
