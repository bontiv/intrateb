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

    <div class="alert alert-info">
      <p>
        En séléctionnant l'option de disponibilité "Si nécessaire", vous ne
        serez séléctionné sur la mission seulement si nous ne pouvons pas
        compléter les places avec les personnes disponibles.
      </p>
    </div>

    <form method="POST" action="{mkurl action="mission" page="dispo"}">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Mission</th>
            <th>Début</th>
            <th>Fin</th>
              {acl level=USER}
            <th>Disponibilité</th>
              {/acl}
          </tr>
        </thead>
        <tbody>
          {foreach $missions as $mission}
              <tr>
                <td><a href="{mkurl action="mission" page="show" id=$mission->m_id}">{$mission->m_name|escape}</a></td>
                <td>{$mission->m_date_start|date_format:'%d/%m/%Y %H:%I'}</td>
                <td>{$mission->m_date_end|date_format:'%d/%m/%Y %H:%I'}</td>
                {acl level=USER}
                <td>
                  <input type="radio" value="BUSY" name="DISPO_{$mission->m_id}" id="mission_{$mission->m_id}_no" {if isset($mission->md_dispo) and $mission->raw_md_dispo=="BUSY"}checked="checked"{/if} />
                  <label for="mission_{$mission->m_id}_no"><div class="label label-danger">Non</div></label>
                  <input type="radio" value="UNKNOW" name="DISPO_{$mission->m_id}" id="mission_{$mission->m_id}_maybe" {if isset($mission->md_dispo) and $mission->raw_md_dispo=="UNKNOW"}checked="checked"{/if} />
                  <label for="mission_{$mission->m_id}_maybe"><div class="label label-warning">Si nécessaire</div></label>
                  <input type="radio" value="AVAILABLE" name="DISPO_{$mission->m_id}" id="mission_{$mission->m_id}_yes" {if isset($mission->md_dispo) and $mission->raw_md_dispo=="AVAILABLE"}checked="checked"{/if} />
                  <label for="mission_{$mission->m_id}_yes"><div class="label label-success">Oui</div></label>

                </td>
                {/acl}
              </tr>
          {/foreach}
        </tbody>
      </table>
      <p>
        <input type="submit" class="btn btn-primary" value="Enregistrer dispo." />
      </p>
    </form>
{else}
    <div class="alert alert-info">
      <p>Aucune mission.</p>
    </div>
{/if}

{include "foot.tpl"}