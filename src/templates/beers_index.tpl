{include "head.tpl"}

<div class="">
    <h1>Bières</h1>
    <h3>Constitution de la nouvelle liste de bières</h3>

    {* START BLOCK recherche *}
    <form class="form-inline" method="POST" action="{mkurl action="beer" page="index"}">
        <fieldset>
            <div class="form-group">
                <div class="col-md-8">
                    <input id="search" name="search" placeholder="Recherche" class="form-control input-md"  type="search">
                </div>
            </div>
        </fieldset>
    </form>
    {* END BLOCK *}

    <ul class="pager">
        {if $ptable.showPrev}
            <li><a href="{$ptable.prev}"><i class="glyphicon glyphicon-arrow-left"></i> Précédent</a></li>
        {/if}
        {if $ptable.showNext}
            <li><a href="{$ptable.next}">Suivant <i class="glyphicon glyphicon-arrow-right"></i></a></li>
        {/if}
    </ul>


    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Nom</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$ptable.rows item="line"}

        {/foreach}
        </tbody>
    </table>
</div>

<ul class="pager">
    {if $ptable.showPrev}
        <li><a href="{$ptable.prev}"><i class="glyphicon glyphicon-arrow-left"></i> Précédent</a></li>
    {/if}
    {if $ptable.showNext}
        <li><a href="{$ptable.next}">Suivant <i class="glyphicon glyphicon-arrow-right"></i></a></li>
    {/if}
</ul>

{include "foot.tpl"}