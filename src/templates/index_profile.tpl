{include "head.tpl"}

<script type="text/javascript" src="crypt.js"></script>
<script type="text/javascript">
    function crypt(form) {ldelim}
            if (form.elements.pwd1.value != form.elements.pwd2.value) {ldelim}
                        alert('Les mots de passe ne sont pas identiques.')
                        return false
  {rdelim}
          form.elements.oldpass.value = My_Crypt(My_Crypt("{$smarty.session.user.user_name|escape:'javascript'}:" + form.elements.oldpass.value) + "{$random}")
          form.elements.pwd2.value = ''
          form.elements.pwd1.value = My_Crypt("{$smarty.session.user.user_name|escape:'javascript'}:" + form.elements.pwd1.value)
          return true
  {rdelim}

      function updateSub() {ldelim}
              jQuery.ajax({ldelim}
                          url: "{mkurl action="index" page="subscriptions"}&mandate=" + $('#mandate').val(),
                          dataType: 'html',
                          success: function (data){ldelim}
                                          $('#subscription').html(data)
  {rdelim}
  {rdelim})
  {rdelim}

      $(function (){ldelim}
              updateSub()
  {rdelim})
</script>


<div class="modal fade" id="cardView">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Carte de membre</h4>
      </div>
      <div class="modal-body">
        <p><img src="" width="500px" id="cardImage" style="border: 2px solid black; border-radius: 25px;" /></p>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary">Fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<ul class="nav nav-pills" role="tablist">
  <li class="active"><a href="#edit" role="tablist" data-toggle="pill">Profile</a></li>
  <li class=""><a href="#password" role="tablist" data-toggle="pill">Mot de passe</a></li>
  <li class=""><a href="#card" role="tablist" data-toggle="pill">Carte de membre</a></li>
  <li class=""><a href="#print" role="tablist" data-toggle="pill">Fiche de membre</a></li>
  <li class=""><a href="#2factors" role="tablist" data-toggle="pill">Google Authenticator</a></li>
</ul>

