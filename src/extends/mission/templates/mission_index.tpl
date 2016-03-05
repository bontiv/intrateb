{include "head.tpl"}

<ol class="breadcrumb">
  <li class="active"><a href="{mkurl action="mission" page="index"}">Missions</a></li>
</ol>

<h1>Missions</h1>
<p>
  Ici, vous pouvez consulter les missions en attente au sein de l'association.
</p>

<p>
  {acl action="mission" page="create"}
  <a href="{mkurl action="mission" page="create"}" class="btn btn-default">
    <span class="glyphicon glyphicon-plus"></span> Ajout
  </a>
  {/acl}

</p>

{if isset($missions)}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Mission</th>
          <th>Début</th>
          <th>Fin</th>
          <th>Disponibilité</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        {foreach $missions as $mission}
            <tr>
              <td>{$mission->m_name|escape}</td>
              <td>{$mission->m_date_start|date_format:'%d/%m/%Y %H:%I'}</td>
              <td>{$mission->m_date_end|date_format:'%d/%m/%Y %H:%I'}</td>
              <td></td>
              <td></td>
            </tr>
        {/foreach}
      </tbody>
    </table>
{else}
    <div class="alert alert-info">
      <p>Aucune mission.</p>
    </div>
{/if}

{include "foot.tpl"}