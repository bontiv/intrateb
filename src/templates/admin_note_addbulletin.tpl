{include "head.tpl"}

<h2>Ajout d'un bulletin</h2>

<p>Séléctionnez la période où ajouter le bulletin.</p>

<form action="{mkurl action="admin_note" page="addbulletin"}" method="POST">

  <h3>Choix du générateur</h3>
  <!-- Select Generator -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="generator">Générateur de bulletin</label>
    <div class="col-md-4">
      <select id="generator" name="generator" class="form-control">
        {foreach $generators as $generator}
            <option>{$generator}</option>
        {/foreach}
      </select>
    </div>
  </div>
  <br/>
  <br/>

  <h3>Choix de la période</h3>

  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Nom</th>
        <th>Ecole</th>
        <th>Début</th>
        <th>Fin</th>
      </tr>
    </thead>
    <tbody>
      {foreach $periods as $period}
          <tr>
            <td><input type="radio" name="period" value="{$period->period_id}" class="form-control input-sm" id="period{$period->period_id}" /></td>
            <td><label for="period{$period->period_id}">{$period->period_label}</label></td>
            <td>{$period->period_type->ut_name}</td>
            <td>{$period->period_start}</td>
            <td>{$period->period_end}</td>
          </tr>
      {/foreach}
    </tbody>
  </table>

  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
{include "foot.tpl"}
