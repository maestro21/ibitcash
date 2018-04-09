<?php
	$page = 'enter';
	$file = 'enter.php';
	$idpg = 6;
	include '../cfg.php';
	include '../ini.php';
	if($lng == "ru") {
		include "../template_ru.php";
	} else {
		include "../template.php";
	}
?>