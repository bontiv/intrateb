<?php

function mandate_index() {
	global $tpl, $pdo;

	$table = mdle_need_desc('mandate');
	foreach ($table['fields'] as $key => $f) {
		if (!isset($f['label'])) {
			$f['label'] = $key;
		}

		$f['name'] = $key;
		$tpl->append('fields', $f);
	}
	$tpl->assign('mandate', $table);

	$sql = $pdo->query("SELECT * FROM `mandate`");
	$tpl->assign('insts', $sql->fetchAll());

	if ($tpl->getTemplateVars('result') == null) {
		$tpl->assign('result', '');
	}

	$tpl->display('mandate_index.tpl');
	quit();
}
 
function mandate_change() {
	global $tpl, $pdo;	
	
	$mandate_id = $_GET['mandate'];
	

	//Update mandte list: set true to this and set previous selected to FALSE
	$sql = $pdo->prepare("UPDATE mandate set mandate_select = 'FALSE' where mandate_select = 'TRUE'");
	$sql->execute();
	$sql = $pdo->prepare("UPDATE mandate set mandate_select = 'TRUE' where mandate_id = ?");
	$sql->bindValue(1, $mandate_id);
	$sql->execute();

	
	//Reset user which have no mandate to guest
	$sql = $pdo->prepare("update users as u set user_role = 'GUEST' where u.user_id not in (select um_user from user_mandate) and user_role != 'ADMINISTRATOR' and user_role != 'GUEST' order by u.user_id");
    $sql->execute();
    //Reset user which have not the good mandate to guest
	$sql = $pdo->prepare("UPDATE users as u join user_mandate as m on m.um_user = u.user_id set u.user_role = 'GUEST' where u.user_role != 'ADMINISTRATOR' and m.um_mandate != ?");
    $sql->bindValue(1, $mandate_id);
    $sql->execute();

	mandate_index();
}