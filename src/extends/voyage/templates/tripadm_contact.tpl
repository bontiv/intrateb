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
            Tootoo
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_firstname">Prénom</label>
          <div class="col-md-4">
            Tootoo
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
              Tootoo
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
              Tootoo
            </div>

          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_mail">Adresse email</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">@</span>
              Tootoo
            </div>

          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_street">Adresse portale</label>
          <div class="col-md-4">
            Tootoo
            <span class="help-block">Numéro et rue</span>
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_zipcode">Code postal</label>
          <div class="col-md-4">
            Tootoo
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_town">Ville</label>
          <div class="col-md-4">
            Tootoo
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
            Tootoo
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_firstname">Prénom</label>
          <div class="col-md-4">
            Tootoo
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
              Tootoo
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
              Tootoo
            </div>

          </div>
        </div>

        <!-- Prepended text-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_mail">Adresse email</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">@</span>
              Tootoo
            </div>

          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_street">Adresse portale</label>
          <div class="col-md-4">
            Tootoo
            <span class="help-block">Numéro et rue</span>
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_zipcode">Code postal</label>
          <div class="col-md-4">
            Tootoo
          </div>
        </div>

        <!-- Text input-->
        <div class="row info">
          <label class="col-md-4 control-label" for="{$prefix}_town">Ville</label>
          <div class="col-md-4">
            Tootoo
          </div>
        </div>

      </div>
    </div>
    {* / Panel emergency contact *}

  </div>
</form>

{include "foot.tpl"}