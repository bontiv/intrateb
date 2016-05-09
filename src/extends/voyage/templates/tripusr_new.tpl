{include "head.tpl"}

<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation" class="active">{$trip->tr_name|escape}</li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Dossier d'inscription <small>étape 1</small></h2>

<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
    <span class="sr-only">10% Complete</span>
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

<form method="POST" action="{mkurl action="tripusr" page="new" trip=$trip->tr_id}" class="form-horizontal">
  <div class="panel-group">

    {* Panel traveller *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Voyageur
      </div>
      <div class="panel-body">
        <fieldset>

          <!-- Select Basic -->
          <div class="form-group{if isset($ferr.traveller) and $ferr.traveller==true} has-error{/if}">
            <label class="col-md-4 control-label" for="traveller">Participant (voyageur)</label>
            <div class="col-md-4">
              <select id="traveller" name="traveller" class="form-control">
                <optgroup label="Autre">
                  <option value="me"{if isset($smarty.post.traveller) and $smarty.post.traveller=="me"} selected{/if}>Vous même ({$_user.user_firstname|escape} {$_user.user_lastname|escape})</option>
                  <option value="new"{if isset($smarty.post.traveller) and $smarty.post.traveller=="new"} selected{/if}>Nouveau</option>
                </optgroup>
                <optgroup label="Carnet d'adresse"></optgroup>
                {if isset($contacts)}
                    {foreach $contacts as $contact}
                        <option value="{$contact->ta_id}"{if isset($smarty.post.traveller) and $smarty.post.traveller==$contact->ta_id} selected{/if}>{$contact->ta_firstname} {$contact->ta_lastname}</option>
                    {/foreach}
                {/if}
              </select>
            </div>
          </div>

        </fieldset>

        {if isset($smarty.post.traveller) and $smarty.post.traveller=="new"}
            {include "$extendTpls/tripusr_contact.tpl" prefix="t"}
        {/if}

      </div>
    </div>
    {* / Panel traveller *}

    {* Panel emergency *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Contacts en cas d'urgence
      </div>
      <div class="panel-body">
        <fieldset>

          <!-- Select Basic -->
          <div class="form-group{if isset($ferr.emergency) and $ferr.emergency==true} has-error{/if}">
            <label class="col-md-4 control-label" for="emergency">Contact en cas d'urgence</label>
            <div class="col-md-4">
              <select id="emergency" name="emergency" class="form-control">
                <optgroup label="Autre">
                  <option value="me"{if isset($smarty.post.emergency) and $smarty.post.emergency=="me"} selected{/if}>Vous même ({$_user.user_firstname|escape} {$_user.user_lastname|escape})</option>
                  <option value="new"{if isset($smarty.post.emergency) and $smarty.post.emergency=="new"} selected{/if}>Nouveau</option>
                </optgroup>
                <optgroup label="Carnet d'adresse"></optgroup>
                {if isset($contacts)}
                    {foreach $contacts as $contact}
                        <option value="{$contact->ta_id}"{if isset($smarty.post.emergency) and $smarty.post.emergency==$contact->ta_id} selected{/if}>{$contact->ta_firstname} {$contact->ta_lastname}</option>
                    {/foreach}
                {/if}
              </select>
            </div>
          </div>
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
        <input type="submit" class="btn btn-primary" value="Suivant" />
      </div>
    </div>
    {* / Panel Footer *}

  </div>
</form>

{include "foot.tpl"}