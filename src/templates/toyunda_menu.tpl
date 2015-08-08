<ul class="nav nav-pills">
  <li role="presentation"{if $smarty.request.page=="index"} class="active"{/if}><a href="{mkurl action="toyunda" page="index"}">Liste des demandes</a></li>
  <li role="presentation"{if $smarty.request.page=="todo"} class="active"{/if}><a href="{mkurl action="toyunda" page="todo"}">Liste des tâches</a></li>
  <li role="presentation"{if $smarty.request.page=="add"} class="active"{/if}><a href="{mkurl action="toyunda" page="add"}">Ajout d'une demande</a></li>
  <li role="presentation" class="disabled{if $smarty.request.page=="listall"} active{/if}"><a href="#">Liste complète</a></li>
  <li role="presentation" class="dropdown{if $smarty.request.page|truncate:3:""=="adm"} active{/if}">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      Gestion <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li><a href="{mkurl action="toyunda" page="admstatus"}">Statuts</a></li>
      <li><a href="{mkurl action="toyunda" page="admtypes"}">Types</a></li>
      <li><a href="{mkurl action="toyunda" page="admlangs"}">Langues</a></li>
    </ul>
  </li>

</ul>

<br />
