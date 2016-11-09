{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="event"}">Events</a></li>
  <li class="active">{$event.event_name}</li>
</ol>

{include "event_head.tpl"}

<div role="tabpanel">

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="sections">
      {acl action="event" page="addsection" event=$event.event_id}
      <div>
        <form class="form-inline" action="{mkurl action="event" page="addsection" event=$event.event_id}" method="POST">
          Ajout de section :
          <div class="form-group">
            <select class="form-control input-md" name="es_section">
              {foreach from=$sections item="i"}
                  <option value="{$i.section_id}">{$i.section_name}</option>
              {/foreach}
            </select>
          </div>
          <input type="submit" class="btn btn-default" value="ajouter" />
        </form>
      </div>
      {/acl}
      <table width="100%" class="table table-striped">
        <thead>
        <th>Section</th>
        <th>Nombre de staffs</th>
        <th>Candidature</th>
        {acl level="USER"}
          <th>Action</th>
        {/acl}
        </thead>
        <tbody>
          {foreach from=$es item="i"}
              <tr>
                <td><a href="{mkurl action="event" page="staff" section=$i.section_id event=$event.event_id}">{$i.section_name}</a></td>
                <td>
                  <div class="{if $i.staffs->count()>$i.es_needed}text-danger{elseif $i.staffs->count()==$i.es_needed}text-success{/if}">{$i.staffs->count()} / {$i.es_needed}</div>
                </td>
                <td>
                  {if $i.cdat}
                      {if $i.cdat.est_status=="OK"}<span class="label label-success">Accepté</span>{elseif $i.cdat.est_status=="NO"}<span class="label label-danger">Refusé</span>{else}<span class="label label-default">Candidat</span>{/if}
                  {/if}
                </td>
                {acl level="GUEST"}
                  <td>
                    {acl level="ADMINISTRATOR"}
                      <a class="btn btn-danger" href="{mkurl action="event" page="delsection" event=$event.event_id admsec=$i.section_id}">
                        <span class="glyphicon glyphicon-remove"></span>
                      </a>
                    {/acl}
                    {if not $i.cdat}
                        <a class="btn btn-primary" href="{mkurl action="event" page="joinsection" event=$event.event_id section=$i.section_id}"><span class="">Rejoindre</span></a>
                    {else}
                        <a class="btn btn-danger" href="{mkurl action="event" page="quitsection" event=$event.event_id section=$i.section_id}"><span class="">Quitter</span></a>
                    {/if}
                  </td>
                {/acl}
              </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>

  {include "foot.tpl"}