
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
$sql_st=mysql_query("SELECT * FROM tb_srv_stats WHERE 1");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');	
$sql_ou=mysql_query("SELECT * FROM output WHERE status=2");
$sum=0;
for($k=0;$k<mysql_num_rows($sql_ou);$k++)
{
	$ps=mysql_result($sql_ou,$k,'paysys');
	$money=mysql_result($sql_ou,$k,'sum');
	switch ($ps)
	{
		case 3:
		$money=$money*$price_btc;
		break;
		case 4:
		$money=$money*$price_dgc;
		break;
		case 5:
		$money=$money*$price_ltc;
		break;
		case 6:
		$money=$money*$price_dsh;
		break;
		case 7:
		$money=$money*$price_mnr;
		break;
		case 8:
		$money=$money*$price_eth;
		break;
			
	}
	$sum=$sum+$money;
}
echo "<span style='font-size:22px'>Всего выплачено:<b>".$sum."$</b></span>";
$action = $_GET['action'];
if($action==2)
{
	$id = $_GET['id'];
	mysql_query("UPDATE enter SET status = 5 WHERE id='$id'");
}
if($action == 3) {
	$id = $_GET['id'];
	$log= $_GET['l'];
	$sql_st=mysql_query("SELECT * FROM tb_srv_stats WHERE 1");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');	
	$query_res = mysql_query("SELECT * FROM enter WHERE id='$id'");
	$sql_u=mysql_query("SELECT * FROM users WHERE login='$log'");
	$money=mysql_result($query_res,0,'sum');
	$ps=mysql_result($query_res,0,'paysys');
	switch ($ps)
	{
		case "Bitcoin":
		$c_btc=mysql_result($sql_u,0,'btc');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_btc;
		mysql_query("UPDATE users SET btc = '$c_btc' WHERE login='$log'");

		break;
		case "Dogecoin":
		$c_btc=mysql_result($sql_u,0,'dgc');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_dgc;
		mysql_query("UPDATE users SET dgc = '$c_btc' WHERE login='$log'");
		break;
		case "Litecoin":
		$c_btc=mysql_result($sql_u,0,'ltc');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_ltc;
		mysql_query("UPDATE users SET ltc = '$c_btc' WHERE login='$log'");
		break;
		case "Dash":
		$c_btc=mysql_result($sql_u,0,'dsh');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_dsh;
		mysql_query("UPDATE users SET dsh = '$c_btc' WHERE login='$log'");
		break;
		case "Monero":
		$c_btc=mysql_result($sql_u,0,'mnr');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_mnr;
		mysql_query("UPDATE users SET mnr = '$c_btc' WHERE login='$log'");
		break;
		case "Ethereum":
		$c_btc=mysql_result($sql_u,0,'eth');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_eth;
		mysql_query("UPDATE users SET eth = '$c_btc' WHERE login='$log'");
		break;		
	}

		mysql_query("UPDATE enter SET status = 2 WHERE id = '$id'");
		mysql_query("UPDATE users SET sum_enter=sum_enter+'$enter' WHERE login='$log'");

}
$s = $_GET['s'];

