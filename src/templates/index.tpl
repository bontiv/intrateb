{include "head.tpl"}


<div class="container-fluid">

  {if $nbEvents eq 0 and (!isset($smarty.session.user) or !$smarty.session.user) and $nbFtp eq 0}
      <div>
        <div class="rowpanel panel-default">
          <div class="panel-heading">
            <h4>Bienvenue chez </h4>
          </div>
          <div class="panel-body">
            <img style="width: 100%;" src="images/logotxt.png">
          </div>
        </div>
      </div>
  {/if}
  {if !$completed}
      <div class="col-md-6">
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h4>Vote compte LATEB</h4>
          </div>
          <div class="panel-body">
            <p>Votre profil n'est pas complet ! Completez le dès à présent.</p>
            <p><a class="btn btn-primary" href="{mkurl action="index" page="wizard"}">Completer le profil</a>
          </div>
        </div>
      </div>
  {elseif isset($smarty.session.user) and $smarty.session.user}
      <div class="col-md-6">
        <div class="panel {if $isMember and $nbCards gt 0}panel-default{elseif $isMember}panel-warning{else}panel-danger{/if}">
          <div class="panel-heading">
            <h4>Adhésion LATEB</h4>
          </div>
          <div class="panel-body">
            {if $isMember}
                {if $nbCards eq 0}
                    <p>Vous n'avez pas encore fait votre carte de membre.</p>
                    <p><a class="btn btn-primary" href="{mkurl action="index" page="profile"}">Créer votre carte</a></p>
                {else}
                    <p>Vous êtes bien membre de LATEB. Votre dossier est à jour.</p>
                {/if}
            {else}
                <p>Vous n'êtes pas membre. Pour devenir membre, veuillez payer votre cotisation auprès d'un membre du bureau.</p>
            {/if}
          </div>
        </div>
      </div>
  {/if}

  {if $nbEvents gt 0}
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Evenements</h4>
          </div>
          <div class="panel-body">
            <ul style="list-style-type: square;">
              <li><a href="{mkurl action="event"}">Liste des événements</a></li>
            </ul>
            {if $nbEvents eq 0}
                <p>Il n'y a aucun événement à venir.</p>
            {else}
                <p>Il n'y a {$nbEvents} événement{if $nbEvents gt 1}s{/if} à venir.</p>
            {/if}
          </div>
        </div>
      </div>
  {/if}


</div>

{include "foot.tpl"}