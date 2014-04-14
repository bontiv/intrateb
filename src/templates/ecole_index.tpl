{include "head.tpl"}

<h1>Administration</h1>
<h3>Gestion des écoles</h3>


<ul class="nav nav-pills">
  <li class="active"><a href="#">Liste</a></li>
  <li><a href="{mkurl action="ecole" page="add"}" class="btn" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></li>
</ul>


<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Type</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
{foreach from=$ptable.rows item="line"}
    <tr>
      <td>{$line.ut_name}</td>
      <td>
        <div class="btn-group">
          <a href="{mkurl action="ecole" page="delete" ecole=$line.ut_id}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
          <a href="{mkurl action="ecole" page="edit" ecole=$line.ut_id}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
        </div>
      </td>
    </tr>
{/foreach}
  </tbody>
</table>
    

{include "foot.tpl"}