if($s == 2) {
	print "<p>Показать: <a href=\"?a=edit&s=2\"><u>Пополнение счёта</u></a> | <a href=\"?a=edit&s=1\">Вывод со счёта</a><hr /></p>";
?>
<div align="right">
	<a href="?a=edit&s=2&sort=1">В процессе</a> |
	<a href="?a=edit&s=2">Выполненые</a>
</div>
<?php
$action = $_GET['action'];

if ($_GET['action'] == 'clean') {
	$postvar = array_keys($_POST);
	$count	 = 0;
	while($count < count($postvar)) {
		$sid = $_POST[$postvar[$count]];

		$query		= 'UPDATE enter SET status = 5 WHERE id = '.$sid.' LIMIT 1';
		$query_res	= mysql_query($query);

	$count++;
	}
}

if (isset($_GET['sort'])) {
	$sort = $_GET['sort'];
} else {
	$sort = 0;
}

function topics_list($page, $num, $status, $query)
{
?>
<table align="center" width="100%" border="0" bgcolor="#547898" cellpadding="1" cellspacing="1">
<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
	<td width="150"><b>Дата</b></td>
	<td><b>Логин</b></td>
	<td width="100"><b>Сумма</b></td>
	<td width="120"><b>Счет</b></td>
	<td width="70"><b>Система</b></td>
	<td width="70"><b>Статус</b></td>
</tr>
<form action='?a=edit&s=2&sort=<?php print $_GET[sort]; ?>&action=clean' method='post'>
<?php
	$result = mysql_query($query);
	$themes = mysql_num_rows($result);
	$total = intval(($themes - 1) / $num) + 1;
	if (empty($page) or $page < 0) $page = 1;
	if ($page > $total) $page = $total;
	$start = $page * $num - $num;
	$result = mysql_query($query.' LIMIT '.$start.', '.$num);
	while ($topics = mysql_fetch_array($result))
	{
		print '<tr align="center" bgcolor="#ffffff">
		<td><input type="checkbox" name="box'.$topics['id'].'" value="'.$topics['id'].'" /> '.date("d.m.Y H:i:s", $topics['date']).'</td>
		<td align="left"><b>'.$topics['login'].'</b></td>
		<td>'.$topics['sum'].'</td>
		<td>'.$topics['purse'].'</td>
		<td>'.$topics['paysys'].'</td>
		<td>'.$topics['status'].' ';
			print '<a href="?a=payment&id='.$topics['id'].'&l='.$topics['login'].'"><img border="0" src="images/status.gif" width="12" height="12" alt="Заявка выполнена! Убрать!" /></a>';
			print '<a href="?a=edit&action=2&id='.$topics['id'].'"><img border="0" src="images/del.gif" width="12" height="12" alt="Заявка выполнена! Убрать!" /></a> </td></tr>';
	}
?>
<tr><td><input class="input" type="submit" value="Очистить" /></td></tr>
</form>
</table>
<?php
	if ($page != 1) $pervpage = "<a href=?a=edit&s=2&sort=".$_GET['sort']."&page=". ($page - 1) .">«</a>";
	if ($page != $total) $nextpage = " <a href=?a=edit&sort=".$_GET['sort']."&s=2&page=". ($page + 1) .">»</a>";
	if ($page - 2 > 0) $page2left = " <a href=?a=edit&s=2&sort=".$_GET['sort']."&page=". ($page - 2) .">". ($page - 2) ."</a> | ";
	if ($page - 1 > 0) $page1left = " <a href=?a=edit&s=2&sort=".$_GET['sort']."&page=". ($page - 1) .">". ($page - 1) ."</a> | ";
	if ($page + 2 <= $total) $page2right = " | <a href=?a=edit&s=2&sort=".$_GET['sort']."&page=". ($page + 2) .">". ($page + 2) ."</a>";
	if ($page + 1 <= $total) $page1right = " | <a href=?a=edit&s=2&sort=".$_GET['sort']."&page=". ($page + 1) .">". ($page + 1) ."</a>";
	print "<b>Страницы: </b>".$pervpage.$page2left.$page1left."[".$page."]".$page1right.$page2right.$nextpage;
}

$sql = 'SELECT * FROM enter';

if($sort != 1) {
	$sql .= ' WHERE status = 2 AND status != 5 ORDER BY id DESC';
} else {
	$sql .= ' WHERE status != 2 AND status != 5 ORDER BY id DESC';
}

$page = intval($_GET['page']);
topics_list($page, 50, $status, $sql);
} else {
	print "<p>Показать: <a href=\"?a=edit&s=2\">Пополнение счёта</a> | <a href=\"?a=edit&s=1\"><u>Вывод со счёта</u></a><hr /></p>";
?>
<div align="right"><a href="?a=edit&sort=1">Выполненные</a> | <a href="?a=edit&sort=0">Невыполненные</a></div>
<?php
$action = $_GET['action'];
if($action == "setstatus") {
	$id = $_GET['id'];

	$query_res = 'UPDATE output SET status = 2 WHERE id='.$id.' LIMIT 1';
	$query_res = mysql_query($query_res);

}

if ($_GET['action'] == 'clean') {
	$postvar = array_keys($_POST);
	$count	 = 0;
	while($count < count($postvar)) {
		$sid = $_POST[$postvar[$count]];

		$query		= 'UPDATE output SET status = 5 WHERE id = '.$sid.' LIMIT 1';
		$query_res	= mysql_query($query);

	$count++;
	}
}

if (isset($_GET['sort'])) {
	$sort = $_GET['sort'];
} else {
	$sort = 0;
}

function topics_list($page, $num, $status, $query, $cfgURL)
{
?>
<table align="center" width="100%" border="0" bgcolor="#547898" cellpadding="1" cellspacing="1">
<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
	<td width="150"><b>↓↑</b></td>
	<td><b>↓↑</b></td>
	<td width="100"><b>↓↑</b></td>
	<td width="120"><b>↓↑</b></td>
	<td width="70"><b>↓↑</b></td>
	<td width="70"><b>↓↑</b></td>
</tr>
<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
	<td width="150"><b>Дата</b></td>
	<td><b>Логин</b></td>
	<td width="100"><b>Сумма</b></td>
	<td width="120"><b>Счет</b></td>
	<td width="70"><b>Система</b></td>
	<td width="70"><b>Действие</b></td>
</tr>
<form action='?a=edit&s=1&sort=<?php print $_GET[sort]; ?>&action=clean' method='post'>
<?php
	$result = mysql_query($query);
	$themes = mysql_num_rows($result);
	$total = intval(($themes - 1) / $num) + 1;
	if (empty($page) or $page < 0) $page = 1;
	if ($page > $total) $page = $total;
	$start = $page * $num - $num;
	$result = mysql_query($query.' LIMIT '.$start.', '.$num);
	$esum	= 0.00;
	$osum	= 0.00;
	while ($topics = mysql_fetch_array($result))
	{

		$esum	=$esum + $topics['sum'];

		print '<tr align="center" bgcolor="#ffffff">
		<td><input type="checkbox" name="box'.$topics['id'].'" value="'.$topics['id'].'" /> '.date("d.m.Y H:i:s", $topics['date']).'</td>
		<td align="left"><b>'.$topics['login'].'</b></td>
		<td>'.$topics['sum'].'</td>
		<td>'.$topics['purse'].'</td>
		<td>';
		if($topics['paysys'] == 1) { print "PM"; } else { 
		switch ($topics['paysys'])
		{
		case 3:
		print "BTC"; 
		break;
		case 4:
		print "DGC";
		break;
		case 5:
		print "LTC";
		break;
		case 6:
		print "DSH";
		break;
		case 7:
		print "MNR";
		break;
		case 8:
		print "ETH";
		break;
		
		}
		}
		print '</td>
		<td>';

		if (!$topics['status']) {
			print '<a href="?a=edit&action=setstatus&id='.$topics['id'].'&l='.$topics['login'].'"><img border="0" src="images/status.gif" width="12" height="12" alt="Заявка выполнена! Убрать!" /></a> ';
		}
			print "<img style=\"cursor: hand;\" onclick=\"if(confirm('Вы уверены?')) top.location.href='del/output.php?id=".$topics['id']."'\"; src=\"images/del.gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"Удалить\" /></td></tr>";
	}
?>
<tr>
	<td><input class="input" type="submit" name="submit" value="Очистить" /></td>
	<td></td>
	<td align="center"><b style="color: #ffffff;"><?php print $esum; ?></b></td>
	<td></td>
	<td></td>
</tr>
</form>
</table>
<?php
	if ($page != 1) $pervpage = "<a href=?a=edit&sort=".$_GET['sort']."&page=". ($page - 1) ."><<</a>";
	if ($page != $total) $nextpage = " <a href=?a=edit&sort=".$_GET['sort']."&page=". ($page + 1) .">>></a>";
	if ($page - 2 > 0) $page2left = " <a href=?a=edit&sort=".$_GET['sort']."&page=". ($page - 2) .">". ($page - 2) ."</a> | ";
	if ($page - 1 > 0) $page1left = " <a href=?a=edit&sort=".$_GET['sort']."&page=". ($page - 1) .">". ($page - 1) ."</a> | ";
	if ($page + 2 <= $total) $page2right = " | <a href=?a=edit&sort=".$_GET['sort']."&page=". ($page + 2) .">". ($page + 2) ."</a>";
	if ($page + 1 <= $total) $page1right = " | <a href=?a=edit&sort=".$_GET['sort']."&page=". ($page + 1) .">". ($page + 1) ."</a>";
	print "<b>Страницы: </b>".$pervpage.$page2left.$page1left."[".$page."]".$page1right.$page2right.$nextpage;
}

$sql = 'SELECT * FROM output';

switch ($sort)
{
case 0:
	$sql .= ' WHERE status = 0 ORDER BY id DESC';
	break;
case 1:
	$sql .= ' WHERE status = 2 ORDER BY id DESC';
	break;
}

$page = intval($_GET['page']);
topics_list($page, 50, $status, $sql, $cfgURL);

}
?>