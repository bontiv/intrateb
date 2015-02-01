{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="admin_note" page="mandate"}">Mandats</a></li>
  <li class="active">Ajout de mandat</li>
</ol>


<form method="POST" class="form-horizontal">

  <fieldset>
    <legend>Création de mandat</legend>

    {$mandat->edit()}

  </fieldset>
  <div class="form-group">
    <label class="col-md-4 control-label" for="edit"></label>
    <div class="col-md-8">
      <button id="edit" name="edit" class="btn btn-success">Valider</button>
    </div>
  </div>
</form>




{include "foot.tpl"}
