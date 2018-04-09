<?php
defined('ACCESS') or die();
session_start();
$login	= $_SESSION['login'];
$sid	=	htmlspecialchars(substr(session_id(),0,32), ENT_QUOTES);

function getip() {
	if(getenv("HTTP_CLIENT_IP")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} else {
		$ip = getenv("REMOTE_ADDR");
	}
	$ip = htmlspecialchars(substr($ip,0,15), ENT_QUOTES);
	return $ip;
}

$ref = intval($_GET['ref']);
if($ref) {
	setcookie("referal", $ref, time() + 2592000);
}

$referal = intval($_COOKIE['referal']);

function as_md5($key, $pass) {
	$pass = md5($key.md5("Z&".$key."x_V".htmlspecialchars($pass, ENT_QUOTES)));
	return $pass;
}

if (mysql_num_rows(mysql_query("SELECT * FROM `blacklist_ip` WHERE ip = '".getip()."' LIMIT 1"))) {
	include "includes/errors/banip.php";
	exit();
}

// Если сессии нет, проверяем cookies
if(!$login) {
	if($_COOKIE['adminstation1']) {
		$get_user = mysql_query("SELECT login, pass, mail FROM users WHERE id = ".intval($_COOKIE['adminstation1'])." LIMIT 1");
		$row = mysql_fetch_array($get_user);
			$login	= $row['login'];
			$pass	= $row['pass'];
			$mail	= $row['mail'];
			$user_pass = as_md5($key, $pass.$key.$login);

			if($_COOKIE['adminstation2'] == $user_pass) {
				session_register('login');
			} else {
				$login = "";
			}
	}
}

// Вытаскиваем данные с юзера
if($login) {

	$get_user_info = mysql_query("SELECT * FROM users WHERE login = '".$login."' LIMIT 1");
	$row = mysql_fetch_array($get_user_info);
	 $user_id			= $row['id'];
	 $login				= $row['login'];
	 $user_pass			= $row['pass'];
	 $user_mail			= $row['mail'];
	 $status			= $row['status'];
	 $lrbalance			= $row['lr_balance'];
	 $pmbalance			= $row['pm_balance'];
	 $balance			= $row['lr_balance'];
	 $balance			= $balance + $row['pm_balance'];
	 $ulr				= $row['lr'];
	 $upm				= $row['pm'];
	 $uref				= $row['ref'];
	 $isact				= $row['isactive'];
	 $pwbtc				= $row['pwbtc'];
	 $refbal			= $row['refbal'];
	 $user_skype		= $row['user_skype'];
	 $user_fio			= $row['user_fio'];
	 $user_town			= $row['user_town'];
	 $user_country		= $row['user_country'];
	 $user_phone		= $row['user_phone'];
	 $user_site 		= $row['user_site'];
	 $bk				= $row['bonuskey'];
	 $sql_nr=mysql_query("SELECT * FROM users WHERE ref='$user_id'");

	 for($i=0;$i<mysql_num_rows($sql_nr);$i++)
	 {
		 $sum=$sum+mysql_result($sql_nr,$i,'cloud');
	 }
	 $nrb=$sum;
	  mysql_query("UPDATE users SET refbal = '$nrb' WHERE id='$user_id'");
	 $sql_sb=mysql_query("SELECT * FROM ref_table");
	 for($i=0;$i<mysql_num_rows($sql_sb);$i++)
	 {
		 $ncl=intval(mysql_result($sql_sb,$i,'referals'));
		 $bonuscly=mysql_result($sql_sb,$i,'cly');
		 if($refbal<$ncl AND $nrb>=$ncl)
		 {
			$rl='Cloud referals sum <'.$ncl;
			 mysql_query("UPDATE users SET cloud = cloud+'$bonuscly' WHERE id='$user_id'");
			 $t=date();
			 mysql_query("INSERT INTO enter (date, login, sum, paysys, purse, status) VALUES ('$t', '$login', '$bonuscly', 'CoinCloud', 'Referal CoinCloud sum bonus', 2)");
			 MYSQL_query("INSERT INTO refbonus (date, login, rlogin, sum) VALUES ('$t', '$login','$rl','$bonuscly'");
		 }
	 }
	mysql_query("UPDATE users SET btc=0 WHERE btc<0");
	mysql_query("UPDATE users SET dgc=0 WHERE dgc<0");
	mysql_query("UPDATE users SET ltc=0 WHERE ltc<0");
	mysql_query("UPDATE users SET dsh=0 WHERE dsh<0");
	mysql_query("UPDATE users SET mnr=0 WHERE mnr<0");
	mysql_query("UPDATE users SET eth=0 WHERE eth<0");
	mysql_query("UPDATE users SET go_time = ".time().", ip = '".getip()."' WHERE id = ".$user_id." LIMIT 1");

	if($status == 3) {
		include "includes/errors/banlogin.php";
		exit();
	}


} else {

	 $user_id		= 0;
	 $login			= "";
	 $user_pass		= "";
	 $user_mail		= "";

}
	if (( $_GET['lang'] == 'ru' || $_GET['lang'] == 'en' )) {
		setcookie( 'lng', htmlspecialchars( $_GET['lang'], ENT_QUOTES ), time(  ) + 2592000, '/' );
		$lng = htmlspecialchars( $_GET['lang'], ENT_QUOTES );
	}
else {
		if (( $_COOKIE['lng'] == 'ru' || $_COOKIE['lng'] == 'en' )) {
			$lng = htmlspecialchars( $_COOKIE['lng'], ENT_QUOTES );
		}
else {
			$get_lang = mysql_fetch_array( mysql_query( 'SELECT `data` FROM `settings` WHERE id = 13 LIMIT 1' ) );
			$lng = 'en';
		}
	}
if(!$idpg) {
	$idpg = 1;
}

	$get_page_info	= mysql_query("SELECT title_en, keywords, description, body, body_en, part FROM pages WHERE id = ".intval($idpg)." LIMIT 1");
	$row			= mysql_fetch_array($get_page_info);
	 $title			= $row['title_en'];
	 $keywords		= $row['keywords'];
	 $description	= $row['description'];
	 if($lng=='en'){$body			= stripslashes($row['body']);}else{
	 $body			= stripslashes($row['body_en']);}
	 $part_page		= $row['part'];

if($page == "news" && $_GET['id']) {
	$get_news_info	= mysql_query("SELECT subject_en, keywords, description, msg, date FROM news WHERE id = ".intval($_GET['id'])." LIMIT 1");
	$row			= mysql_fetch_array($get_news_info);
	 $title			= $row['subject_en'];
	 $keywords		= $row['keywords'];
	 $description	= $row['description'];
	 $news_text		= $row['msg_en'];
	 $news_date		= $row['date'];
}
?>