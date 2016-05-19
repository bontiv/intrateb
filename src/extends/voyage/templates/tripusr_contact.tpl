<fieldset>
  <legend>Nouveau contact</legend>


  <!-- Text input-->
  <div class="form-group{if isset($ferr.$prefix.lastname)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_lastname">Nom</label>
    <div class="col-md-4">
      <input id="{$prefix}_lastname" name="{$prefix}[lastname]" placeholder="" class="form-control input-md" type="text" value="{if isset($smarty.post.$prefix.lastname)}{$smarty.post.$prefix.lastname}{/if}" />
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group{if isset($ferr.$prefix.firstname)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_firstname">Prénom</label>
    <div class="col-md-4">
      <input id="{$prefix}_firstname" name="{$prefix}[firstname]" placeholder="" class="form-control input-md" type="text" value="{if isset($smarty.post.$prefix.firstname)}{$smarty.post.$prefix.firstname}{/if}" />

    </div>
  </div>

  <!-- Prepended text-->
  <div class="form-group{if isset($ferr.$prefix.phone)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_phone">Téléphone fixe</label>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-earphone"></span>
        </span>
        <input id="{$prefix}_phone" name="{$prefix}[phone]" class="form-control" placeholder="01.99.99.99.99" type="text" value="{if isset($smarty.post.$prefix.phone)}{$smarty.post.$prefix.phone}{/if}" />
      </div>

    </div>
  </div>

  <!-- Prepended text-->
  <div class="form-group{if isset($ferr.$prefix.cell)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_cell">Téléphone portable</label>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-earphone"></span>
        </span>
        <input id="{$prefix}_cell" name="{$prefix}[cell]" class="form-control" placeholder="01.99.99.99.99" type="text" value="{if isset($smarty.post.$prefix.cell)}{$smarty.post.$prefix.cell}{/if}" />
      </div>

    </div>
  </div>

  <!-- Prepended text-->
  <div class="form-group{if isset($ferr.$prefix.mail)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_mail">Adresse email</label>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">@</span>
        <input id="{$prefix}_mail" name="{$prefix}[mail]" class="form-control" placeholder="" type="text" value="{if isset($smarty.post.$prefix.mail)}{$smarty.post.$prefix.mail}{/if}" />
      </div>

    </div>
  </div>

  <!-- Text input-->
  <div class="form-group{if isset($ferr.$prefix.street)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_street">Adresse postale</label>
    <div class="col-md-4">
      <input id="{$prefix}_street" name="{$prefix}[street]" placeholder="placeholder" class="form-control input-md" type="text" value="{if isset($smarty.post.$prefix.street)}{$smarty.post.$prefix.street}{/if}" />
      <span class="help-block">Numéro et rue</span>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group{if isset($ferr.$prefix.zipcode)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_zipcode">Code postal</label>
    <div class="col-md-4">
      <input id="{$prefix}_zipcode" name="{$prefix}[zipcode]" placeholder="75002" class="form-control input-md" type="text" value="{if isset($smarty.post.$prefix.zipcode)}{$smarty.post.$prefix.zipcode}{/if}" />

    </div>
  </div>

  <!-- Text input-->
  <div class="form-group{if isset($ferr.$prefix.town)} has-error{/if}">
    <label class="col-md-4 control-label" for="{$prefix}_town">Ville</label>
    <div class="col-md-4">
      <input id="{$prefix}_town" name="{$prefix}[town]" placeholder="" class="form-control input-md" type="text" value="{if isset($smarty.post.$prefix.town)}{$smarty.post.$prefix.town}{/if}" />

    </div>
  </div>

</fieldset>
