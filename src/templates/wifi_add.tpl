{include "head.tpl"}

<form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{mkurl action="wifi" page="add"}">
  <fieldset>

    <!-- Form Name -->
    <legend>Ajout d'un set de tokens</legend>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="duration">Durée des tokens</label>
      <div class="col-md-4">
        <input id="duration" name="duration" placeholder="1440" class="form-control input-md" required="" type="text">

      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="file">Fichier Roll</label>
      <div class="col-md-4">
        <input id="file" name="file" placeholder="" class="form-control input-md" required="" type="file">
        <span class="help-block">Fichier récupéré depuis le pare-feu</span>
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="save"></label>
      <div class="col-md-4">
        <button id="save" name="save" class="btn btn-primary">Sauvegarder</button>
      </div>
    </div>

  </fieldset>
</form>


{include "foot.tpl"}
