{include "head.tpl"}

<h1>Gestion de la Toyunda</h1>

<ol class="breadcrumb">
  <li>Toyunda</li>
  <li><a href="{mkurl action="toyunda" page="admtrans"}">Gestion des transitions</a></li>
  <li class="active"><a href="{mkurl action="toyunda" page="admaddtrans"}">Ajout d'une transition</a></li>
</ol>

{include "toyunda_menu.tpl"}

<form method="POST" action="{mkurl action="toyunda" page="admaddtrans"}" class="form-horizontal">
  <fieldset>
    {$form}

    <div class="form-group">
      <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}
