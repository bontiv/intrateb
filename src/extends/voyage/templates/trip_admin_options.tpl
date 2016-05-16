{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li><a href="{mkurl action="trip" page="view" trip=$trip->tr_id}">{$trip->tr_name|escape}</a></li>
  <li><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li class="active">Compléments</li>
</ol>

<h1>Gestion Voyage <small>{$trip->tr_name|escape}</small></h1>

<div class="container container-fluid" style="margin-top: 30px;">

  {include "{$extendTpls}/trip_admin_head.tpl"}

  <div class="col-md-9">
    <h2>Gestion des compléments</h2>
    <p>
      <a class="btn btn-default" href="{mkurl action="trip" page="option_add" trip=$trip->tr_id}">
        <span class="glyphicon glyphicon-plus"></span>
        Ajout
      </a>
    </p>
    {if isset($options)}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Groupe</th>
              <th>Label</th>
              <th>Question</th>
              <th>Options</th>
              <th>Gestion</th>
            </tr>
          </thead>
          <tbody>
            {foreach $options as $option}
                <tr>
                  <td>{$option->topt_group|escape}</td>
                  <td>{$option->topt_label|escape}</td>
                  <td>{$option->topt_question|escape}</td>
                  <td>???</td>
                  <td>
                    <div class="btn-group btn-group-xs">
                      <a href="{mkurl action="trip" page="option_edit" option=$option->topt_id}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>
                        Edition
                      </a>
                      <a href="{mkurl action="trip" page="option_delete" option=$option->topt_id}" class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-trash"></span>
                        Supprimer
                      </a>
                      <a href="{mkurl action="trip" page="opt_list" option=$option->topt_id}" class="btn btn-info btn-xs">
                        <span class="glyphicon glyphicon-list"></span>
                        Options
                      </a>
                    </div>
                  </td>
                </tr>
            {/foreach}
          </tbody>
        </table>
    {else}
        <div class="alert alert-warning">
          Aucun complément sur ce voyage.
        </div>
    {/if}
  </div>
</div>
{include "foot.tpl"}
