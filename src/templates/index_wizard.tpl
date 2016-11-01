{include "head.tpl"}

<form class="form-horizontal" method="POST" action="{mkurl action="index" page="wizard"}">
  <fieldset>

    <!-- Form Name -->
    <legend>Assistant utilisateur</legend>

    <!-- Progress bar -->
    <div class="form-group">
      <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{$pcent}" aria-valuemin="0" aria-valuemax="100" style="width: {$pcent}%">
          <span class="sr-only">{$pcent}% Complete</span>
        </div>
      </div>
    </div>

    {$form}

    <!-- Button -->
    <div class="form-group">
      <div class="col-md-offset-4 col-md-4">
        <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Suivant" />
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}