{include "head.tpl"}
<ol class="breadcrumb">
  <li><a href="{mkurl action="mission" page="index"}">Missions</a></li>
  <li class="active">{$mission->m_name}</li>
</ol>

<h1>Missions</h1>
<h2>{$mission->m_name}</h2>

<dl class="dl-horizontal">
  <dt>Début</dt>
  <dd>{$mission->m_date_start}</dd>
  <dt>Fin</dt>
  <dd>{$mission->m_date_end}</dd>
  <dt>Statut</dt>
  <dd>{$mission->m_state}</dd>
  <dt>Staffs nécessaires</dt>
  <dd>{$mission->m_wanted}</dd>
  <dt>Description</dt>
  <dd>{$mission->m_desc|escape}</dd>
</dl>

<div class="btn-group">
  <a href="#" class="btn btn-default">
    <span class="glyphicon glyphicon-envelope"></span>
    Contacter
  </a>
  <a href="#" class="btn btn-default">
    <span class="glyphicon glyphicon-user"></span>
    Réponses
  </a>
  <a href="#" class="btn btn-warning">
    <span class="glyphicon glyphicon-lock"></span>
    Verrouiller
  </a>
</div>

{if isset($dispos)}
    <h3>Participants</h3>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Pseudo</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Téléphone</th>
          <th>Email</th>
          <th>Dispo</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach $dispos as $dispo}
            <tr>
              <td><a href="{mkurl action="user" page="view" user=$dispo->raw_md_user}">{$dispo->md_user->user_name|escape}</a></td>
              <td>{$dispo->md_user->user_lastname|escape}</td>
              <td>{$dispo->md_user->user_firstname|escape}</td>
              <td><a href="tel:{$dispo->md_user->user_phone|escape}">{$dispo->md_user->user_phone|escape}</a></td>
              <td><a href="mailto:{$dispo->md_user->user_email|escape}">{$dispo->md_user->user_email|escape}</a></td>
              <td>{$dispo->md_dispo}</td>
              <td>
                {if $dispo->raw_md_dispo eq "AVAILABLE"}
                    <a href="#" class="btn btn-danger btn-xs">
                      <span class="glyphicon glyphicon-ban-circle"></span> Refuser
                    </a>
                {elseif $dispo->raw_md_dispo eq "REFUSED"}
                    <a href="#" class="btn btn-success btn-xs">
                      <span class="glyphicon glyphicon-ok-circle"></span> Accepter
                    </a>
                {/if}
              </td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{/if}

{include "foot.tpl"}
