{include "head.tpl"}

<!-- Modal passwordRecover -->
<form action="{mkurl action="user" page="editpassword" user=$user.user_id}" method="POST">
  <div class="modal fade" id="passwordRecover" tabindex="-1" role="dialog" aria-labelledby="Password Recover" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Réinitialisation du mot de passe</h4>
        </div>
        <div class="modal-body">
          <p>Entrez un nouveau mot de passe ci-dessous.</p>
          <div class="form-group">
            <input type="password" name="password" class="form-control input-md" placeholder="Mot de passe" />
          </div>
          <div class="form-group">
            <input type="password" name="password2" class="form-control input-md" placeholder="Confirmation" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Valider</button>
        </div>
      </div>
    </div>
  </div>
</form>

<h1>Utilisateurs</h1>
<h2>{$user.user_name}</h2>

<p><strong>Nom : </strong>{$user.user_lastname}<br/>
  <strong>Prenom : </strong>{$user.user_firstname}<br/>
  <strong>ID : </strong>{$user.user_id}<br/>
  <strong>Ecole : </strong>{$user.ut_name}<br/>
  <strong>Login IONIS : </strong>{$user.user_login}<br/>
  <strong>email : </strong>{$user.user_email}<br/>
  <strong>Téléphone : </strong>{$user.user_phone}<br/>
  <strong>Accès : </strong>{$user.user_role}</p>

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#passwordRecover">
  <i class="glyphicon glyphicon-edit"></i> Mot de passe
</button>

<h3>Ses sections</h3>
<form method="POST" class="form-inline" action="{mkurl action="user" page="invit_section" user=$user.user_id}">
  <p>Adhésion
    <select name="us_section" class="form-control" style="width:200px;">
      {foreach from=$section_list item="sec"}
          <option value="{$sec.section_id}">{$sec.section_name}</option>
      {/foreach}
    </select>
    <input type="submit" value="OK" class="btn btn-default" />
  </p>
</form>
{if isset($sections)}
    <table  class="table table-striped table-hover">
      <thead>
      <th>Section</th>
      <th>Type</th>
      <th>Participation</th>
      <th>Action</th>
    </thead>
    <tbody>
      {foreach from=$sections item="line"}
          <tr>
            <td><a href="{mkurl action="section" page="details" section=$line.section_id}">{$line.section_name}</a></td>
            <td>{$line.section_type}</td>
            <td>{$line.us_type}</td>
            <td>{acl level="SUPERUSER"}<a href="{mkurl action="user" page="quit" section=$line.section_id user=$user.user_id}" class="btn btn-danger">Quitter</a>{/acl}</td>
          </tr>
      {/foreach}
    </tbody>
</table>
{/if}

<h3>Ses adhésions</h3>
{if isset($mandates)}
    <table class="table table-striped table-hover">
      <thead>
      <th>Mandat</th>
    </thead>
    <tbody>
      {foreach from=$mandates item='m'}
          <tr>
            <td>{$m->mandate_label}</td>
          </tr>
      {/foreach}
    </tbody>
</table>
{else}
    <p>Cet utilisateur n'a jamais été membre.</p>
{/if}

<h3>Ses events</h3>
{include "foot.tpl"}
