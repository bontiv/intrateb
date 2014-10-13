{include "head.tpl"}

<h2>Validation des cotisations</h2>
<p>Veuillez choisir le mandat désiré et rentrer les numéros des fiches de membre.</p>
<form class="form-horizontal" action="{mkurl action="user" page="check"}" method="POST">

  <fieldset>


    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="mandate">Mandat</label>
      <div class="col-md-4">
        <select id="mandate" name="mandate" class="form-control">
          {foreach from=$mandates item="m"}
              <option {if isset($smarty.post.mandate)&&$smarty.post.mandate==$m.mandate_id}selected{/if} value="{$m.mandate_id}">{$m.mandate_label}</option>
          {/foreach}
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="idfiche">Fiche</label>
      <div class="col-md-4">
        <input id="idfiche" name="idfiche" placeholder="Numéro de fiche" class="form-control input-md" required="" type="text">
        <span class="help-block">Le numéro de la fiche figure en haut à droite ou le code barre en haut à gauche.</span>
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="send"></label>
      <div class="col-md-4">
        <button id="send" name="send" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>

  </fieldset>

</form>

{literal}
    <script type="text/javascript">
        $(function () {
            $('#idfiche').focus();
        });
    </script>
{/literal}

{include "foot.tpl"}
