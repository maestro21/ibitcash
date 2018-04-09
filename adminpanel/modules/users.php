<form action="?a=users&action=searchuser" method="post">
<FIELDSET style="border: solid #666666 1px; padding: 10px; margin-top: 10px;">
<LEGEND><b>Найти пользователя по Логину / ID / e-mail / кошельку</b></LEGEND>
<table width="100%" border="0">
	<tr>
		<td width="60"><strong>Поиск:</strong></td>
		<td><input class="inp" style="background-color: #ffffff; width: 625px;" type="text" name="name" size="93" /></td>
		<td align="center"><input type="image" src="images/search.gif" width="28" height="29" border="0" title="Поиск!" /></td>
	</tr>
</table>
</FIELDSET>
</form>

<script language="javascript" type="text/javascript" src="files/alt.js"></script>
<?php
defined('ACCESS') or die();
if($_GET['del_ban']==1)
{
	mysql_query("DELETE FROM users WHERE status=3");
}
// Задаём статус пользователю
if($_GET['p'] || $_GET['id']) {
	if(isset($_GET['status'])) {
		if($_GET['status'] < 0 OR $_GET['status'] > 5) {
			print '<p class="er">Указанный статус не корректен!</p>';
		} elseif($status != 1) {
			print '<p class="er">У вас нет прав на эту функцию!</p>';
		} else {
			$sql = 'UPDATE users SET status = '.intval($_GET[status]).' WHERE id = '.intval($_GET[id]).' LIMIT 1';
			if (mysql_query($sql)) {
				print '<p class="erok">Статус был успешно установлен!</p>';
			} else {
				print '<p class="er">Ошибка записи в БД!</p>';
			}
		}
	} else {
		print '<p class="er">Не указан статус!</p>';
	}
}
// Закончили со статусом

