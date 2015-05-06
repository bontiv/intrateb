{include "head.tpl"}

<h2>Ajout d'un bulletin</h2>

<p>Séléctionnez la période où ajouter le bulletin.</p>

<table class="table">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Ecole</th>
      <th>Début</th>
      <th>Fin</th>
    </tr>
  </thead>
  <tbody>
    {foreach $periods as $period}
        <tr>
          <td><a href="{mkurl action="admin_note" page="addbulletin" id=$period->period_id}">{$period->period_label}</a></td>
          <td>{$period->period_type->ut_name}</td>
          <td>{$period->period_start}</td>
          <td>{$period->period_end}</td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}
