{include "head.tpl"}
<h1>Lecture du Karaoke</h1>
<hr/>
<table class="table" id="karaoke-list">
    <thead>
        <tr>
            <th>Langue</th>
            <th>Titre</th>
            <th>Info1</th>
            <th>Info2</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$karaoke item="item"}
            <tr>
                <td>{$item[1]}</td>
                <td>{$item[2]}</td>
                <td>{$item[3]}</td>
                <td>{$item[4]}</td>
                <td>
                    {if $item.status == 0}<span class="label label-info">Non passé</span>{/if}
                    {if $item.status == 1}<span class="label label-primary">Diffusé</span>{/if}
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
    <script type="text/javascript">
        var page = '{mkurl action="karaoke" page="play"}';
        var page = 'http://localhost:8080/epicenote/htdocs/index.php?action=karaoke&page=play';
{literal}
        $(function(){
            setInterval(function(){
                $.get(
                    page,
                    function(data){
                        $('#karaoke-list').html($('#karaoke-list', data).html());
                    }
                );
            },5000);
        });
    </script>
{/literal}
{include "foot.tpl"}