// Создаём пользователя
if($_GET[action] == "add") {

	$name = addslashes($_POST[name]);
	$pass1 = $_POST[pass];
	$pass2 = $_POST[re_pass];
	$email = $_POST[email];

	if(!$name OR !$pass1 OR !$pass2 OR !$email) {
		print '<p class="er">Корректно заполните все поля!</p>';
	} else {
		if($pass1 != $pass2) {
			print '<p class="er">Пароль и подтерждение не совпадают!</p>';
		} elseif(!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is",$email)) {
				print "<p class=\"er\">Введите правильно e-mail!</p>";
		} else {
			$sql = 'SELECT login FROM users WHERE login = "'.$name.'"';
			if(mysql_num_rows(mysql_query($sql))) {
				print '<p class="er">Пользователь с таким именем уже существует!</p>';
			} else {
				$sql = 'INSERT INTO users (login, go_time, ip, pass, mail, reg_time) VALUES ("'.$name.'", '.time().', "'.getip().'", "'.as_md5($key, $pass1).'", "'.$email.'", '.time().')';
				if (mysql_query($sql)) {
					print '<p class="erok">Создание пользователя прошло успешно!</p>';
				} else {
					print '<p class="er">Ошибка записи в БД!</p>';
				}
			}
		}
	}

}
// Закончили создавать
$money = 0.00;
$query	= "SELECT `lr_balance` FROM `users`";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$money = $money + $row['lr_balance'];
}
$query	= "SELECT `pm_balance` FROM `users`";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$money = $money + $row['pm_balance'];
}
echo $_GET['sortr'];
if($_GET['sortr'])
{
	$srt=$_GET['sortr'];
	switch($srt)
	{
		case '11':
		$ord='id';
		break;
		
		case '12':
		$ord='id DESC';
		break;
		
		case 21:
		$ord='login';
		break;
		
		case 22:
		$ord='login DESC';
		break;
		
		case 31:
		$ord='cloud';
		break;
		
		case 32:
		$ord='cloud DESC';
		break;

		case 41:
		$ord='btc';
		break;
		
		case 42:
		$ord='btc DESC';
		break;

		case 51:
		$ord='dgc';
		break;
		
		case 52:
		$ord='dgc DESC';
		break;
		
		case 61:
		$ord='ltc';
		break;
		
		case 62:
		$ord='ltc DESC';
		break;
		
		case 71:
		$ord='dsh';
		break;
		
		case 72:
		$ord="dsh DESC";
		break;

		case 81:
		$ord='mnr';
		break;
		
		case 82:
		$ord='mnr DESC';
		break;
		
		case 91:
		$ord='eth';
		break;
		
		case 92:
		$ord='eth DESC';
		break;
		
		case 101:
		$ord='status';
		break;
		
		case 112:
		$ord='status DESC';
		break;
		
		case 111:
		$ord='reg_time';
		break;
		
		case 112:
		$ord='reg_time DESC';
		break;
		
		case 121:
		$ord='go_time';
		break;
		
		case 122:
		$ord='go_time DESC';
		break;
		
		case 131:
		$ord='ip';
		break;
		
		case 132:
		$ord='ip DESC';
		break;
		
		case 141:
		$ord='status';
		break;
		
		case 142:
		$ord='status DESC';
		break;
		
		case 151:
		$ord='sum_enter';
		break;
		
		case 152:
		$ord='sum_enter DESC';
		break;
	}
	$_SESSION['ord']=$ord;
}
if(!$_SESSION['ord']){$ord=$_SESSION['ord']='id';}else{$ord=$_SESSION['ord'];}
?>
<a href="?a=users&del_ban=1">>>>Удалить все забаненые аккаунты<<<</a>
<center><b>Всего денег на балансе у пользователей: $<?php print sprintf("%01.2f", $money); ?></b></center>
<hr />
<table border="0" align="center" width="100%" cellpadding="1" cellspacing="1" bgcolor="#547898">
<colspan><div align="right" style="padding: 2px;">Сортировать по: <a href="?a=users">ID</a> | <a href="?a=users&sort=auth">Авторизации</a> | <a href="?a=users&sort=lr_balance">Балансу LR</a> | <a href="?a=users&sort=pm_balance">Балансу PM</a> | <a href="?a=users&sort=status">Статусу</a> | <a href="?a=users&sort=login">Логину</a> | <a href="?a=users&sort=ip">IP</a></div></colspan>
	<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
		<td width="40"><b><a href='/adminpanel/adminstation.php?a=users&sortr=11'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=12'>↓</a></b></td>
  		<td><b><a href='/adminpanel/adminstation.php?a=users&sort=21'>↑<a href='/adminpanel/adminstation.php?a=users&sortr=22'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=31'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=32'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=41'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=42'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=51'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=52'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=61'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=62'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=71'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=72'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=81'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=82'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=91'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=92'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=151'>↑</a><a href='/adminpanel/adminstation.php?a=users&sortr=152'>↓</a></b></td>
		<td width="70"><b><a href='/adminpanel/adminstation.php?a=users&sortr=101'>↓</a><a href='/adminpanel/adminstation.php?a=users&sortr=102'>↑</a></b></td>
		<td width="80"><b><a href='/adminpanel/adminstation.php?a=users&sortr=111'>↓</a><a href='/adminpanel/adminstation.php?a=users&sortr=112'>↑</a></b></td>
		<td width="80"><b><a href='/adminpanel/adminstation.php?a=users&sortr=121'>↓</a><a href='/adminpanel/adminstation.php?a=users&sortr=122'>↑</a></b></td>
		<td width="90"><b><a href='/adminpanel/adminstation.php?a=users&sortr=131'>↓</a><a href='/adminpanel/adminstation.php?a=users&sortr=132'>↑</a></b></td>
		<td width="45"><b><a href='/adminpanel/adminstation.php?a=users&sortr=141'>↓</a><a href='/adminpanel/adminstation.php?a=users&sortr=142'>↑</a></b></td>
		<td width="110"><b></b></td>
	</tr>
	<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
		<td width="40"><b>ID</b></td>
  		<td><b>Логин</b></td>
		<td width="70"><b>Баланс cld</b></td>
		<td width="70"><b>Баланс btc</b></td>
		<td width="70"><b>Баланс dgc</b></td>
		<td width="70"><b>Баланс ltc</b></td>
		<td width="70"><b>Баланс dsh</b></td>
		<td width="70"><b>Баланс mnr</b></td>
		<td width="70"><b>Баланс eth</b></td>
		<td width="70"><b>Ввёл $</b></td>
		<td width="70"><b>Сумма облаков рефов</b></td>
		<td width="80"><b>Регистрация</b></td>
		<td width="80"><b>Входил</b></td>
		<td width="90"><b>Последний&nbsp;IP</b></td>
		<td width="45"><b>Статус</b></td>
		<td width="110"><b>EDIT</b></td>
	</tr>
