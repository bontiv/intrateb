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
<h2>{$user.user_name|escape}</h2>

<div class="row">

  <div class="col-lg-6">
    <p><strong>Nom : </strong>{$user.user_lastname|escape}<br/>
      <strong>Prenom : </strong>{$user.user_firstname|escape}<br/>
      <strong>ID : </strong>{$user.user_id}<br/>
      <strong>Ecole : </strong>{$user.ut_name}<br/>
      <strong>Promotion : </strong>{$user.user_promo}<br/>
      <strong>Login IONIS : </strong>{$user.user_login}<br/>
      <strong>email : </strong><a href="mailto:{$user.user_email|escape:'url'}">{$user.user_email|escape}</a><br/>
      <strong>Téléphone : </strong><a href="tel:{$user.user_phone|escape:'url'}">{$user.user_phone|escape}</a><br/>
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
    {elseif isset($intra->picture) and $intra->picture != ""}
        <img  width="150px" src="{$intra->picture}" />
    {elseif $bocal.school == "epita" and $bocal.promo >= 2015}
        <img  width="150px" src="http://static.acu.epita.fr/photos/{if $user.user_promo > 0}{$user.user_promo}{else}{$bocal.promo}{/if}/{$bocal.login}" />
    {else}
        <img width="150px" alt="Pas d'image" src="https://intra-bocal.epitech.eu/trombi/{$bocal.login}.jpg" />
    {/if}
  </div>
</div>

