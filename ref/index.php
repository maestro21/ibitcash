<?php
	$page = 'ref';
	$file = 'ref.php';
	$idpg = 12;
	include '../cfg.php';
	include '../ini.php';
	if($lng == "ru") {
		include "../template_ru.php";
	} else {
		include "../template.php";
	}
?>