<?php
function users_list($page, $num, $query, $ord) {

	$result = mysql_query($query);
$sql_st=mysql_query("SELECT * FROM tb_srv_stats WHERE 1");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');	
	$themes = mysql_num_rows($result);

	if (!$themes) {
		print '<tr><td colspan="9" align="center"><font color="#ffffff"><b>Пользователей пока нет.</b></font></td></tr>';
	} else {

		$total = intval(($themes - 1) / $num) + 1;
		if (empty($page) or $page < 0) $page = 1;
		if ($page > $total) $page = $total;
		$start = $page * $num - $num;
		$result = mysql_query($query." ORDER BY ".$ord." LIMIT ".$start.", ".$num);
		$res2 =' ORDER BY '.$ord;
		while ($row = mysql_fetch_array($result)) {
					$lg=$row['login'];
						$sql_ent=mysql_query("SELECT * FROM enter WHERE login='$lg' AND status='2'");
	$esum=0;
	for($i=0;$i<mysql_num_rows($sql_ent);$i++)
	{
		$ecur=mysql_result($sql_ent,$i,'sum');
		$valcur=mysql_result($sql_ent,$i,'paysys');
		switch($valcur)
		{
			case 'Bitcoin':
			$ecur=$ecur*$price_btc;
			break;
			case 'Dogecoin':
			$ecur=$ecur*$price_dgc;
			break;
			case 'Litecoin':
			$ecur=$ecur*$price_ltc;
			break;
			case 'Dash':
			$ecur=$ecur*$price_dsh;
			break;
			case 'Monero':
			$ecur=$ecur*$price_mnr;
			break;
			case 'Ethereum':
			$ecur=$ecur*$price_eth;
			break;
		}
		$esum=$esum+$ecur;
	}
	$uid=$row['id'];
		$sql_r=mysql_query("SELECT * FROM users WHERE ref='$uid'");
		$k=0;
		for ($i=0;$i<mysql_num_rows($sql_r);$i++)
		{
			$b=mysql_result($sql_r,$i,'cloud');
			$k=$k+$b;
		}
	print "<tr bgcolor=\"#eeeeee\" align=\"center\">
		<td>".$row['id']."</td>
		<td align=\"left\"><a href=\"mailto:".$row['mail']."\"><b>".$row['login']."</b></a></td>
		<td>".$row['cloud']."</td>
		<td>".$row['btc']."</td>
		<td>".$row['dgc']."</td>
		<td>".$row['ltc']."</td>
		<td>".$row['dsh']."</td>
		<td>".$row['mnr']."</td>
		<td>".$row['eth']."</td>
		<td>$".$row['sum_enter']."</td>
		<td>".$k."</td>
		<td>".date("d.m.y H:i", $row['reg_time'])."</td>
		<td>".date("d.m.y H:i", $row['go_time'])."</td>
		<td>".$row['ip']."</td>
	<td>";

			switch ($row[status])
			{
			case 0:
				print "<img src=\"images/user.gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"User\">";
				break;
			case 1:
				print "<img src=\"images/admin.gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"Админ\">";
				break;
			case 2:
				print "<img src=\"images/moder.gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"Модератор\">";
				break;
			case 3:
				print "<img src=\"images/ban.gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"Заблокированный\">";
				break;
			}

			print "</td>
			<td><nobr><a onClick=\"return confirm('Удалить этого пользователя?')\" href='del/user.php?page=".$page."&id=".$row[id]."'><img src=\"images/del.gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"Удаление пользователя\"></a> ";

			switch ($row[status])
			{
			case 0:
				print '<a href="?a=users&p=change_status&id='.$row[id].'&status=2"><img src="images/moder.gif" width="12" height="12" border="0" alt="Сделать модером"></a> <a href="?a=users&p=change_status&id='.$row[id].'&status=1"><img src="images/admin.gif" width="12" height="12" border="0" alt="Сделать админом"></a> <a href="?a=ban_user&login='.$row[login].'"><img src="images/ban.gif" width="12" height="12" border="0" alt="Закрыть доступ"></a>';
				break;
			case 1:
				print '<a href="?a=users&p=change_status&id='.$row[id].'&status=0"><img src="images/user.gif" width="12" height="12" border="0" alt="Сделать юзером"></a> <a href="?a=users&p=change_status&id='.$row[id].'&status=2"><img src="images/moder.gif" width="12" height="12" border="0" alt="Сделать модером"></a> <a href="?a=ban_user&login='.$row[login].'&status=3"><img src="images/ban.gif" width="12" height="12" border="0" alt="Закрыть доступ"></a>';
				break;
			case 2:
				print '<a href="?a=users&p=change_status&id='.$row[id].'&status=0"><img src="images/user.gif" width="12" height="12" border="0" alt="Сделать юзером"></a> <a href="?a=users&p=change_status&id='.$row[id].'&status=1"><img src="images/admin.gif" width="12" height="12" border="0" alt="Сделать админом"></a> <a href="?a=ban_user&login='.$row[login].'&status=3"><img src="images/ban.gif" width="12" height="12" border="0" alt="Закрыть доступ"></a>';
				break;
			case 3:
				print '<a href="?a=users&p=change_status&id='.$row[id].'&status=0"><img src="images/user.gif" width="12" height="12" border="0" alt="Разблокировать"></a> <a href="?a=users&p=change_status&id='.$row[id].'&status=2"><img src="images/moder.gif" width="12" height="12" border="0" alt="Сделать модером"></a> <a href="?a=users&p=change_status&id='.$row[id].'&status=1"><img src="images/admin.gif" width="12" height="12" border="0" alt="Сделать админом"></a>';
				break;
			}

			print ' <a href="?a=edit_user&id='.$row[id].'"><img src="images/edit_small.gif" width="12" height="12" border="0" alt="Редактировать"></a> <a href="?a=referals&id='.$row[id].'"><img src="images/partners.gif" width="12" height="12" border="0" alt="Привлечённые рефералы"></a> <a href="?a=logip&id='.$row[id].'"><img src="images/ip.gif" width="12" height="12" border="0" alt="Лог IP"></a></nobr></td></tr>';
		}

		if ($page != 1) $pervpage = "<a href=?a=users&sort=".$_GET['sort']."&page=". ($page - 1) .">««</a>";
		if ($page != $total) $nextpage = " <a href=?a=users&sort=".$_GET['sort']."&page=". ($page + 1) .">»»</a>";
		if($page - 2 > 0) $page2left = " <a href=?a=users&sort=".$_GET['sort']."&page=". ($page - 2) .">". ($page - 2) ."</a> | ";
		if($page - 1 > 0) $page1left = " <a href=?a=users&sort=".$_GET['sort']."&page=". ($page - 1) .">". ($page - 1) ."</a> | ";
		if($page + 2 <= $total) $page2right = " | <a href=?a=users&sort=".$_GET['sort']."&page=". ($page + 2) .">". ($page + 2) ."</a>";
		if($page + 1 <= $total) $page1right = " | <a href=?a=users&sort=".$_GET['sort']."&page=". ($page + 1) .">". ($page + 1) ."</a>";
		print "<tr height=\"19\"><td colspan=\"14\" bgcolor=\"#ffffff\"><b>Страницы: </b>".$pervpage.$page2left.$page1left."[".$page."]".$page1right.$page2right.$nextpage."</td></tr>";
	}
	print "</table>";
}

