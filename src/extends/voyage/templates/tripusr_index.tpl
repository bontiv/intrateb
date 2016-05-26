{include "head.tpl"}
<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation" class="active">{$trip->tr_name|escape}</li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>

<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">
      Description
    </div>
  </div>
  <div class="panel-body">
    <p>
      Voyage se déroulant du <b>{$trip->tr_start|date_format:'%d/%m/%Y à %H:%M'}</b> au <b>{$trip->tr_end|date_format:'%d/%m/%Y à %H:%M'}</b>. Pour participer au voyage, il vous suffit de créer un nouveau dossier. Les dossiers de candidature sont ouverts jusqu'au <b>{$trip->tr_maxdate|date_format:'%d/%m/%Y'}</b>. La rétractation est possible jusqu'au <b>{$trip->tr_retractdate|date_format:'%d/%m/%Y'}</b>.
    </p>
  </div>
</div>

{if $new}
<p>
  <a href="{mkurl action="tripusr" page="new" trip=$trip->tr_id}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nouveau dossier
  </a>
</p>
{/if}

<div class="container-fluid">
  {if isset($userfiles)}
      <table class="table table-striped">
        <thead>
          <tr>
            <td>Participant</td>
            <td>Etape</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          {foreach $userfiles as $userfile}
              <tr>
                <td>
                  {if $userfile->raw_tu_participant==0}
                      Vous !
                  {else}
                      {$userfile->tu_participant->ta_firstname|escape} {$userfile->tu_participant->ta_lastname|escape}
                  {/if}
                </td>
                <td>
                  {$userfile->tu_step}
                </td>
                <td>
                  <a href="{mkurl action="tripusr" page="continue" file=$userfile->tu_id}" class="btn btn-primary btn-xs">
                    <span class="glyphicon glyphicon-file"></span>
                    Continuer / éditer
                  </a>
                   {if $delete}
                    <a href="{mkurl action="tripusr" page="delete" file=$ufile->tu_id}" class="btn btn-danger btn-xs" onclick="return confirm('Supprimer totalement la candidature ?');">
                      <span class="glyphicon glyphicon-trash"></span>
                      Supprimer
                    </a>
                  {/if}
                </td>
              </tr>
          {/foreach}
        </tbody>
      </table>
  {else}
      <p class="alert alert-warning">
        Vous n'avez aucun dossier de candidature sur ce voyage !
      </p>
  {/if}
</div>

{include "foot.tpl"}
