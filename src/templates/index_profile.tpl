{include "head.tpl"}

<script type="text/javascript" src="crypt.js"></script>
<script type="text/javascript">
    function crypt(form) {ldelim}
            if (form.elements.pwd1.value != form.elements.pwd2.value) {ldelim}
                        alert('Les mots de passe ne sont pas identiques.')
                        return false
  {rdelim}
          form.elements.oldpass.value = My_Crypt(My_Crypt("{$smarty.session.user.user_name}:" + form.elements.oldpass.value) + "{$random}")
          form.elements.pwd2.value = ''
          form.elements.pwd1.value = My_Crypt("{$smarty.session.user.user_name}:" + form.elements.pwd1.value)
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

<ul class="nav nav-pills" role="tablist">
  <li class="active"><a href="#edit" role="tab" data-toggle="pill">Profile</a></li>
  <li class=""><a href="#password" role="tab" data-toggle="pill">Mot de passe</a></li>
  <li class=""><a href="#print" role="tab" data-toggle="pill">Fiche de membre</a></li>
</ul>

<div class="pill-content">
  <div class="pill-pane active" id="edit">
    <form method="POST" class="form-horizontal">

      <legend>Edition du profile</legend>

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
    </form>
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
    <form class="form-horizontal" action="{mkurl action="index" page="print"}" method="POST">

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
  </div>
</div>
{include "foot.tpl"}