<div class="pill-content">
  <div class="pill-pane active" id="edit">
    <form method="POST" class="form-horizontal">

      <legend>Edition du profil</legend>

      <fieldset>
        {$form}
      </fieldset>

      <div class="form-group">
        <label class="col-md-4 control-label" for="edit"></label>
        <div class="col-md-8">
          <button id="edit" name="edit" class="btn btn-success">Valider</button>
        </div>
      </div>
    </form>
  </div>

  <div class="pill-pane" id="password">
    <form class="form-horizontal" method="POST" onsubmit="return crypt(this)">
      <fieldset>

        <!-- Form Name -->
        <legend>Changement de mot de passe</legend>

        <!-- Password input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="oldpass">Ancien mot de passe</label>
          <div class="col-md-5">
            <input id="oldpass" name="oldpass" placeholder="password" class="form-control input-md" required="" type="password">

          </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="pwd1">Nouveau mot de passe</label>
          <div class="col-md-5">
            <input id="pwd1" name="pwd1" placeholder="password" class="form-control input-md" required="" type="password">

          </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="pwd2">Confirmer le mot de passe</label>
          <div class="col-md-5">
            <input id="pwd2" name="pwd2" placeholder="Retaper le nouveau passe" class="form-control input-md" required="" type="password">

          </div>
        </div>

        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="editpass"></label>
          <div class="col-md-8">
            <button id="editpass" name="editpass" class="btn btn-success">Valider</button>
          </div>
        </div>

      </fieldset>
    </form>
  </div>

  <div class="pill-pane" id="card">
    <h2>Edition des cartes de membre</h2>
    <p>La carte de membre peut être demandé par le gardien a tout moment sur
      le campus. Vous ne pouvez accéder librement sur le campus qu'en présence
      d'une carte de membre valide.</p>
    <h3>Etape 1: Paramètre de la photo</h3>
    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{mkurl action="index" page="photoedit"}">
      <fieldset>

        <!-- Ancienne photo-->
        <div class="form-group">
          <label class="col-md-4 control-label">Votre photo</label>
          <div class="col-md-5">
            <img src="{mkurl action="index" page="photo"}" alt="Aucune photo ou photo invalide" />
          </div>
        </div>

        <!-- Nouvelle photo-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="photo">Nouvelle photo</label>
          <div class="col-md-5">
            <input id="photo" name="photo" class="input-file" type="file">
            <span class="help-block">Veuillez mettre une photo en PNJ, GIF ou JPG.</span>

          </div>
        </div>

        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="editpass"></label>
          <div class="col-md-8">
            <button id="editpass" name="editpass" class="btn btn-success">Valider</button>
          </div>
        </div>

      </fieldset>
    </form>

    <h3>Etape 2: Création de la carte</h3>
    {if $isMember}
        <form class="form-horizontal" action="{mkurl action="cards" page="makeme"}" method="POST">

          <!-- List mandate -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="mandate">Mandat</label>
            <div class="col-md-5">
              <select id="mandate" name="mandate" class="form-control input-md" onchange="updateSub()">
                {foreach from=$usr_mandate item="l"}
                    <option value="{$l.mandate_id}">{$l.mandate_label}</option>
                {/foreach}
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="editpass"></label>
            <div class="col-md-8">

              <input type="submit" class="btn btn-primary" value="Créer la demande" />
            </div>
          </div>
        </form>
        <h3>Etape 3 : Suivi des demandes</h3>
        {if $cards}
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Date de création</th>
                  <th>Statut de la carte</th>
                  <th>Statut imprimeur</th>
                  <th>Mandat</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                {foreach from=$cards item="card"}
                    <tr>
                      <td>{$card->card_maketime}</td>
                      <td><span class="label
                                {if $card->raw_card_status=="NOPICTURE"}label-danger
                                {else}label-default{/if}
                                ">
                          {$card->card_status}</span></td>
                      <td>
                        {if $card->card_bundle}
                            <span class="label
                                  {if $card->card_bundle->raw_cbundle_status=="CREATED"}
                                      label-warning
                                  {elseif $card->card_bundle->raw_cbundle_status=="OK"}
                                      label-success
                                  {else}
                                      label-default
                                  {/if}">
                              {$card->card_bundle->cbundle_status}
                            </span>
                        {else}
                            <span class="label label-danger">Non envoyé</span>
                        {/if}
                      </td>
                      <td>{$card->card_mandate->mandate_label}</td>
                      <td>
                        {if $card->raw_card_status=="NOPICTURE" or $card->raw_card_status=="CREATED"}<a href="{mkurl action="cards" page="delmycard" card=$card->card_id}" class="btn btn-danger glyphicon glyphicon-trash"></a>{/if}
                        <a title="Voir la carte" href="#cardView" data-toggle="modal" onclick="$('#cardImage').attr('src', '{mkurl action="cards" page="viewmycard" card=$card->card_id}')" class="btn btn-default glyphicon glyphicon-eye-open"></a>
                      </td>
                    </tr>
                {/foreach}
              </tbody>
            </table>
        {else}
            <p>Vous n'avez encore aucune carte</p>
        {/if}
    {else}

        <p>La création de la carte n'est possible qu'après la validation de votre adhésion par le bureau.</p>
    {/if}
  </div>

  <div class="pill-pane" id="print">
    <h2>Création de la fiche de membre</h2>
    <p>
      La fiche de membre vous permet de valider votre adhésion à Epitanime.
      Elle peut être pré-remplie mais doit être signée par vous même. En
      signant la fiche de membre, vous approuvez l'exactitude des informations
      qui y sont inscrites.
    </p>
    <p>
      Le montant de la cotisation est isncrit dans le règlement intérieur
      de l'association.
    </p>

    {if isset($mandate)}
        <form target="_blank" class="form-horizontal" action="{mkurl action="index" page="print"}" method="POST">

          <!-- List mandate -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="mandate">Mandat</label>
            <div class="col-md-5">
              <select id="mandate" name="mandate" class="form-control input-md" onchange="updateSub()">
                {foreach from=$mandate item="l"}
                    <option value="{$l.mandate_id}">{$l.mandate_label}</option>
                {/foreach}
              </select>
            </div>
          </div>

          <!-- List cotisation -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="subscription">Type de cotisation</label>
            <div class="col-md-5">
              <select id="subscription" name="subscription" class="form-control input-md">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="editpass"></label>
            <div class="col-md-8">

              <input type="submit" class="btn btn-primary" value="Imprimer" />
            </div>
          </div>
        </form>
    {else}
        <div class="alert alert-warning">Aucun mandat n'est actuellement actif.</div>
    {/if}
  </div>

  <div class="pill-pane" id="2factors">

    {if $smarty.session.user.user_otp}
        <div class="alert alert-info">
          <p>L'authentification deux facteurs est actuellement mis en place
            sur votre compte.</p>
        </div>
    {else}
        <div class="alert alert-danger">
          <p>L'authentification deux facteurs n'est pas activé.</p>
        </div>
    {/if}

    <h2>Google Authenticator</h2>
    <div class="panel panel-warning">
      <div class="panel-heading">
        Note importante
      </div>
      <div class="panel-body">
        <p>
          Cetaines fonctionnalité de l'intra ne sont utilisables qu'après
          avoir configuré Google Authenticator. Il faut alors l'utiliser pour la
          connexion.
        </p>
      </div>
    </div>
    <p>
      Google Authenticator est une application pour la connexion en deux étapes.
      En activant ce paramètre, vous augmentez considérablement la sécurité
      de votre compte d'utilisateur.
    </p>
    {if not $smarty.session.user.user_otp}
        <p>
          Procédure d'activation :
        </p>
        <ol>
          <li>Installez l'application depuis <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=fr">Google Play Store</a></li>
          <li>Scannez le QR Code via Google Authenticator</li>
          <li>Entrez le code généré ci-dessous</li>
        </ol>
        <p>
          <img src="{mkurl action="twofactors" page="getQR"}" />
        </p>
    {/if}

    <form method="POST" action="{mkurl action="twofactors" page="set"}" class="form-horizontal">
      <fieldset>

        {if $smarty.session.user.user_otp}

            <input name="activation" id="activation-1" value="false" type="hidden" />

            <!-- Validation input-->
            <div class="form-group">
              <div class="col-md-offset-4 col-md-5">
                <input id="go" name="go" class="btn btn-danger" value="Désactiver Google Authenticator" type="submit" />

              </div>
            </div>
        {else}
            <input name="activation" id="activation-0" value="true" checked="checked" type="hidden" />

            <!-- Code input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="code">Code généré</label>
              <div class="col-md-5">
                <input id="code" name="code" placeholder="****" class="form-control input-md" type="text"/>

              </div>
            </div>



            <!-- Validation input-->
            <div class="form-group">
              <div class="col-md-offset-4 col-md-5">
                <input id="go" name="go" class="btn btn-primary" value="Valider" type="submit" />

              </div>
            </div>
        {/if}
      </fieldset>
    </form>
  </div>
</div>
{include "foot.tpl"}