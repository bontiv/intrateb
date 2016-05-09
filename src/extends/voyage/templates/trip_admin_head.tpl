<div class="col-md-3">
  <ul class="nav nav-pills nav-stacked">
    <li role="presentation" class="{if $smarty.get.page=="admin"}active{/if}">
      <a href="{mkurl action="trip" page="admin" trip=$trip->tr_id}">Présentation</a>
    </li>
    <li role="presentation" class="{if $smarty.get.page=="admin_files"}active{/if}">
      <a href="{mkurl action="trip" page="admin_files" trip=$trip->tr_id}">Participants</a>
    </li>
    <li role="presentation" class="{if $smarty.get.page=="admin_tickets"}active{/if}">
      <a href="{mkurl action="trip" page="admin_tickets" trip=$trip->tr_id}">Types Billets</a>
    </li>
    <li role="presentation" class="{if $smarty.get.page=="admin_cars"}active{/if}">
      <a href="{mkurl action="trip" page="admin_cars" trip=$trip->tr_id}">Transports</a>
    </li>
    <li role="presentation" class="{if $smarty.get.page=="admin_rooms"}active{/if}">
      <a href="{mkurl action="trip" page="admin_rooms" trip=$trip->tr_id}">Hébergements</a>
    </li>
    <li role="presentation" class="{if $smarty.get.page=="admin_options"}active{/if}">
      <a href="{mkurl action="trip" page="admin_options" trip=$trip->tr_id}">Compléments</a>
    </li>
    <li role="presentation" class="{if $smarty.get.page=="admin_receipt"}active{/if}">
      <a href="{mkurl action="trip" page="admin_receipt" trip=$trip->tr_id}">Encaissement</a>
    </li>
  </ul>
</div>
