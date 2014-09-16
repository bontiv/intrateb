{include file="head.tpl"}

<h2>Validation des cartes</h2>
{if $card}
    <form class="form-horizontal" action="{mkurl action="cards" page="validate"}" method="POST">

      <!-- List mandate -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="mandate">Carte ID</label>
        <div class="col-md-5">
          {$card->card_id}
          <input type="hidden" name="card" value="{$card->card_id}" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label" for="mandate">Carte de membre</label>
        <div class="col-md-5">
          <img src="{mkurl action="cards" page="view" id=$card->card_id}" style="border: solid 1px black" width="400px" alt="Carte illisible" />
        </div>
      </div>


      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-8">

          <input type="submit" class="btn btn-success" name="validate" value="Valider" />
          <input type="submit" class="btn btn-danger" name="cancel" value="Refuser" />
        </div>
      </div>
    </form>
{else}
    <p>Il n'y a aucune carte à valider.</p>
{/if}
{include file="foot.tpl"}