{include "head.tpl"}

<h2>Bulletin {$bulletin->period_label}</h2>

<form method="POST">
  <table class="table">
    <thead>
      <tr>
        <th>Utilisateur</th>
          {foreach $colums as $colum}
          <th>{$colum}</th>
          {/foreach}
      </tr>
    </thead>
    <tbody>
      {foreach $marks as $mark}
          <tr>
            <td>{$mark.user->user_name}</td>
            {foreach $colums as $colum}
                {if isset($mark[$colum])}
                    <td><input class="input-md form-control" name="{$mark.user->user_id};{$colum}" value="{$mark[$colum]}" /></td>
                    {else}
                    <td><span class="text-muted">Non participé</span></td>
                {/if}
            {/foreach}
          </tr>
      {/foreach}
    </tbody>
  </table>

  <p>
    <input type="submit" name="send" class="btn btn-primary" />
  </p>
</form>

{include "foot.tpl"}
