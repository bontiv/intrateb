{include file="header.tpl"}

<div class="modal hide fade" id="addEvent" tabindex="-1" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Ajouter un événement</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>

<h1>Administration</h1>
<h3>Gestion des événements</h3>
<a class="btn" href="#addEvent" role="button" data-toggle="modal"><i class="icon-plus"></i> Ajouter</a>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Evenement</th>
      <th>Date de début</th>
      <th>Date de fin</th>
      <th>Statut</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Wei 2013</td>
      <td>27-09-2013 20:00:00</td>
      <td>29-09-2013 20:00:00</td>
      <td>Inscription jusqu'au 30-08-2013</td>
      <td>
        <div class="btn-group">
          <button class="btn btn-danger"><i class="icon-trash"></i></button>
          <button class="btn"><i class="icon-pencil"></i></button>
          <button class="btn btn-warning"><i class="icon-lock"></i></button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
{include file="footer.tpl"}