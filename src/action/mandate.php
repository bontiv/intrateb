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