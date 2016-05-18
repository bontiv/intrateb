{include "head.tpl"}

{include "$extendTpls/tripadm_menu.tpl"}

{if isset($errors)}
    {foreach $errors as $error}
        <div class="alert alert-dismissable alert-danger" role='alert'>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Attention !</strong> {$error}
        </div>
    {/foreach}
{/if}

<div class="panel-group">

  <div class="panel panel-default">
    <div class="panel-heading panel-title">
      Santé
    </div>
    <div class="panel-body">
      <div class="row">
        <label class="col-md-offset-2 col-md-4">Mal des transports</label>
        <div class="col-md-4">
          Hopopo !!!
        </div>
      </div>

      <div class="row">
        <label class="col-md-offset-2 col-md-4">Vertiges</label>
        <div class="col-md-4">
          Hopopo !!!
        </div>
      </div>

    </div>
  </div>

  <div class="panel panel-danger">{* Mettre danger si rempli *}
    <div class="panel-heading panel-title">
      Allergies
    </div>
    <div class="panel-body">

      Info...

    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading panel-title">
      Informations complémentaires
    </div>
    <div class="panel-body">

      Info...

    </div>
  </div>

</div>

{include "foot.tpl"}