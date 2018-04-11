<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="/files/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<title>ibit.cash  Доступ запрещён // Acces denied</title>
<meta name="keywords" content="Доступ запрещён, Аудентификация не прошла" />
<meta name="description" content="Доступ запрещён, Аудентификация не прошла" />
<style type="text/css" rel="stylesheet" />
body {
	font-family: Tahoma, Verdana;
	font-size: 11px;
}
</style>
</head>
<?$sql=mysql_query("SELECT * FROM ban_pr WHERE login='$login'");
$title=mysql_result($sql,0,'title');
$img=mysql_result($sql,0,'img');
$body=mysql_result($sql,0,'body');
$date=mysql_result($sql,0,'date');
?>
<body bgcolor="#eeeeee"><br><center>
<h1>Вас забанили // You are banned</h1><br><br>
<p>Причина бана // Ban reason:<?echo $title;?></p><br>
<p><?echo $body;?></p><br><br>
<img src='../img/<?echo $img;?>' width=20% height=20%>
<p><?echo date("d.m.y H:i", $date);?></p>
<hr size="1" width="50%" align="left"><br />
<a href="<?php echo BASE_PATH;?>" target="_blank">ibit</a>
</center>
</body>
</html>