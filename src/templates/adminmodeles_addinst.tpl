{include "head.tpl"}

<h1>Administration</h1>
<ol class="breadcrumb">
  <li><a href="{mkurl action="admin_modeles"}">Admin Instances</a></li>
  <li><a href="{mkurl action="admin_modeles" page="modele" modele=$modele->getName()}">Modele {$modele->getName()}</a></li>
  <li class="active">Ajout</li>
</ol>
<h3>Ajout dans {$modele->getName()}</h3>
<p>A noter que cette page est destiné aux développeurs et aux utilisateurs avancés.</p>
<p>Ce modèle se trouve dans le fichier {$modele->getFile()}</p>

{if $result == "success"}
    <div class="alert alert-success"><p><strong>Succes :</strong> l'enregistrement a bien été ajouté.</p></div>
{elseif $result == "error"}
    <div class="alert alert-danger"><p><strong>Erreur :</strong> une erreur a empeché l'enregistrement.</p></div>
{/if}

    <form role="form" method="POST" action="{mkurl action="admin_modeles" page="addinst" modele=$modele->getName()}">
{$edit}
        <input type="hidden" name="action" value="add" />
        <input type="submit" value="Ajouter" class="btn btn-default">
    </form>

{include "foot.tpl"}