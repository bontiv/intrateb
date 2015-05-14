{include "head.tpl"}


<!-- Modal d'affichage d'une carte -->
<div class="modal fade" id="cardView">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Carte de membre</h4>
      </div>
      <div class="modal-body">
        <p><img src="" width="500px" id="cardImage" style="border: 2px solid black; border-radius: 25px;" /></p>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary">Fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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

<div class="row">

  <div class="col-lg-6">
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
  </div>
  <div class="col-lg-6">
    {if $user.user_photo != ""}
        {acl action="user" page="viewphoto"}
        <img src="{mkurl action="user" page="viewphoto" user=$user.user_id}" />
        {/acl}
    {/if}
  </div>
</div>

<div class="row">
  <div class="col-lg-12">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#sections" aria-controls="sections" role="tab" data-toggle="tab">Sections</a></li>
      <li role="presentation"><a href="#adhesions" aria-controls="adhesions" role="tab" data-toggle="tab">Adhésions</a></li>
      <li role="presentation" class="disabled"><a href="#events" aria-controls="events" role="tab" data-toggle="tab">Events</a></li>
      <li role="presentation"><a href="#cartes" aria-controls="cartes" role="tab" data-toggle="tab">Cartes</a></li>
      <li role="presentation"><a href="#mailling" aria-controls="mailling" role="tab" data-toggle="tab">Groupes de diffusion</a></li>
    </ul>
    <br />

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="sections">
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
      </div>
      <div role="tabpanel" class="tab-pane" id="adhesions">
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
      </div>
      <div role="tabpanel" class="tab-pane" id="events">
        <div class="alert alert-danger">
          <p>
            Ce module n'a pas encore été implémenté.
          </p>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="cartes">
        {if isset($cards)}
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Date de création</th>
                  <th>Statut de la carte</th>
                  <th>Statut imprimeur</th>
                  <th>Mandat</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                {foreach from=$cards item="card"}
                    <tr>
                      <td>{$card->card_maketime}</td>
                      <td><span class="label
                                {if $card->raw_card_status=="NOPICTURE"}label-danger
                                {else}label-default{/if}
                                ">
                          {$card->card_status}</span></td>
                      <td>
                        {if $card->card_bundle}
                            <span class="label
                                  {if $card->card_bundle->raw_cbundle_status=="CREATED"}
                                      label-warning
                                  {elseif $card->card_bundle->raw_cbundle_status=="OK"}
                                      label-success
                                  {else}
                                      label-default
                                  {/if}">
                              {$card->card_bundle->cbundle_status}
                            </span>
                        {else}
                            <span class="label label-danger">Non envoyé</span>
                        {/if}
                      </td>
                      <td>{$card->card_mandate->mandate_label}</td>
                      <td>
                        {if $card->raw_card_status=="CREATED"}
                            <a href="{mkurl action="cards" page="delcard" card=$card->card_id}" class="btn btn-danger glyphicon glyphicon-trash"></a>
                            <a href="{mkurl action="cards" page="okcard" card=$card->card_id}" class="btn btn-success glyphicon glyphicon-check"></a>
                        {/if}
                        <a title="Voir la carte" href="#cardView" data-toggle="modal" onclick="$('#cardImage').attr('src', '{mkurl action="cards" page="view" id=$card->card_id}')" class="btn btn-default glyphicon glyphicon-eye-open"></a>
                      </td>
                    </tr>
                {/foreach}
              </tbody>
            </table>
        {else}
            <div class="alert alert-warning">
              <p>Cet utilisateur n'a pas édité de carte.</p>
            </div>
        {/if}
      </div>

      {* Mailling *}
      <div role="tabpanel" class="tab-pane" id="mailling">

        {if isset($otherGroups)}
            <form class="form-inline" method="POST" action="{mkurl action="user" page="addGroup" user=$user.user_id}">
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                    <span class="input-group-addon">Ajout</span>
                    <select class="form-control" name="group">
                      {foreach $otherGroups as $group}
                          <option value="{$group->id}">{$group->name}</option>
                      {/foreach}
                    </select>
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit"><div class="glyphicon glyphicon-plus-sign"></div></button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->
            </form>
        {/if}

        {if isset($groups)}
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Adresse</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {foreach $groups as $group}
                    <tr>
                      <td><a href="{mkurl action="ml" page="view" ml=$group->id}">{$group->name}</a></td>
                      <td><a href="mailto:{$group->email}">{$group->email}</a></td>
                      <td>{$group->description}</td>
                      <td><a href="{mkurl action="user" page="removeGroup" user=$user.user_id group=$group->id}" class="btn btn-sm btn-danger glyphicon glyphicon-trash"></a></td>
                    </tr>
                {/foreach}
              </tbody>
            </table>
        {else}
            <div class="alert alert-warning">
              <p>Cet utilisateur n'est dans aucun groupe de diffusion.</p>
            </div>
        {/if}
      </div>
    </div>
  </div>
</div>
{include "foot.tpl"}
