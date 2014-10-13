{include "head.tpl"}

{* BLOCK : Modal ajout membre *}
<div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Passer en membre</h4>
      </div>
      <div class="modal-body">
        Vous allez passer <span id="member_firstname"></span> membre de l'association sur
        le mandat :

        Passez par le bouton de validation. J'ai la flème pour cet écran.

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary">Valider</button>
      </div>
    </div>
  </div>
</div>
{* END BLOCK : Modal ajout membre *}
<div class="">
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
            <td>
              <a href="{mkurl action="user" page="view" user=$line.user_id}">{$line.user_name}</a>
              {if $line.user_role=='USER'}<span class="label label-default">Membre</span>{/if}
              {if $line.user_role=='ADMINISTRATOR'}<span class="label label-primary">Admin</span>{/if}
            </td>
            <td>{$line.user_lastname}</td>
            <td>{$line.user_firstname}</td>
            <td>{$line.user_phone}</td>
            <td><a href="{$line.user_email}">{$line.user_email}</a></td>
            <td><a href="https://intra.epitech.eu/user/{$line.user_login}/">{$line.user_login}</a></td>
            <td>
              <div class="btn-group">
                <a href="{mkurl action="user" page="delete" user=$line.user_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                <a href="{mkurl action="user" page="edit" user=$line.user_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                {if $line.user_role=='GUEST'}<a href="#" class="btn btn-info" data-toggle="modal" data-target="#addMember"><i class="glyphicon glyphicon-heart"></i></a>{/if}
              </div>
            </td>
          </tr>
      {/foreach}
    </tbody>
  </table>
</div>

{include "foot.tpl"}