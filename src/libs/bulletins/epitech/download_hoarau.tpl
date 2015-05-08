login{foreach $colums as $colum};{$colum}{/foreach}

{foreach $marks as $mark}{$mark.user->user_login}{foreach $colums as $colum};{if isset($mark[$colum])}{$mark[$colum]}{else}0{/if}{/foreach}

{/foreach}