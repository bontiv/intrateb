{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="section"}">Sections</a></li>
  <li><a href="{mkurl action="section" page='details' section=$section->section_id}">{$section->section_name}</a></li>
  <li class="active">Ajout des points</li>
</ol>

<form method="POST" class="form-horizontal">
  <h1>Ajout des points pour la section {$section->section_name}</h1>

  <fieldset>
    <legend>Informations générales</legend>

    {$form}


  </fieldset>

  <fieldset>
    <legend>Groupes et périodes de notation</legend>

    {foreach from=$types item="type"}
        <div class="form-group">
          <label class="col-md-4 control-label" for="type-{$type.id}">{$type.name}</label>
          <div class="col-md-4">
            <select id="type-{$type.id}" name="type-{$type.id}" class="form-control">
              {foreach from=$type.periods item="period"}
                  <option value="{$period.period_id}">{$period.period_label}</option>
              {/foreach}
            </select>
          </div>
        </div>
    {/foreach}
  </fieldset>

  <fieldset>
    <legend>Attributions</legend>

    <!-- Multiple Checkboxes -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="checkboxes">Participants</label>
      <div class="col-md-4">
        {foreach from=$staffs item='staff'}
            <div class="checkbox">
              <label for="staff-{$staff.user_id}">
                <input name="staffs[]" id="staff-{$staff.user_id}" value="{$staff.user_id}" type="checkbox">
                {$staff.user_name|escape}
              </label>
            </div>
        {/foreach}
      </div>
    </div>

  </fieldset>

  <div class="form-group">
    <label class="col-md-4 control-label" for="edit"></label>
    <div class="col-md-8">
      <button id="edit" name="edit" class="btn btn-success">Valider</button>
    </div>
  </div>
</form>


{include "foot.tpl"}