<div class="row">
  <div class="col-lg-12">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#sections" aria-controls="sections" role="tab" data-toggle="tab">Sections</a></li>
      <li role="presentation"><a href="#adhesions" aria-controls="adhesions" role="tab" data-toggle="tab">Adhésions</a></li>
      <li role="presentation"><a href="#school" aria-controls="school" role="tab" data-toggle="tab">Info école</a></li>
      <li role="presentation"><a href="#events" aria-controls="events" role="tab" data-toggle="tab">Events</a></li>
      <li role="presentation"><a href="#activities" aria-controls="activities" role="tab" data-toggle="tab">Activités</a></li>
      <li role="presentation"><a href="#cartes" aria-controls="cartes" role="tab" data-toggle="tab">Cartes</a></li>
      <li role="presentation"><a href="#mailling" aria-controls="mailling" role="tab" data-toggle="tab">Groupes de diffusion</a></li>
      <li role="presentation"><a href="#bankAccounts" aria-controls="bankAccounts" role="tab" data-toggle="tab">Comptes banquaire</a></li>
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
      <div role="tabpanel" class="tab-pane" id="school">
        {if not isset($bocal)}
            <div class="alert alert-info">
              <p>Cet utilisateur n'est pas membre de IONIS.</p>
            </div>
        {elseif not $bocal}
            <div class="alert alert-danger">
              <p>Login utilisateur incorrect.</p>
            </div>
        {else}
            <div class="col-md-4">
              <h4>Infos BOCAL</h4>
              <dl class="dl-horizontal">
                <dt>Login</dt>
                <dd>{$bocal.login}</dd>
                <dt>Nom</dt>
                <dd>{$bocal.lastname}</dd>
                <dt>Prenom</dt>
                <dd>{$bocal.firstname}</dd>
                <dt>UID</dt>
                <dd>{$bocal.uid}</dd>
                <dt>GID</dt>
                <dd>{$bocal.gid}</dd>
                <dt>Ecole<dt>
                <dd>{$bocal.school}</dd>
                <dt>Promotion</dt>
                <dd>{$bocal.promo}</dd>
              </dl>
            </div>
            <div class="col-md-4">
              <h4>Infos EPITECH</h4>
              <dl class="dl-horizontal">
                <dt>email</dt>
                <dd>
                  <a href="mailto:{$intra->internal_email}">{$intra->internal_email}</a>
                </dd>
                {if isset($intra->userinfo->email)}
                    <dt>PERSO: email</dt>
                    <dd><a href="mailto:{$intra->userinfo->email->value}">{$intra->userinfo->email->value}</a></dd>
                    {/if}
                    {if isset($intra->userinfo->address)}
                    <dt>PERSO: adresse</dt>
                    <dd>{$intra->userinfo->address->value}</dd>
                {/if}
                {if isset($intra->userinfo->city)}
                    <dt>PERSO: ville</dt>
                    <dd>{$intra->userinfo->city->value}</dd>
                {/if}
                {if isset($intra->userinfo->country)}
                    <dt>PERSO: pays</dt>
                    <dd>{$intra->userinfo->country->value}</dd>
                {/if}
                {if isset($intra->userinfo->telephone)}
                    <dt>PERSO: téléphone</dt>
                    <dd><a href="tel:{$intra->userinfo->telephone->value}">{$intra->userinfo->telephone->value}</a></dd>
                    {/if}
                    {if isset($intra->userinfo->website)}
                    <dt>PERSO: site web</dt>
                    <dd><a href="{$intra->userinfo->website->value}">{$intra->userinfo->website->value}</a></dd>
                    {/if}
                    {if isset($intra->userinfo->job)}
                    <dt>PERSO: métier</dt>
                    <dd>{$intra->userinfo->job->value}</dd>
                {/if}
                {if isset($intra->userinfo->poste)}
                    <dt>PERSO: poste</dt>
                    <dd>{$intra->userinfo->poste->value}</dd>
                {/if}
                {if isset($intra->userinfo->birthplace)}
                    <dt>PERSO: lieu de naissance</dt>
                    <dd>{$intra->userinfo->birthplace->value}</dd>
                {/if}
                {if isset($intra->userinfo->birthday)}
                    <dt>PERSO: date de naissance</dt>
                    <dd>{$intra->userinfo->birthday->value}</dd>
                {/if}
                {if isset($intra->userinfo->facebook)}
                    <dt>PERSO: facebook</dt>
                    <dd><a href="{$intra->userinfo->facebook->value}">{$intra->userinfo->facebook->value}</a></dd>
                    {/if}
                    {if isset($intra->userinfo->twitter)}
                    <dt>PERSO: twitter</dt>
                    <dd>
                      <a href="{$intra->userinfo->twitter->value}">{$intra->userinfo->twitter->value}</a>
                    </dd>
                {/if}
                {if isset($intra->userinfo->googleplus)}
                    <dt>PERSO: google plus</dt>
                    <dd><a href="{$intra->userinfo->googleplus->value}">{$intra->userinfo->googleplus->value}</a></dd>
                    {/if}
                <dt>Localisation</dt>
                <dd>{$intra->location}</dd>
                {if isset($intra->course_code)}
                    <dt>Parcours</dt>
                    <dd>{$intra->course_code}</dd>
                {/if}
                {if $intra->semester_code}
                    <dt>Semestre</dt>
                    <dd>{$intra->semester_code}</dd>
                {/if}
                {if isset($intra->studentyear)}
                    <dt>Année</dt>
                    <dd>{$intra->studentyear}<sup>{if $intra->studentyear == 1}er{else}e{/if}</sup></dd>
                {/if}
                {if isset($intra->credits)}
                    <dt>Credits</dt>
                    <dd>{$intra->credits}</dd>
                {/if}
                {if isset($intra->gpa)}
                    <dt>GPA</dt>
                    <dd>{foreach $intra->gpa as $gpa}{if not $gpa@first}, {/if}{$gpa->cycle} ({$gpa->gpa}){/foreach}</dd>
                {/if}
                <dt>Groupes</dt>
                <dd>{foreach $intra->groups as $grp}{if not $grp@first}, {/if}{$grp->name}{/foreach}</dd>
                {if isset($intra->spice)}
                    <dt>EPICES disponibles</dt>
                    <dd>{if $intra->spice->available_spice}{$intra->spice->available_spice}{else}0{/if}</dd>
                    <dt>EPICES utilsés</dt>
                    <dd>{if $intra->spice->consumed_spice}{$intra->spice->consumed_spice}{else}0{/if}</dd>
                {/if}

              </dl>
            </div>
            <div class="col-md-4">
              <h4>PHOTO</h4>
              {if isset($intra->picture) and $intra->picture != ""}
                  <img  width="150px" src="{$intra->picture}" />
              {elseif $bocal.school == "epita" and $bocal.promo >= 2015}
                  <img  width="150px" src="http://static.acu.epita.fr/photos/{if $user.user_promo > 0}{$user.user_promo}{else}{$bocal.promo}{/if}/{$bocal.login}" />
              {else}
                  <img width="150px" alt="Pas d'image" src="https://intra-bocal.epitech.eu/trombi/{$bocal.login}.jpg" />
              {/if}
            </div>
        {/if}
      </div>
      <div role="tabpanel" class="tab-pane" id="events">
        {if isset($events)}
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Evenement</th>
                  <th>Section</th>
                  <th>Statut</th>
                  <th>Debut</th>
                  <th>Fin</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>
                {foreach $events as $event}
                    <tr>
                      <td><a href="{mkurl action="event" page="view" event=$event.est_event}">{$event.event_name}</a></td>
                      <td><a href="{mkurl action="event" page="staff" event=$event.est_event section=$event.est_section}">{$event.section_name}</a></td>
                      <td>
                        {if $event.est_status=="OK"}
                            <div class="label label-success">Staff</div>
                        {elseif $event.est_status=="WAIT"}
                            <div class="label label-info">Candidat</div>
                        {elseif $event.est_status=="NO"}
                            <div class="label label-danger">Refusé</div>
                        {else}
                            {$event.est_status}
                        {/if}
                      </td>
                      <td>{$event.event_start}</td>
                      <td>{$event.event_end}</td>
                      <td>{$event.event_desc}</td>
                    </tr>
                {/foreach}
              </tbody>
            </table>
        {else}
            <div class="alert alert-info">
              <p>Cette personne n'a participé à aucun event.</p>
            </div>
        {/if}
      </div>
      <div role="tabpanel" class="tab-pane" id="activities">
        {if isset($activities)}
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Description</th>
                  <th>Valide</th>
                  <th>Durée</th>
                  <th>Date</th>
                  <th>Section</th>
                  <th>Event</th>
                  <th>Note</th>
                </tr>
              </thead>
              <tbody>
                {foreach $activities as $activity}
                    <tr>
                      <td>{$activity.part_title}</td>
                      <td>
                        {if $activity.part_status == "SUBMITTED"}
                            <div class="label label-info">En attente</div>
                        {elseif $activity.part_status == "ACCEPTED"}
                            <div class="label label-success">Validé</div>
                        {elseif $activity.part_status == "REFUSED"}
                            <div class="label label-danger">Refusé</div>
                        {else}
                            {$activity.part_status}
                        {/if}
                      </td>
                      <td>{$activity.part_duration}h</td>
                      <td>{$activity.part_attribution_date|date_format}</td>
                      <td><a href="{mkurl action="section" page="details" section=$activity.section_id}">{$activity.section_name}</a></td>
                      <td>{if $activity.part_event}<a href="{mkurl action="event" page="view" event=$activity.event_id}">{$activity.event_name}</a>{else}<div class="text-muted">N/A</div>{/if}</td>
                      <td>{$activity.mark_mark}</td>
                    </tr>
                {/foreach}
              </tbody>
            </table>
        {else}
            <div class="alert alert-info">
              <p>Cet utilisateur n'a réalisé aucune activité.</p>
            </div>
        {/if}
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
      <div role="tabpanel" class="tab-pane" id="bankAccounts">
        <p>Liste des comptes banquaires.</p>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Intitulé</th>
              <th>Type</th>
              <th>Identifiant</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {foreach $accounts as $acc}
                <tr>
                  <td>
                    {$acc.ua_identifier}
                    {if $acc.ua_id==$user.user_compta}
                        <div class="label label-primary">Par défaut</div>
                    {/if}
                  </td>
                  <td>{$acc.ua_type}</td>
                  <td>{$acc.ua_number}</td>
                  <td>
                    {if $acc.ua_id!=$user.user_compta}
                        <a class="btn btn-default" href="{mkurl action="user" page="setcompta" account=$acc.ua_id user=$user.user_id}">Mettre par défaut</a>
                    {/if}
                  </td>
                </tr>
            {/foreach}
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<div class="text-muted"><i><small>Page généré en {$time|string_format:"%.3f"}s.</small></i></div>

{include "foot.tpl"}
