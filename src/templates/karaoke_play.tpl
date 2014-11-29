{include "head.tpl"}
<h1>La notation</h1>
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
{include "foot.tpl"}
