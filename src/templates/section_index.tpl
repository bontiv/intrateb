{include "head.tpl"}

<ol class="breadcrumb">
  <li class="active">Sections</li>
</ol>

<h1>Sections</h1>
<a class="btn btn-link" href="{mkurl action="section" page="add"}" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>

{if isset($sections)}

    <p class="alert alert-info">
      <strong>Le savez-vous ?</strong> Le bouton avec un coeur permet
      de candidater comme staff sur une section. En étant inscrit en staff
      sur une section, vous permettez aux responsables de la section concernée
      de vous contacter plus facilement ainsi que la possibilité de recevoir
      des points (Epices / Enacs) de la part de vos sections en dehors des
      événements publiques.
    </p>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Adresse</th>
          <th>Type</th>
          <th>Créateur</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$sections item="line"}
            <tr>
              <td><a href="{mkurl action="section" page="details" section=$line.section_id}">{$line.section_name}</a>
                {if $line.inType=="guest"}<span class="label label-default">En attente</span>{/if}
                {if $line.inType=="rejected"}<span class="label label-danger">Rejeté</span>{/if}
                {if $line.inType=="user"}<span class="label label-success">Staff</span>{/if}
                {if $line.inType=="manager"}<span class="label label-primary">Manager</span>{/if}
              </td>
              <td>{if $line.section_ml}<a href="mailto:{$line.section_ml}">{$line.section_ml}</a>{/if}</td>
              <td>{$line.section_type}</td>
              <td>{$line.user_name|escape}</td>
              <td>
                <div class="btn-group">
                  {acl level="ADMINISTRATOR"}<a href="{mkurl action="section" page="delete" section=$line.section_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>{/acl}
                  {acl level="ADMINISTRATOR"}<a href="{mkurl action="section" page="edit" section=$line.section_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>{/acl}
                    {if $line.inType}
                    <a href="{mkurl action="section" page="goout" section=$line.section_id}" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                    {else}
                    <a href="{mkurl action="section" page="goin" section=$line.section_id}" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i></a>
                    {/if}
                </div>
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <p>Aucune section définie.</p>
{/if}

{include "foot.tpl"}