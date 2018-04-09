<?php
	$page = 'activation';
	$file = 'activation.php';
	$idpg = 516;
	include '../cfg.php';
	include '../ini.php';
	if($lng == "ru") {
		include "../template_ru.php";
	} else {
		include "../template.php";
	}
?>