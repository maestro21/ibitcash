<?php
	$page = 'calc';
	$file = 'calc.php';
	$idpg = 30;
	include '../cfg.php';
	include '../ini.php';
	if($lng == "ru") {
		include "../template_ru.php";
	} else {
		include "../template.php";
	}
?>