{include "head.tpl"}

{* Lib pour le Dock *}
<script type="text/javascript" src="js/dock.js"></script>

<div class="dock-container hidden-xs">
  <div class="dock">
    <ul>
      {acl action="toyunda"}
      <li><span>Karaoke</span><a href="{mkurl action="toyunda"}"><img src="images/dock/karaoke.png"/></a></li>
          {/acl}
          {acl action="tcg"}
      <li><span>TCG</span><a href="http://palm.com"><img src="images/dock/tcg.png"/></a></li>
          {/acl}
          {acl action="event"}
      <li><span>Events</span><a href="{mkurl action="event"}"><img src="images/dock/events.png"/></a></li>
          {/acl}
          {if $_user}
        <li><span>Association</span><a href="{mkurl action="index" page="profile"}"><img src="images/dock/tools.png"/></a></li>
          {/if}
    </ul>
    <div class="base"></div>
  </div>
</div>

<ul class="nav nav-pills" role="pilllist">
  <li role="presentation" class="active"><a role="pill" data-toggle="pill" aria-controls="dashboard" href="#dashboard">Accueil</a></li>
  <li role="presentation"><a role="pill" data-toggle="pill" aria-controls="markfaq" href="#markfaq">FAQ Notation</a></li>
</ul>

<br />

<div class="pill-content">

  <div id="dashboard" role="pillpanel" class="pill-pane active in fade">
    <div class="row">

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Karaoke</h4>
          </div>
          <div class="panel-body">
            <ul style="list-style-type: square;">
              <li><a href="{mkurl action="toyunda"}">Liste en cours</a></li>
              <li><a href="{mkurl action="toyunda" page="todo"}">Participer aux times</a></li>
              <li><a href="{mkurl action="toyunda" page="add"}">Proposer un titre</a></li>
              <li><a href="{mkurl action="karaoke" page="webplay"}">Tester Toyunda web Player</a></li>
            </ul>
          </div>
        </div>
      </div>

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

      {if isset($smarty.session.user) and $smarty.session.user}
          <div class="col-md-6">
            <div class="panel {if $isMember and $nbCards gt 0}panel-default{elseif $isMember}panel-warning{else}panel-danger{/if}">
              <div class="panel-heading">
                <h4>Adhésion EPITANIME</h4>
              </div>
              <div class="panel-body">
                <ul style="list-style-type: square;">
                  <li><a href="{mkurl action="index" page="profile"}">Gestion du compte</a></li>
                </ul>
                {if $isMember}
                    {if $nbCards eq 0}
                        <p>Vous n'avez pas encore fait votre carte de membre.</p>
                    {else}
                        <p>Vous êtes bien membre d'Epitanime. Votre dossier est à jour.</p>
                    {/if}
                {else}
                    <p>Vous n'êtes pas membre.</p>
                {/if}
              </div>
            </div>
          </div>
      {/if}

      {if $nbFtp gt 0}
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4>Gestion FTP</h4>
              </div>
              <div class="panel-body">
                <ul style="list-style-type: square;">
                  <li><a href="{mkurl action="ftp"}">Voir les comptes FTP</a></li>
                </ul>
                <p>Vous possédez {$nbFtp} compte{if $nbFtp gt 1}s{/if} FTP{if $nbFtp gt 1}s{/if}.</p>
              </div>
            </div>
          </div>
      {/if}

    </div>
  </div>

  <div id="markfaq" role="pillpanel" class="pill-pane fade">

    <h1>La notation</h1>
    <hr/>
    <h2>Qu'est ce que ce site ?</h2>
    <p>Ce site est le site qui va vous permettre de vous inscrire en tant que staff
      sur les événements de l'association.</p>
    <p>En plus de gérer les inscription, ce site va aussi gérer votre
      note EPICE / ENAC. Il va aider les responsables de l'association à vous
      attribuer une note.</p>
    <p>Ici vous pourrez aussi voir l'évolution de votre note au cours de l'année.</p>

    <h2>Comment la notation fonctionne ?</h2>
    <p>Sur ce site vous avez deux notes attribués :</p>
    <ul>
      <li>La note d'investissement <em>noté <b>NI</b> sur ce site</em></li>
      <li>La note de soin du travail <em>noté <b>NST</b> sur ce site</em></li>
    </ul>
    <p>La note d'investissement est en pourcentage. Elle peut dépasser 100% !
      Cette note est le multiplicateur de la note de soin du travail. La NI évolue
      en fonction du nombre d'événements sur lesquels vous participez dans
      l'association.</p>
    <p>La note de soin du travail est noté sur 21. Une NST vous est attribué à
      la fin de chaque événement par le responsable qui s'occupait de vous. Nous
      faisons ensuite la moyenne.</p>

    <h2>Comment les notes sont attribués ?</h2>
    <p>Quand un événement est ouvert par les responsables de l'association,
      il est alors visible dans les événements de ce site.</p>
    <p>Certains événements sont considérés comme importants pour votre association.
      L'inscription de ces événements est alors requise et si vous ne vous inscrivez
      pas, vous ferez baisser votre NI. D'autres activités sont considéré facultatives,
      elles peuvent alors augmenter votre NI, mais sans le pénaliser.</p>
    <p>A la fin de chaque activité, le responsable de votre activité va vous
      attribuer sur ce site une note en fonction du soin que vous avez donné au
      travail que vous avez effectué. Si vous avez passé toute la durée de l'activité
      à regarder les autres travailler, vous aurez peu de change d'avoir une bonne
      note.</p>
  </div>
</div>

{include "foot.tpl"}