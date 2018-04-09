<?php
	$page = 'his_all';
	$file = 'his_all.php';
	$idpg = 59;
	include '../cfg.php';
	include '../ini.php';
	if($lng == "ru") {
		include "../template_ru.php";
	} else {
		include "../template.php";
	}
?>