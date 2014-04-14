{include "head.tpl"}

{if $succes}
    <div class="success alert-success">Insertion OK</div>
{/if}
{if $error}
    <div class="alert-danger danger">Insertion fail</div>
{/if}


<h1>Administration</h1>
<h2>Ecoles</h2>

<ul class="nav nav-pills">
  <li><a href="{mkurl action="ecole"}">Liste</a></li>
  <li class="active"><a href="{mkurl action="ecole" page="add"}" class="btn" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<form method="POST" action="{mkurl action="ecole" page="add"}">
    <p>
        Nom de l'école :<br/>
        <input type="text" name="ut_name" />
    </p>
    <p>
        <input type="submit" name="Ajouter" class="btn btn-default" />
    </p>
</form>
{include "foot.tpl"}