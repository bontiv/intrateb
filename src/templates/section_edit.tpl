{include "head.tpl"}

<h1>Section</h1>
<h2>{$section->section_name}</h2>    
<form action="{mkurl action="section" page="edit" section=$section->getKey()}" method="POST">
{$section->edit()}
<p><input type="submit" class="btn btn-default" name="postOK" value="Sauvegarder" /></p>
</form>

{include "foot.tpl"}