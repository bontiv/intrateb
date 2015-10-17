{include "head.tpl"}

{include "event_staff_head.tpl"}

<p>Vous avez besoin de <strong>{$section.es_needed}</strong> staffs.</p>

{acl action="event" page="staff_add" section=$section.section_id event=$event.event_id}
<form class="form-inline" method="POST" action="{mkurl action="event" page="staff_add" section=$section.section_id event=$event.event_id}">
  <div class="row">
    <div class="col-lg-6">
      <div class="input-group">
        <span class="input-group-addon">Ajout</span>
        <input type="text" class="form-control" name="login" id="staffAdd" placeholder="Pseudo">
        <span class="input-group-btn">
          <button class="btn btn-primary" type="submit"><div class="glyphicon glyphicon-plus-sign"></div></button>
        </span>
      </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
  </div><!-- /.row -->
</form>
<script type="text/javascript">
    var srcUrl = "{mkurl action="event" page="staff_add" section=$section.section_id event=$event.event_id format="json"}";
  {literal}
      $(function () {

          var split = function (val) {
              return val.split(/,\s*/);
          }
          var extractLast = function (term) {
              return split(term).pop();
          }

          //Use tabulations
          $('#staffAdd').bind("keydown", function (event) {
              if (event.keyCode === $.ui.keyCode.TAB &&
                      $(this).autocomplete("instance").menu.active) {
                  event.preventDefault();
              }
          });

          //Auto complete
          $('#staffAdd').autocomplete({
              source: function (request, response) {
                  var answer = new Array();
                  $.getJSON(srcUrl, {
                      term: extractLast(request.term)
                  }, function (data) {
                      var _len = data.length;
                      for (var _i = 0; _i < _len; _i++) {
                          var line = data[_i];
                          answer.push({
                              value: line.user_name,
                              label: line.user_firstname
                                      + " " + line.user_lastname
                                      + " (" + line.user_name + ")"
                          });
                      }
                      response(answer);
                  });
              },
              search: function () {
                  // custom minLength
                  var term = extractLast(this.value);
                  if (term.length < 2) {
                      return false;
                  }
              },
              focus: function () {
                  // prevent value inserted on focus
                  return false;
              },
              select: function (event, ui) {
                  var terms = split(this.value);
                  // remove the current input
                  terms.pop();
                  // add the selected item
                  terms.push(ui.item.value);
                  // add placeholder to get the comma-and-space at the end
                  terms.push("");
                  this.value = terms.join(", ");
                  return false;
              }
          });
      });
  {/literal}
</script>
{/acl}

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Pseudo</th>
      <th>Type</th>
      <th>Status</th>
      <th>Login</th>
      <th>Email</th>
      <th>Téléphone</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$users item="line"}
        <tr>
          <td><a href="{mkurl action="user" page="view" user=$line.user_id}">{$line.user_name|escape}</a></td>
          <td>{if $line.us_type=="user"}<span class="label label-success">Staff</span>{elseif $line.us_type=="manager"}<span class="label label-primary">Manager</span>{else}<span class="label label-default">Guest</span>{/if}</td>
          <td>{if $line.est_status=="OK"}<span class="label label-success">Accepté</span>{elseif $line.est_status=="NO"}<span class="label label-danger">Refusé</span>{else}<span class="label label-default">Candidat</span>{/if}</td>
          <td>{$line.user_login}</td>
          <td><a href="mailto:{$line.user_email}">{$line.user_email}</a></td>
          <td><a href="tel:{$line.user_phone}">{$line.user_phone}</a></td>
          <td>
            <div class="btn-group">
              {if $line.est_status!="NO"}
                  <a title="Refuser cette personne" href="{mkurl action="event" page="staff_reject" user=$line.user_id section=$section.section_id event=$event.event_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
                  {/if}
                  {if $line.est_status!="OK"}
                  <a title="Accepter cette personne" href="{mkurl action="event" page="staff_accept" user=$line.user_id section=$section.section_id event=$event.event_id}" class="btn btn-success"><span class="glyphicon-thumbs-up glyphicon"></span></a>
                  {/if}
            </div>
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>
{include "foot.tpl"}