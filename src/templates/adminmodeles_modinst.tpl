{include "head.tpl"}


<h1>Administration</h1>
<ol class="breadcrumb">
  <li><a href="{mkurl action="admin_modeles"}">Admin Instances</a></li>
  <li><a href="{mkurl action="admin_modeles" page="modele" modele=$modele->getName()}">Modele {$modele->getName()}</a></li>
  <li class="active">Modification {$modele->getKey()}</li>
</ol>

  <h3>Modifier dans {$modele->getName()}</h3>
<p>A noter que cette page est destiné aux développeurs et aux utilisateurs avancés.</p>
<p>Ce modèle se trouve dans le fichier {$modele->getFile()}</p>

{if $result == "success"}
    <div class="alert alert-success"><p><strong>Succes :</strong> l'enregistrement a bien été modifié.</p></div>
{elseif $result == "error"}
    <div class="alert alert-danger"><p><strong>Erreur :</strong> une erreur a empeché la modification de l'enregistrement.</p></div>
{/if}

    <form role="form" method="POST" action="{mkurl action="admin_modeles" page="modinst" modele=$modele->getName() key=$modele->getKey()}">
{$edit}
        <input type="hidden" name="action" value="mod" />
        <input type="submit" value="Modifier" class="btn btn-default">
    </form>

{include "foot.tpl"}