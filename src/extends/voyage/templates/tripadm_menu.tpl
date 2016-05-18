
<style type="text/css">
  .info {
      margin: 10px 0px;
  }
</style>

<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation"><a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Gestion</a></li>
  <li role="presentation"><a href="{mkurl action="trip" page="admin_files" trip=$trip->tr_id}">Participants</a></li>
  <li role="presentation" class="active">
    {if $smarty.get.page=="index"}
        Général
    {elseif $smarty.get.page=="contact"}
        Contacts
    {elseif $smarty.get.page=="health"}
        Santé
    {elseif $smarty.get.page=="order"}
        Trésorerie
    {else}
        Gestion
    {/if}
  </li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Dossier participant {$ufile->tu_id}</h2>


<div class="submenu" style="margin-bottom: 20px">
  <ul class="nav nav-tabs">
    <li role="presentation"{if $smarty.get.page=="index"} class="active"{/if}><a href="{mkurl action="tripadm" file=$ufile->tu_id}">Général</a></li>
    <li role="presentation"{if $smarty.get.page=="contact"} class="active"{/if}><a href="{mkurl action="tripadm" page="contact" file=$ufile->tu_id}">Contacts</a></li>
    <li role="presentation"{if $smarty.get.page=="health"} class="active"{/if}><a href="{mkurl action="tripadm" page="health" file=$ufile->tu_id}">Santé</a></li>
    <li role="presentation"{if $smarty.get.page=="order"} class="active"{/if}><a href="{mkurl action="tripadm" page="order" file=$ufile->tu_id}">Trésorerie</a></li>
  </ul>
</div>
