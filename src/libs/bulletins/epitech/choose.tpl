{include "head.tpl"}
<h2>Validation du bulletin</h2>

<p>Pour Epitech, vous devez choisir une période disponible pour l'attribution
  des points EPICES. Dans le cadre de ce bulletin, il vous faut au moins
  <strong>{$sumSpices}</strong> points EPICES.</p>

{if $attrib->total == 0}
    <div class="alert alert-danger">
      <p>Aucune période disponible pour l'attribution. Veuillez contacter la pédagogie.</p>
    </div>
{else}
    <form action="{mkurl action="admin_note" page="validbulletin" id=$smarty.get.id}" method="POST">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>{* Checkbox *}</th>
            <th>Titre</th>
            <th>Propriétaire</th>
            <th>Donateur</th>
            <th>Désactivé</th>
            <th>Confirmé</th>
            <th>Epices distribuées</th>
            <th>Maximum</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Commentaire</th>
          </tr>
        </thead>
        <tbody>
          {foreach $attrib->attribution as $line}
              <tr>
                <td><input name="period" value="{$line->id}" id="period_{$line->id}" type="radio" /></td>
                <td><label for="period_{$line->id}">{$line->title}</label></td>
                <td>{$line->owner}</td>
                <td>{$line->giver}</td>
                <td>
                  {if $line->disabled == "false"}
                      <div class="label label-success">non</div>
                  {else}
                      <div class="label label-warning">oui</div>
                  {/if}
                </td>
                <td>
                  {if $line->confirmation == "true"}
                      <div class="label label-success">oui</div>
                  {else}
                      <div class="label label-warning">non</div>
                  {/if}
                </td>
                <td>{$line->consumed} / {$line->quantity}</td>
                <td>{$line->max_attr}</td>
                <td>{$line->date_begin|date_format}</td>
                <td>{$line->date_end|date_format}</td>
                <td>{$line->comment}</td>
              </tr>
          {/foreach}
        </tbody>
      </table>
      <p><button type="submit" class="btn btn-primary">Envoyer</button></p>
    </form>
{/if}
{include "foot.tpl"}