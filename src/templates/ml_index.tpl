{include "head.tpl"}

<button data-toggle="collapse" data-target="#emails" class="btn">Afficher/cacher la liste des mails</button>
<form class="form-horizontal" method="POST" action="{mkurl action="ml" page="send"}" id="sendform">
  <fieldset>

    <!-- Form Name -->
    <legend>Envoi de mail à la mailling list</legend>

    <!-- Title input-->
    <div class="form-group">
      <label class="col-md-1 control-label" for="pwd1">Groupes à envoyer</label>
      <div class="col-md-11">
          {foreach from=$group_list key=key item=i}
              <input type="checkbox" name="group[]" value="{$key}" {$i.checked}>{$i.value}</input>
          {/foreach}

      </div>
    </div>
    
    <div id='emails' class='collapse form-group'>
        <h2>Mail envoyé à:</h2>
        <textarea id="users" name="users" class="form-control input-md">{foreach from=$users item="u"}{if $u->ta_mail}{$u->ta_mail}{else}{$u->user_email}{/if};{/foreach}</textarea>
    </div>

    <!-- Title input-->
    <div class="form-group">
      <label class="col-md-1 control-label" for="pwd1">Titre</label>
      <div class="col-md-11">
        <input id="title" name="title" placeholder="Title" class="form-control input-md" required="" type="text">

      </div>
    </div>

    <!-- Message input-->
    <div class="form-group">
      <label class="col-md-1 control-label" for="pwd2">Message</label>
      <div class="col-md-11">
        <textarea id="content" name="content" class="form-control input-md" required="" form="sendform"></textarea>
        <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
        </script>
      </div>
    </div>

    <!-- Button (Double) -->
    <div class="form-group">
      <label class="col-md-1 control-label" for="send"></label>
      <div class="col-md-1">
        <button id="send" name="send" class="btn btn-success">Valider</button>
      </div>
      <div class="col-md-1">
        <button id="preview" name="preview" class="btn btn-success">Preview</button>
      </div>
    </div>

  </fieldset>
</form>

{include "foot.tpl"}
