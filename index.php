<?php

ini_set('display_errors', 0);
error_reporting(E_ALL);
	require_once "cfg.php";
	require_once "ini.php";
if($lng == "ru") {
	require_once "template_ru.php";
} else {
	require_once "template.php";
}
if(DEV) { ?>
	<div style="position:fixed; color: darkred; border:1px darkred solid; padding: 10px; right:0; top: 0; background-color: yellow">DEV</div>
<?php } ?>
