{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="config"}">Configurations</a></li>
  <li class="active">{$cfg.label}</li>
</ol>

<h1>Configuration</h1>


<h2>Edition des paramètres de {$cfg.label}</h2>

<form method="POST" action="{mkurl action="config" page="edit" scope=$cfg.name}">
  {$form}


  <!-- Button -->
  <div class="form-group">
    <div class="col-md-4">
      <button id="valider" name="valider" class="btn btn-primary">Valider</button>
    </div>
  </div>

</form>

{include "foot.tpl"}
