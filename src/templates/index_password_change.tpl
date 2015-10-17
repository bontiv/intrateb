{include "head.tpl"}

<script type="text/javascript" src="crypt.js"></script>
<script type="text/javascript">
    function crypt(form) {ldelim}
            if (form.elements.pwd1.value != form.elements.pwd2.value) {ldelim}
                        alert('Les mots de passe ne sont pas identiques.')
                        return false
  {rdelim}
          form.elements.pwd2.value = ''
          form.elements.pwd1.value = My_Crypt("{$user->user_name|escape:'javascript'}:" + form.elements.pwd1.value)
          return true
  {rdelim}
</script>

<form class="form-horizontal" method="POST" onsubmit="return crypt(this)">
  <fieldset>

    <!-- Form Name -->
    <legend>Changement de mot de passe</legend>

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


{include "foot.tpl"}