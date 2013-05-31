{include file="header.tpl"}

<div class="modal hide fade" id="addUser" tabindex="-1" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Ajouter un utilisateur</h3>
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
<h3>Gestion des utilisateurs</h3>
<a class="btn" href="#addUser" role="button" data-toggle="modal"><i class="icon-plus"></i> Ajouter</a>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Téléphone</th>
      <th>email</th>
      <th>Login</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>BONNET</td>
      <td>Remi</td>
      <td>06.83.56.27.46</td>
      <td><a href="mailto:prog.bontiv@gmail.com">prog.bontiv@gmail.com</a></td>
      <td><a href="https://intra.epitech.eu/user/bonnet_f/">bonnet_f</a></td>
      <td>
        <div class="btn-group">
          <button class="btn btn-danger"><i class="icon-trash"></i></button>
          <button class="btn"><i class="icon-pencil"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>FOLLET</td>
      <td>Estelle</td>
      <td class="muted">Non renseigné</td>
      <td><a href="mailto:prog.bontiv@gmail.com">prog.bontiv@gmail.com</a></td>
      <td><a href="https://intra.epitech.eu/user/bonnet_f/">bonnet_f</a></td>
      <td>
        <div class="btn-group">
          <button class="btn btn-danger"><i class="icon-trash"></i></button>
          <button class="btn"><i class="icon-pencil"></i></button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
{include file="footer.tpl"}