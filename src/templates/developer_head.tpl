<h1>Developpeurs</h1>

{* Les onglets *}
<ul class="nav nav-pills" style="margin-top: 20px;">
  <li{if $smarty.get.page=='index'} class="active"{/if}>
    <a href="{mkurl action=developer page=index}">Applications</a>
  </li>
  <li{if $smarty.get.page=='add'} class="active"{/if}>
    <a href="{mkurl action=developer page=add}">Nouvelle appli</a>
  </li>
  <li{if $smarty.get.page=='log'} class="active"{/if}>
    <a href="{mkurl action=developer page=log}">Log connexion</a>
  </li>
</ul>
