
<fieldset>

  <!-- Form Name -->
  <legend>Form Name</legend>

  <!-- Appended Input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tq_amount">Montant</label>
    <div class="col-md-4">
      <div class="input-group">
        <input id="tq_amount" name="tq_amount" class="form-control" placeholder="0,00" required="" type="text">
        <span class="input-group-addon">€ (EUR)</span>
      </div>

    </div>
  </div>

  <!-- Multiple Radios -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tq_method">Moyen</label>
    <div class="col-md-4">
      <div class="radio">
        <label for="tq_method-0">
          <input name="tq_method" id="tq_method-0" value="CHEQ" checked="checked" type="radio">
          Chèque
        </label>
      </div>
      <div class="radio">
        <label for="tq_method-1">
          <input name="tq_method" id="tq_method-1" value="CASH" type="radio">
          Especes
        </label>
      </div>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tq_from">Emetteur</label>
    <div class="col-md-4">
      <input id="tq_from" name="tq_from" placeholder="Jean DUPOND" class="form-control input-md" type="text">
      <span class="help-block">Emetteur du chèque ou dépositaire des espèces.</span>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tq_bank">Banque</label>
    <div class="col-md-4">
      <input id="tq_bank" name="tq_bank" placeholder="LCL" class="form-control input-md" type="text">
      <span class="help-block">Chèques seulement</span>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tq_number">Numéro de chèque</label>
    <div class="col-md-4">
      <input id="tq_number" name="tq_number" placeholder="13321" class="form-control input-md" type="text">
      <span class="help-block">Pour les chèques seulement</span>
    </div>
  </div>

</fieldset>
