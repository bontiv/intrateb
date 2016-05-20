{include "head.tpl"}

<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation" class="active">{$trip->tr_name|escape}</li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Dossier d'inscription <small>étape 2</small></h2>

<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
    <span class="sr-only">20% Complete</span>
  </div>
</div>

{if isset($errors)}
    {foreach $errors as $error}
        <div class="alert alert-dismissable alert-danger" role='alert'>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Attention !</strong> {$error}
        </div>
    {/foreach}
{/if}

<form method="POST" action="{mkurl action="tripusr" page="step2" file=$ufile->tu_id}" class="form-horizontal">
  <div class="panel-group">

    {* Panel santé *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Santé
      </div>
      <div class="panel-body">
        <fieldset>

          {$health}

        </fieldset>

        {if isset($smarty.post.traveller) and $smarty.post.traveller=="new"}
            {include "$extendTpls/tripusr_contact.tpl" prefix="t"}
        {/if}

      </div>
    </div>
    {* / Panel traveller *}

    {* Panel autre *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Remarques diverses
      </div>
      <div class="panel-body">
        <fieldset>

          {$memo}

        </fieldset>

        {if isset($smarty.post.emergency) and $smarty.post.emergency=="new"}
            {include "$extendTpls/tripusr_contact.tpl" prefix="e"}
        {/if}

      </div>
    </div>
    {* / Panel emergency contact *}

    {* Panel Footer *}
    <div class="panel panel-default">
      <div class="panel-footer">
        <input type="submit" class="btn btn-primary" name="next" value="Suivant" />
      </div>
    </div>
    {* / Panel Footer *}

  </div>
</form>

{include "foot.tpl"}
