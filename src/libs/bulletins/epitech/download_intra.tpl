login;spice;comment
{foreach $marks as $mark}{$mark.user->user_login};{$mark.spice};"Participation aux activités suivantes : {foreach $colums as $colum}{if isset($mark[$colum])}{$colum} ({$mark[$colum]}h){if not $mark@last}, {/if}{/if}{/foreach}"

{/foreach}