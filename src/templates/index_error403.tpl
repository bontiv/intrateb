{include "head.tpl"}
<div class="panel panel-danger">
  <div class="panel-heading">
    <div class="panel-title">
      <h3>Erreur 403 (et oui petit problème d'accès)</h3>
    </div>
  </div>
  <div class="panel-body">
    <p>
      Oups ! Nous ne pouvons pas vous autoriser l'accès à cette page. Vous n'avez
      pas les droits nécessaires.
    </p>
    {if isset($smarty.session.user) && $smarty.session.user != false}
        <p>
          Il semblerait que vous soyez déjà connecté. Si vous n'êtes pas
          {$smarty.session.user.user_name|escape}, alors déconnectez-vous puis
          connectez-vous avec votre compte personnel pour tenter d'accéder
          à cette ressource.
        </p>
        <p>
          Si vous êtes bien {$smarty.session.user.user_name|escape}, alors vous
          n'avez pas le droit d'accéder à cette ressource. Vous pouvez
          tenter d'envoyer un email au bureau pour que vous droits
          d'accès soient redéfinis : <a href="mailto:bureau@epitanime.com?subject=Accès Intra&body=Pouvez-vous vérifier mes accès sur l'intra...">bureau@epitanime.com</a>.
        </p>
    {else}
        <p>
          Il semblerait que vous ne soyez pas connecté. La première
          chose à faire est de vous connecter.
        </p>
    {/if}
  </div>
</div>
{include "foot.tpl"}
