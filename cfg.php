<?php
define(DEV, FALSE);

if(DEV) {
	define('DOMAIN', 'ibitcash.test');	
	define('BASE_PATH', 'http://' . DOMAIN . '/');
} else {
	define('DOMAIN', 'ibit.cash');
	define('BASE_PATH', 'https://' . DOMAIN . '/');
}
//Error_Reporting(0);
/*
	$hostname				= "localhost";					// Хост
	$mysql_login			= "oblmi198_1";						// Логин к БД
	$mysql_password			= "0991846376";						// Пароль к БД
	$database				= "oblmi198_1";						// База данных
	$num					= 10;							// Кол-во выводов на страницу
	$cfgURL					= "https://ibit.cash.com";		// URL ресурса
	$chmod					= "755";						// Права папкам на запись
*/
	$hostname				= "localhost";					// Хост
	$mysql_login			= "root";						// Логин к БД
	$mysql_password			= "";						// Пароль к БД
	$database				= "ibitcash";						// База данных
	$num					= 10;							// Кол-во выводов на страницу
	$cfgURL					= "https://ibitcash.dev";		// URL ресурса
	$chmod					= "755";						// Права папкам на запись
// Данные лицензии. Следующие переменные после установки скрипта НЕ МЕНЯТЬ!


  $licID				= "1";										// ID лицензионной копии
  $key					= "Z201OlC1985";					// Лицензионный ключ
  $mdhash				= "173fcb8d67584aa5bc3ced28e004b938";		// MD5 hash

// Соединение с БД
if (!($conn = mysql_connect($hostname, $mysql_login , $mysql_password))) {
	include "includes/errors/db.php";
	exit();
} else {
	if (!(mysql_select_db($database, $conn))) {
		include "includes/errors/db.php";
		exit();
	}

	}
// Конец соединения с БД


mysql_query("SET NAMES 'utf8'");

set_magic_quotes_runtime(0);
@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
$safe_mode = @ini_get('safe_mode');
$version = "1.24";

if(version_compare(phpversion(), '4.1.0') == -1) {
 $_POST   = &$HTTP_POST_VARS;
 $_GET    = &$HTTP_GET_VARS;
 $_SERVER = &$HTTP_SERVER_VARS;
}

if (@get_magic_quotes_gpc()) {
	foreach ($_POST as $k=>$v) {
		$_POST[$k] = stripslashes($v);
	}
	foreach ($_SERVER as $k=>$v) {
		$_SERVER[$k] = stripslashes($v);
	}
}

define('ACCESS', true);

include "includes/key.php";
include "includes/percent.php";
?>