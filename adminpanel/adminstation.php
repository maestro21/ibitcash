<?php
/*

-> Главный файл программы AdminStation
*/

include "../cfg.php";
include "../ini.php";
if($status == 1 || $status == 2) {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Управление проектом Ibit<?php print $cfgURL; ?>»</title>
<link href="files/favicon.ico" type="image/x-icon" rel="shortcut icon">
<link href="files/styles.css" rel="stylesheet" type="text/css" />
<script src="files/jquery.js"></script>
<script language="JavaScript">
<!--
function popUP(url,width,height) {
	if(!width) { width = 780; }
	if(!height) { height = 450; }
	var posx = 200;
	var posy = 200;
	var w=window.open(url,'wind','left='+posx+',top='+posy+',width='+width+',height='+height+',status:no, help:no');
	return false;
}
//-->
</script>
</head>
<body bgcolor="#ffffff" rightmargin="0" leftmargin="0" topmargin="0" bottommargin="0" style="background:URL(images/bg_head.gif) repeat-x top left; background-color: #ffffff;">
<table align="center" width="774" height="100%" border="0" cellpadding="0" cellspacing="0">
	<tr height="65">
		<td>
			<table align="center" width="768" height="65" border="0" cellpadding="0" cellspacing="0">
				<tr valign="top">
					<td><a href="adminstation.php"><img src="images/logo.jpg" width="202" height="65" alt="CMS AdminStation" border="0" /></a></td>
					<td width="30"><a href="/" target="_blank"><img src="images/home.gif" width="30" height="48" border="0" alt="Перейти на главную страницу сайта" title="Перейти на главную страницу сайта" /></a></td>
					<td width="10"></td>
					<td width="30"><img style="cursor: hand;" onclick="popUP('http://adminstation.ru/help/index.html',775,450);" src="images/help.gif" width="30" height="48" border="0" alt="Помощь" title="Помощь" /></td>
					<td width="10"></td>
					<td width="30"><img style="cursor: pointer;" onclick="if(confirm('Вы действительно хотите выйти?')) top.location.href='/exit.php';" src="images/exit.gif" width="30" height="48" border="0" alt="Выход" title="Выход" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="1">
			<table align="center" width="774" border="0" cellpadding="1" cellspacing="1" bgcolor="#547898" style="border-radius: 6px 6px 0 0;">
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td width="257"><a class="menutop" href="?a=news">Добавить новость</a></td>
					<td><a class="menutop" href="?a=add_page">Создать страницу</a></td>
					<td width="257"><a class="menutop" href="?a=pages">Созданные страницы</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=deposits">Депозиты</a></td>
					<td><a class="menutop" href="?a=edit">Бухгалтерия</a></td>
					<td><a class="menutop" href="?a=reftop">Рейтинг рефоводов</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=users">Управление пользователями</a></td>
					<td><a class="menutop" href="?a=mailto">Рассылка пользователям</a></td>
					<td><a class="menutop" href="?a=change_pass">Сменить пароль</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">					
					<td><a class="menutop" href="?a=fake">Накрутка статистики</a></td>
					<td><a class="menutop" href="?a=blacklist">Черный список IP</a></td>
					<td><a class="menutop" href="?a=logip">Мониторинг IP</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=settings">Настройки проекта</a></td>
					<td><a class="menutop" href="?a=plans">Инвестиционные планы</a></td>
					<td><a class="menutop" href="?a=paysystems">Платежные системы</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=serverinf">Информация о сервере</a></td>
					<td><a class="menutop" href="?a=antivirus">Антивирус</a></td>
					<td><a class="menutop" href="?a=">Статистика</a></td>
				</tr>
					<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=params">Настройки валют</a></td>
					<td><a class="menutop" href="?a=multi">Мультиаккаунты</a></td>
					<td><a class="menutop" href="?a=ref_adm">Бонусы за рефералов</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=tickets">Тикеты</a></td>
					<td><a class="menutop" href="?a=addnews">Новости</a></td>
					<td><a class="menutop" href="?a=sendmail">Написать письмо</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=givebonus">Дать бонус</a></td>
					<td><a class="menutop" href="?a=optimize">Оптимизация</a></td>
					<td><a class="menutop" href="?a=hand_payment">Ручное пополнение</a></td>
				</tr>
				<tr height="19" style="background:URL(images/menu.gif) repeat-x top left;">
					<td><a class="menutop" href="?a=timebonus">Бонус(выскакивающий)</a></td>
					<td><a class="menutop" href="?a=referal_table">Таблица рефералов</a></td>
					<td><a class="menutop" href="?a=genpass">Генерировать пароль юзеру</a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" style="padding: 10 10 10 10px; border-left: solid #547898 1px; border-right: solid #547898 1px; background:URL(images/logo_down.jpg) no-repeat bottom right;">
<?php
$a	= substr(addslashes(htmlspecialchars($_GET['a'], ENT_QUOTES, '')), 0, 15);

	if(!$a) {
		include "modules/index.php";
	} elseif(file_exists("modules/".$a.".php")) {
		include "modules/".$a.".php";
	} else {
		include "modules/error.php";
	}

?>&nbsp;
		</td>
	</tr>
	<tr height="33" bgcolor="#5e87a9">
		<td align="center" style="color: #ffffff;">&copy; 2007-<?php print date(Y); ?> CMS <a style="color: #ffffff;" href="<?php echo BASE_PATH;?>" target="_blank">ibit</a> v3.1.1<br />
		Все права защищены!</td>
	</tr>
</table>



</body>
</html>
<?php
} else {
print "<html><head><script language=\"javascript\">top.location.href='index.php';</script></head><body><a href=\"index.php\"><b>Index</b></a></body></html>";
}
?>