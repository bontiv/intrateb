<?php /* Smarty version Smarty-3.1.16, created on 2013-12-22 17:31:09
         compiled from "/var/www/nep2/htdocs/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:137240194152b713612b2de8-38999528%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38524e8dc7c1562ebd4e2a9854d66e7ccc89dc88' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/index.tpl',
      1 => 1387729848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137240194152b713612b2de8-38999528',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b713612c8f70_44203230',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b713612c8f70_44203230')) {function content_52b713612c8f70_44203230($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<h1>La notation</h1>

<h2>Qu'est ce que ce site ?</h2>
<p>Ce site est le site qui va vous permettre de vous inscrire en tant que staff
  sur les événements de l'association.</p>
<p>En plus de gérer les inscription, ce site va aussi gérer votre
note EPICE / ENAC. Il va aider les responsables de l'association à vous
attribuer une note.</p>
<p>Ici vous pourrez aussi voir l'évolution de votre note au cours de l'année.</p>

<h2>Comment la notation fonctionne ?</h2>
<p>Sur ce site vous avez deux notes attribués :</p>
<ul>
  <li>La note d'investissement <em>noté NI sur ce site</em></li>
  <li>La note de soin du travail <em>noté NST sur ce site</em></li>
</ul>
<p>La note d'investissement est en pourcentage. Elle peut dépasser 100% !
Cette note est le multiplicateur de la note de soin du travail. La NI évolue
en fonction du nombre d'événements sur lesquels vous participez dans
l'association.</p>
<p>La note de soin du travail est noté sur 21. Une NST vous est attribué à
la fin de chaque événement par le responsable qui s'occupait de vous. Nous
faisons ensuite la moyenne.</p>

<h2>Comment les notes sont attribués ?</h2>
<p>Quand un événement est ouvert par les responsables de l'association,
il est alors visible dans les événements de ce site.</p>
<p>Certains événements sont considérés comme importants pour votre association.
L'inscription de ces événements est alors requise et si vous ne vous inscrivez
pas, vous ferez baisser votre NI. D'autres activités sont considéré facultatives,
elles peuvent alors augmenter votre NI, mais sans le pénaliser.</p>
<p>A la fin de chaque activité, le responsable de votre activité va vous
  attribuer sur ce site une note en fonction du soin que vous avez donné au
travail que vous avez effectué. Si vous avez passé toute la durée de l'activité
à regarder les autres travailler, vous aurez peu de change d'avoir une bonne
note.</p>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
