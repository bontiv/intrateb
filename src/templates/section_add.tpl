{include "head.tpl"}

{if $succes}
    <div class="success alert-success">Insertion OK</div>
{/if}
{if $error}
    <div class="alert-danger danger">Insertion fail {$error[2]}</div>
{/if}


<h1>Administration</h1>
<h2>Sections</h2>

<ul class="nav nav-pills">
  <li><a href="{mkurl action="section"}">Liste</a></li>
  <li class="active"><a href="{mkurl action="section" page="add"}" class="btn" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<form method="POST" action="{mkurl action="section" page="add"}">
    <p>
        Nom de la section :<br/>
        <input type="text" name="section_name" />
    </p>
    <p>
        Type de section :<br/>
        <select name="section_type">
            <option value="PRIMARY">Section asso</option>
            <option value="SECONDARY">Sous-section</option>
        </select>
    </p>
    <p>
        <input type="submit" name="Ajouter" class="btn btn-default" />
    </p>
</form>
{include "foot.tpl"}