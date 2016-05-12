{include "head.tpl"}
<ol class="breadcrumb">
  <li class=""><a href="{mkurl action="trip" page="index"}">Voyages</a></li>
  <li class="active">Nouveau</li>
</ol>

<h1>Nouveau Voyage</h1>

<form action="{mkurl action="trip" page="add"}" method="POST" class="form-horizontal">
  <fieldset>
    {$form}
  </fieldset>
  <fieldset>
    <div class="form-group">
      <div class="col-md-4 col-md-offset-4">
        <input class="btn btn-primary" value="Envoyer" type="submit" />
      </div>
    </div>
  </fieldset>
</form>

{include "foot.tpl"}