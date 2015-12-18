{include "head.tpl"}

<form class="form-horizontal" method="POST" action="{mkurl action="ml" page="send"}" id="sendform">
  <fieldset>

    <!-- Form Name -->
    <legend>Envoi de mail à la mailling list</legend>

    <!-- Title input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="pwd1">Titre</label>
      <div class="col-md-5">
        <input id="title" name="title" placeholder="Title" class="form-control input-md" required="" type="text">

      </div>
    </div>

    <!-- Message input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="pwd2">Message</label>
      <div class="col-md-5">
        <textarea id="content" name="content" class="form-control input-md" required="" form="sendform">
        </textarea>
      </div>
    </div>

    <!-- Button (Double) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="send"></label>
      <div class="col-md-8">
        <button id="send" name="send" class="btn btn-success">Valider</button>
      </div>
    </div>

  </fieldset>
</form>


{include "foot.tpl"}
