{include "head.tpl"}

{include "$extendTpls/tripadm_menu.tpl"}

<form method="POST" action="{mkurl action="tripusr" page="new" trip=$trip->tr_id}" class="form-horizontal">
  <div class="panel-group">

    {* Panel traveller *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Voyageur
      </div>
      <div class="panel-body">
        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_lastname">Nom</label>
          <div class="col-md-4">
            {if $ufile->raw_tu_participant==0}
             {$ufile->tu_user->user_lastname|escape}
            {else}
                {$ufile->tu_participant->ta_lastname}
            {/if}
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_firstname">Prénom</label>
          <div class="col-md-4">
            {if $ufile->raw_tu_participant==0}
              {$ufile->tu_user->user_firstname|escape}
            {else}
                {$ufile->tu_participant->ta_firstname}
            {/if}
          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_phone">Téléphone fixe</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
              </span>
               {if $ufile->raw_tu_participant==0}
                  {$ufile->tu_user->user_phone}
              {else}
                  {$ufile->tu_participant->ta_phone}
              {/if}
            </div>

          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_cell">Téléphone portable</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
              </span>
               {if $ufile->raw_tu_participant==0}
                  {$ufile->tu_user->user_phone}
              {else}
                  {$ufile->tu_participant->ta_cell}
              {/if}
            </div>

          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_mail">Adresse email</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">@</span>
              {if $ufile->raw_tu_participant==0}
                  {$ufile->tu_user->user_email}
              {else}
                  {$ufile->tu_participant->ta_mail}
              {/if}
            </div>

          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_street">Adresse postale</label>
          <div class="col-md-4">
            {if $ufile->raw_tu_participant==0}
                {$ufile->tu_user->user_address}
            {else}
                {$ufile->tu_participant->ta_street1}
            {/if}
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_zipcode">Code postal</label>
          <div class="col-md-4">
            {if $ufile->raw_tu_participant==0}
                {$ufile->tu_user->user_cp}
            {else}
                {$ufile->tu_participant->ta_zipcode}
            {/if}
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_town">Ville</label>
          <div class="col-md-4">
            {if $ufile->raw_tu_participant==0}
                {$ufile->tu_user->user_town}
            {else}
                {$ufile->tu_participant->ta_town}
            {/if}
          </div>
        </div>

      </div>
    </div>
    {* / Panel traveller *}

    {* Panel emergency *}
    <div class="panel panel-default">
      <div class="panel-heading panel-title">
        Contacts en cas d'urgence
      </div>
      <div class="panel-body">
        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_lastname">Nom</label>
          <div class="col-md-4">
            {$ufile->tu_emergency->ta_lastname}
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_firstname">Prénom</label>
          <div class="col-md-4">
            {$ufile->tu_emergency->ta_firstname}
          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_phone">Téléphone fixe</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
              </span>
              {$ufile->tu_emergency->ta_phone}
            </div>

          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_cell">Téléphone portable</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-earphone"></span>
              </span>
              {$ufile->tu_emergency->ta_cell}
            </div>

          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_mail">Adresse email</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">@</span>
              {$ufile->tu_emergency->ta_mail}
            </div>

          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_street">Adresse postale</label>
          <div class="col-md-4">
            {$ufile->tu_emergency->ta_street1}
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_zipcode">Code postal</label>
          <div class="col-md-4">
            {$ufile->tu_emergency->ta_zipcode}
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_town">Ville</label>
          <div class="col-md-4">
            {$ufile->tu_emergency->ta_town}
          </div>
        </div>

      </div>
    </div>
    {* / Panel emergency contact *}

  </div>
</form>

{include "foot.tpl"}
