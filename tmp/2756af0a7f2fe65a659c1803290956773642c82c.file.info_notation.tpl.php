<?php /* Smarty version Smarty-3.1.13, created on 2013-05-05 12:35:22
         compiled from "/var/www/EpiceNote/templates/info_notation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:36897125951859f5a807803-78544075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2756af0a7f2fe65a659c1803290956773642c82c' => 
    array (
      0 => '/var/www/EpiceNote/templates/info_notation.tpl',
      1 => 1367750119,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36897125951859f5a807803-78544075',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51859f5a82ae00_11797584',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51859f5a82ae00_11797584')) {function content_51859f5a82ae00_11797584($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>