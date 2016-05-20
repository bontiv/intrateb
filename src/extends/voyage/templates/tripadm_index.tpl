{include "head.tpl"}

{include "$extendTpls/tripadm_menu.tpl"}

<div class="panel-group">

  <div class="panel panel-default">
    <div class="panel-heading panel-title">
      Participant
    </div>
    <div class="panel-body">

      <!-- Select Basic -->
      <div class="row">
        <label class="col-md-offset-2 col-md-4">Nom de famille</label>
        <div class="col-md-4">
          {if $ufile->raw_tu_participant==0}
             {$ufile->tu_user->user_lastname|escape}
          {else}
              {$ufile->tu_participant->ta_lastname}
          {/if}
        </div>
      </div>

      <div class="row">
        <label class="col-md-offset-2 col-md-4">Prénom</label>
        <div class="col-md-4">
          {if $ufile->raw_tu_participant==0}
              {$ufile->tu_user->user_firstname|escape}
          {else}
              {$ufile->tu_participant->ta_firstname}
          {/if}
        </div>
      </div>

      <div class="row">
        <label class="col-md-offset-2 col-md-4">Courriel</label>
        <div class="col-md-4">
          {if $ufile->raw_tu_participant==0}
              {$ufile->tu_user->user_email}
          {else}
              {$ufile->tu_participant->ta_mail}
          {/if}
        </div>
      </div>

      <div class="row">
        <label class="col-md-offset-2 col-md-4">Téléphone</label>
        <div class="col-md-4">
          {if $ufile->raw_tu_participant==0}
              {$ufile->tu_user->user_phone}
          {else}
              {$ufile->tu_participant->ta_phone}
          {/if}
        </div>
      </div>

    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading panel-title">
      Voyage
    </div>
    <div class="panel-body">

      <!-- Select Basic -->
      <div class="row">
        <label class="col-md-offset-2 col-md-4">Transport</label>
        <div class="col-md-4">
          Hopopo !!!
        </div>
      </div>

      <div class="row">
        <label class="col-md-offset-2 col-md-4">Hébergement</label>
        <div class="col-md-4">
          Hopopo !!!
        </div>
      </div>

      <div class="row">
        <label class="col-md-offset-2 col-md-4">Présent au départ</label>
        <div class="col-md-4">
          Non
        </div>
      </div>

    </div>
  </div>


  <div class="panel panel-default">
    <div class="panel-heading panel-title">
      Elements réceptionnés
    </div>
    <div class="panel-body">

      <div class="row info">
        <label class="col-md-offset-2 col-md-4">Paiement ({$ufile->raw_tu_price} €)</label>
        <div class="col-md-4">
          {if $ufile->raw_tu_payment=="YES"}
              <span class="text-success">Déposé</span>
              <a href="{mkurl action="tripadm" page="index" tu_payment=NO file=$ufile->tu_id}" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove-circle"></span>
              </a>
          {else}
              <span class="text-danger">Non déposé</span>
              <a href="{mkurl action="tripadm" page="index" tu_payment=YES file=$ufile->tu_id}" class="btn btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
              </a>
          {/if}
        </div>
      </div>

      <div class="row info">
        <label class="col-md-offset-2 col-md-4">Caution</label>
        <div class="col-md-4">
          {if $ufile->raw_tu_caution=="YES"}
              <span class="text-success">Déposé</span>
              <a href="{mkurl action="tripadm" page="index" tu_caution=NO file=$ufile->tu_id}" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove-circle"></span>
              </a>
          {else}
              <span class="text-danger">Non déposé</span>
              <a href="{mkurl action="tripadm" page="index" tu_caution=YES file=$ufile->tu_id}" class="btn btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
              </a>
          {/if}
        </div>
      </div>

      <div class="row info">
        <label class="col-md-offset-2 col-md-4">Décharge</label>
        <div class="col-md-4">
           {if $ufile->raw_tu_responsability_agreement=="YES"}
                <span class="text-success">Déposé</span>
                <a href="{mkurl action="tripadm" page="index" tu_responsability_agreement=NO file=$ufile->tu_id}" class="btn btn-danger">
                  <span class="glyphicon glyphicon-remove-circle"></span>
                </a>
            {else}
                <span class="text-danger">Non déposé</span>
                <a href="{mkurl action="tripadm" page="index" tu_responsability_agreement=YES file=$ufile->tu_id}" class="btn btn-success">
                  <span class="glyphicon glyphicon-ok-circle"></span>
                </a>
            {/if}
        </div>
      </div>

    </div>
  </div>

  {* Panel Footer *}
  <div class="panel panel-default">
    <div class="panel-footer">
      <form class="form-inline">
        <div class="form-group">
          <select class="form-control">
            <option disabled>1. Contacts (non modifiable)</option>
            <option>2. Santé</option>
            <option>3. Compléments</option>
            <option>4. Choix billet</option>
            <option disabled>5. Validation billet</option>
            <option>6. Apport des pièces</option>
            <option disabled>7. Choix transport</option>
            <option disabled>8. Hébergement</option>
            <option disabled>9. Validation héberg.</option>
            <option>10. Fin</option>
          </select>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Sauv. étape" />
        </div>
      </form>
    </div>
  </div>
  {* / Panel Footer *}

</div>

{include "foot.tpl"}