if($_GET['sort'] == "login") {
	$sort = "ORDER BY login ASC";
} elseif($_GET['sort'] == "status") {
	$sort = "order by status DESC";
} elseif($_GET[sort] == "lr_balance") {
	$sort = "order by lr_balance DESC";
} elseif($_GET[sort] == "pm_balance") {
	$sort = "order by pm_balance DESC";
} elseif($_GET[sort] == "ip") {
	$sort = "order by ip DESC";
} elseif($_GET[sort] == "auth") {
	$sort = "order by go_time DESC";
} else {
	$sort = "GROUP BY id order by id ASC";
}

if($_GET['action'] == "searchuser") {
	$su = " AND (login = '".$_POST['name']."' OR id = ".intval($_POST['name'])." OR mail = '".$_POST['name']."' OR lr = '".$_POST['name']."' OR pm = '".$_POST['name']."')";
}

$sql = "SELECT * FROM users WHERE login != 'Rem-x'".$su;
users_list(intval($_GET[page]), 50, $sql, $ord);
?>
<form action="?a=users&action=add" method="post">
<FIELDSET style="border: solid #666666 1px; padding: 10px; margin-top: 10px;">
<LEGEND><b>Создание нового пользователя</b></LEGEND>
<table width="100%" border="0">
	<tr>
		<td><strong>Login:</strong></td>
		<td><input class="inp" style="background-color: #ffffff;" type="text" name="name" size="30" /></td>
		<td><strong>E-mail:</strong></td>
		<td><input class="inp" style="background-color: #ffffff;" type="text" name="email" size="30" /></td>
		<td rowspan="2" valign="bottom" align="center"><input type="image" src="images/save.gif" width="28" height="29" border="0" title="Сохранить!" /></td>
	</tr>
	<tr>
		<td><strong>Пароль:</strong></td>
		<td><input class="inp" style="background-color: #ffffff;" type="password" name="pass" size="30" /></td>
		<td><strong>Пароль</strong> <small>[повторно]</small>:</td>
		<td><input class="inp" style="background-color: #ffffff;" type="password" name="re_pass" size="30" /></td>
	</tr>
</table>
</FIELDSET>
</form>