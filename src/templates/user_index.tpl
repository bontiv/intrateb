{include "head.tpl"}

<h1>Administration</h1>
<h3>Gestion des utilisateurs</h3>
<a class="btn btn-link" href="{mkurl action="user" page="add"}" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a>
<a class="btn btn-link" href="{mkurl action="user" page="check"}" role="button" data-toggle="modal"><i class="glyphicon glyphicon-check" title="Valider des cotisations"></i> Valider</a>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Pseudo</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Téléphone</th>
      <th>email</th>
      <th>Login</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$ptable.rows item="line"}
        <tr>
          <td><a href="{mkurl action="user" page="view" user=$line.user_id}">{$line.user_name}</a></td>
          <td>{$line.user_lastname}</td>
          <td>{$line.user_firstname}</td>
          <td>{$line.user_phone}</td>
          <td><a href="{$line.user_email}">{$line.user_email}</a></td>
          <td><a href="https://intra.epitech.eu/user/{$line.user_login}/">{$line.user_login}</a></td>
          <td>
            <div class="btn-group">
              <a href="{mkurl action="user" page="delete" user=$line.user_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
              <a href="{mkurl action="user" page="edit" user=$line.user_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
              <a href="#" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i></a>
            </div>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>


{include "foot.tpl"}