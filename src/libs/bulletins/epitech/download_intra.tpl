login;spice;comment
{foreach $marks as $mark}{$mark.user->user_login};{$mark.spice};{capture "participation"}Participation à : {foreach $colums as $colum}{if isset($mark[$colum])}{$colum} ({$mark[$colum]}h){if not $mark@last}, {/if}{/if}{/foreach}{/capture}{$smarty.capture.participation|replace:";":","|truncate:254}
{/foreach}