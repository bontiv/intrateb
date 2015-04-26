{include "head.tpl"}
<h1>Lecture du Karaoke</h1>
<hr/>
<table class="table table-striped" id="karaoke-list">
  <thead>
    <tr>
      <th>Serie</th>
      <th>Titre</th>
      <th>Version</th>
      <th>Langue</th>
      <th>Statut</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$karaoke item="item"}
        <tr>
          <td>{$item[1]}</td>
          <td>{$item[3]}</td>
          <td>{$item[2]}</td>
          <td>
            {if $item[0] == "FR"}
                <img src="images/flags/png/fr.png" alt="{$item[0]}" />
            {elseif $item[0] == "JAP"}
                <img src="images/flags/png/jp.png" alt="{$item[0]}" />
            {elseif $item[0] == "ANG"}
                <img src="images/flags/png/us.png" alt="{$item[0]}" />
            {else}
                {$item[0]}
            {/if}
          </td>
          <td>
            {if $item.status == 0}<span class="label label-info">Non passé</span>{/if}
            {if $item.status == 1}<span class="label label-primary">Diffusé</span>{/if}
            {if $item.status == 2}<span class="label label-success">En cours</span>{/if}
          </td>
        </tr>
    {/foreach}
  </tbody>
</table>
<script type="text/javascript">
    var page = '{mkurl action="karaoke" page="play"}';
//        var page = 'http://localhost:8080/epicenote/htdocs/index.php?action=karaoke&page=play';
  {literal}
      $(function () {
          setInterval(function () {
              $.get(
                      page,
                      function (data) {
                          $('#karaoke-list').html($('#karaoke-list', data).html());
                      }
              );
          }, 5000);
      });
  </script>
{/literal}
{include "foot.tpl"}
