{include "head.tpl"}
<button data-toggle="collapse" data-target="#emails" class="btn">Afficher/cacher la liste des mails</button>
<div id='emails' class='collapse'>
    <h2>Mail envoyé à:</h2>
    {foreach from=$mails item="m"}
        {$m};
    {/foreach}
</div>
{include "mail_send.tpl"}
<div>
    <a id="back" name="back" class="btn btn-success" href="javascript:history.back()">Back</a>
</div>
{include "foot.tpl"}
