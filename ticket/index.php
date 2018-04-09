<?php
	$page = 'ticket';
	$file = 'ticket.php';
	$idpg = 29;
	include '../cfg.php';
	include '../ini.php';
	if($lng == "ru") {
		include "../template_ru.php";
	} else {
		include "../template.php";
	}
?>