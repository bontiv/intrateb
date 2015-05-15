{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="ml"}">Maillings</a></li>
  <li class="active">MAJ Auto</li>
</ol>

<h2>Synchronisation auto</h2>

<p>
  <a href="{mkurl action="ml" page="execUpdate"}" class="btn btn-warning">Executer</a>
</p>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Section</th>
      <th>ML</th>
      <th>A Ajouter</th>
      <th>A Supprimer</th>
    </tr>
  </thead>
  <tbody>
    {foreach $sections as $section}
        <tr>
          <td><a href="{mkurl action="section" page="details" section=$section.section_id}">{$section.section_name}</a></td>
          <td>{$section.section_ml}</td>
          <td>
            {foreach $toAdd[$section.section_id] as $mail}
                {$mail}
            {/foreach}
          </td>
          <td>
            {foreach $toDelete[$section.section_id] as $mail}
                {$mail}
            {/foreach}
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>

{include "foot.tpl"}
