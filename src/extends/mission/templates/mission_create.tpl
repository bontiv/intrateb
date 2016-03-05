{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="mission" page="index"}">Missions</a></li>
  <li class="active">Creation</li>
</ol>

<h1>Missions</h1>
<h3>Creation</h3>

<form class="form-horizontal" method="POST" action="{mkurl action="mission" page="create"}">
  <fieldset>
    {$create_form}
  </fieldset>

  <fieldset>
    <div class="form-group">
      <div class="col-md-offset-4 col-md-4">
        <input type="submit" name="submit" value="Créer" class="btn btn-success" />
      </div>
    </div>
  </fieldset>
</form>

{include "foot.tpl"}
