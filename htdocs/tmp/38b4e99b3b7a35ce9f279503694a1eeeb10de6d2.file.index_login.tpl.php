<?php /* Smarty version Smarty-3.1.16, created on 2013-12-22 17:44:32
         compiled from "/var/www/nep2/htdocs/templates/index_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39858586152b7157c880766-47860715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38b4e99b3b7a35ce9f279503694a1eeeb10de6d2' => 
    array (
      0 => '/var/www/nep2/htdocs/templates/index_login.tpl',
      1 => 1387730669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39858586152b7157c880766-47860715',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b7157c8e5f37_81420147',
  'variables' => 
  array (
    'random' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b7157c8e5f37_81420147')) {function content_52b7157c8e5f37_81420147($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	
	<script type="text/javascript" >
	  function crytogun()
	  {
	  var chain = My_Crypt(login.login.value + ":" + login.password.value);
	  login.password.value = My_Crypt(chain + "<?php echo $_smarty_tpl->tpl_vars['random']->value;?>
");
	  }
	</script>
	<script type="text/javascript" src="crypt.js" >alert("Impossible de lancer l'algo de cryptage")</script>
	<div class="container" style="position:absolute; left:35%; top:30%; max-width: 300px;
				      padding: 19px 29px 29px;
				      margin: 0 auto 20px;
				      background-color: #fff;
				      border: 1px solid #e5e5e5;
				      -webkit-border-radius: 5px;
				      -moz-border-radius: 5px;
				      border-radius: 5px;
				      -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				      -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				      box-shadow: 0 1px 2px rgba(0,0,0,.05);">
	  <?php if ($_smarty_tpl->tpl_vars['msg']->value) {?>
	  
	  
	  <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Oups!</strong> <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

      </div>
	  <?php }?>
	  <form id="login" name="login" class="form-signin" onsubmit="return crytogun()" method="POST">
	    <h2 class="form-signin-heading">Identifiez-vous</h2>
	    <table border="0" style="">
	      <tbody><tr>
		  <td>Utilisateur : </td>
		  <td><input class="input-block-level" type="text" size="10" name="login" /></td>
		</tr>
		<tr>
		  <td>Mot de passe : </td>
		  <td><input class="input-block-level" type="password" size="10" name="password" /></td>
		</tr>
	    </tbody></table>
	    <button style="float:right" class="btn btn-large btn-primary" type="submit" value="OK">Connexion</button>
	  </form>
    </div>
<?php echo $_smarty_tpl->getSubTemplate ("foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
