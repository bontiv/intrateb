{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li><a href="{mkurl action="event" page='view' event=$event->event_id}">{$event->event_name}</a></li>
  <li><a href="{mkurl action="event" page='staff' event=$event->event_id section=$section->section_id}">Activités {$section->section_name}</a></li>
  <li class="active">Ajout des points</li>
</ol>

<form method="POST" class="form-horizontal">
  <h1>{$event->event_name}</h1>
  <h2>Ajout d'activité pour {$section->section_name}</h2>

  <fieldset>
    <legend>Informations générales</legend>

    {$form}


  </fieldset>

  <fieldset>
    <legend>Attributions</legend>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Pseudo</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Période</th>
          <th>Ingorer</th>
          <th>Note (sur 20)</th>
        </tr>
      </thead>
      <tbody>
        {foreach $staffs as $staff}
            <tr>
              <td>{$staff.user_name|escape}</td>
              <td>{$staff.user_lastname|escape}</td>
              <td>{$staff.user_firstname|escape}</td>
              <td>
                <select class="input-md form-control" name="staff-{$staff.user_id}-period">
                  {foreach $periods[$staff.user_type] as $period}
                      <option value="{$period.period_id}">{$period.period_label}</option>
                  {/foreach}
                </select>
              </td>
              <td>
                <select name="staff-{$staff.user_id}-ok" class="input-sm form-control">
                  <option selected="selected" value="YES">Noter</option>
                  <option value="NO">Ignorer</option>
                </select>
              </td>
              <td><input class="mark" id="mark-{$staff@index}" type="text" value="20" name="staff-{$staff.user_id}-mark" onkeypress="return enterDown({$staff@index}, event)" /></td>
            </tr>
        {/foreach}
      </tbody>
    </table>

  </fieldset>

  <div class="form-group">
    <label class="col-md-4 control-label" for="edit"></label>
    <div class="col-md-8">
      <button id="edit" name="edit" class="btn btn-success">Valider</button>
    </div>
  </div>
</form>

<script type="text/javascript">
    $(function () {
        $('input.mark').spinner({
            min: 0,
            max: 20
        });

        $('#mark-0').select();
    });

    function enterDown(id, event) {
        if (event.keyCode === 13) {
            var next = id + 1;
            var elmt = $('#mark-' + next);
            if (elmt.length > 0) {
                elmt.select();
            } else {
                $('#edit').focus();
            }
            return false;
        }
        return true;
    }
</script>
{include "foot.tpl"}