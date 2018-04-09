<?php
	$page = 'login';
	$file = 'login.php';
	$idpg = 2;
	include '../cfg.php';
	include '../ini.php';

$user			= addslashes(htmlspecialchars($_POST["user"], ENT_QUOTES));
$password		= $_POST['pass'];
if(strrchr($user, '@') == false){
$get_pass	= mysql_query("SELECT id, login, pass, status FROM users WHERE login = '".$user."' LIMIT 1");
}else{
$get_pass	= mysql_query("SELECT id, login, pass, status FROM users WHERE mail = '".$user."' LIMIT 1");
}
$row		= mysql_fetch_array($get_pass);
 $id			= $row['id'];
 $login			= $row['login'];
 $user_password = $row['pass'];
 $status		= $row['status'];

if(as_md5($key2, $password) != $user_password || !$login) {

	$login = '';
	if($lng == "ru") {
		include "../template_ru.php";
		include "../att.php";
	} else {
		include "../template.php";
		include "../att_en.php";
	}
	if($user!=''){
	if(as_md5($key2, $password) != $user_password){?><script>showatt(12);</script><?}
	if(mysql_num_rows($get_pass)==0)
	{?><script>showatt(13);</script><?}
	}
	exit();

} elseif($status == 4) {

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
<link href=\"/files/styles.css\" rel=\"stylesheet\">
<script language=\"javascript\">alert('Ваш логин заблокирован!'); top.location.href=\"/\";</script>
<title>Перенаправление</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">
Через секунду вы будете перемещены на сайт.<br>
Если устали ждать жмите <a href=\"/\">здесь!</a>
</body>
</html>";

} else {

session_start();
$_SESSION['login'] = $login;

$ip		= getip();
$time	= time();
$sql=mysql_query("SELECT * FROM users WHERE login='$login'");
$lb=mysql_result($sql,0,'last_bonus');
$lb=$lb+86400;
$t=time();
if($lb<$t)
{
$sql2=mysql_query("SELECT * FROM tb_srv_stats");
$bdgc=mysql_result($sql2,0,'bdgc');
$beth=mysql_result($sql2,0,'beth');

mysql_query("UPDATE users SET bdgc=bdgc+'$bdgc',beth=beth+'$beth',last_bonus='$t' WHERE login='$login'");
mysql_query("INSERT INTO enter (sum, date, login, paysys, status) VALUES ('$beth', '$t', '$login', 'BONUS Ethereum', 2)");
mysql_query("INSERT INTO enter (sum, date, login, paysys, status) VALUES ('$bdgc', '$t', '$login', 'BONUS DOGE', 2)");
}
mysql_query("UPDATE users SET ip = '".$ip."', go_time = ".$time." WHERE login = '".$login."' LIMIT 1");
mysql_query("INSERT INTO logip (user_id, ip, date) VALUES (".$id.", '".$ip."', ".$time.")");

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
<link href=\"/files/styles.css\" rel=\"stylesheet\">
<script language=\"javascript\">top.location.href=\"/mining/\";</script>
<title>Перенаправление</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">
Вы вошли в систему как <b>".$login."</b><br>
Через секунду вы будете перемещены на сайт.<br>
Если устали ждать жмите <a href=\"/mining/\">здесь!</a>
</body>
</html>";

}
?>