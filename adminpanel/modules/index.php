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
<?php
defined('ACCESS') or die();

$sum = 0.0000;
$query	= "SELECT * FROM users";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$sum = $sum + $row['lr_balance'];
}
$query	= "SELECT * FROM users";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$sum = $sum + $row['pm_balance'];
}

$dep	= 0.00;
$query	= "SELECT * FROM deposits WHERE status = 0";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$dep = $dep + $row['sum'];
}

$out	= 0.00;
$query	= "SELECT * FROM output WHERE status = 2";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$out = $out + $row['sum'];
}

$outw	= 0.00;
$query	= "SELECT * FROM output WHERE status = 0";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$outw = $outw + $row['sum'];
}

$deyout	= 0.00;
$query	= "SELECT * FROM deposits WHERE status = 0";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {

	$result2	= mysql_query("SELECT * FROM plans WHERE id = ".$row['plan']." LIMIT 1");
	$row2		= mysql_fetch_array($result2);

	$deyout = $deyout + $row['sum'] / 100 * $row2['percent'];

}

// Создаем уровень
if($_GET['act'] == "addreflevel") {
	$level		= intval($_POST['level']);
	$percent	= sprintf ("%01.2f", str_replace(',', '.', $_POST['percent']));

	if($level < 1) {
		print '<p class="er">Введите уровень реферальной системы</p>';
	} elseif($percent < 0.01 || $percent > 100) {
		print '<p class="er">Процент должен быть от 0.01 до 100</p>';
	} else {
		mysql_query('INSERT INTO reflevels (id, sum) VALUES ('.$level.', '.$percent.')');
		print '<p class="erok">Новый реферальный уровень - добавлен!</p>';
	}
}

// Удаляем уровень
if($_GET['act'] == "dellevel") {
	mysql_query("DELETE FROM reflevels WHERE id = ".intval($_GET['id'])." LIMIT 1");
	print '<p class="erok">Реферальный уровень удален!</p>';
}

// Редактируем уровень
if($_GET['act'] == "editlevel") {
	$level		= intval($_POST['level']);
	$percent	= sprintf ("%01.2f", str_replace(',', '.', $_POST['percent']));

	if($level < 1) {
		print '<p class="er">Введите уровень реферальной системы</p>';
	} elseif($percent < 0.01 || $percent > 100) {
		print '<p class="er">Процент должен быть от 0.01 до 100</p>';
	} else {
		mysql_query("UPDATE reflevels SET id = ".$level.", sum = ".$percent." WHERE id = ".intval($_GET['id'])." LIMIT 1");
		print '<p class="erok">Изменения сохранены!</p>';
	}
}

?>
<table width="98%" align="center" bgcolor="#cccccc">
	<tr bgcolor="#dddddd">
		<td width="270">Денег на счетах пользователей:</td>
		<td width="100"><b><?php print $sum; ?></b>$</td>
		<td>Сумма депозитов:</td>
		<td width="100"><b><?php print $dep; ?></b>$</td>
	</tr>
	<tr bgcolor="#eeeeee">
		<td>Сумма выплат:</td>
		<td><b><?php print $out; ?></b>$</td>
		<td>Ожидает выплат:</td>
		<td><b><?php print $outw; ?></b>$</td>
	</tr>
	<tr bgcolor="#dddddd">
		<td>Ежедневно выплачивать:</td>
		<td>&asymp;<b><?php print $deyout; ?></b>$</td>
		<td>Жить проекту:</td>
		<td>&asymp;<b><?php print intval(($dep - $out - $outw) / $deyout); ?></b> дней</td>
	</tr>
</table>

<table width="98%" align="center">
<tr valign="top">
	<td width="50%">

	<FIELDSET style="border: solid #666666 1px;">
	<LEGEND><b>Создание нового реферального уровня</b></LEGEND>
		<form action="?act=addreflevel" method="post">
		<table align="center">
		<tr bgcolor="#eeeeee">
			<td><b>Уровень</b>:</td>
			<td align="right"><input class="inp" type="text" size="35" name="level" /></td>
		</tr>
		<tr bgcolor="#eeeeee">
			<td><b>Процент</b>:</td>
			<td align="right"><input class="inp" type="text" size="35" name="percent" /></td>
		</tr>
		<tr>
			<td></td>
			<td align="right"><input type="image" src="images/save.gif" width="28" height="29" border="0" title="Сохранить!" /></td>
		</tr>
		</table>
		</form>
	</FIELDSET>
	</td><td>
	<FIELDSET style="border: solid #666666 1px;">
	<LEGEND><b>Реферальные уровни:</b></LEGEND>

<table align="center">
<tr bgcolor="#dddddd">
	<td><b>Уровень</b></td>
	<td><b>Процент</b></td>
	<td width="32"></td>
	<td width="32"></td>
</tr>
<?php
$query	= "SELECT * FROM reflevels ORDER BY id ASC";
$result	= mysql_query($query);
while($row = mysql_fetch_array($result)) {

print '<form action="?act=editlevel&id='.$row['id'].'" method="post"><tr bgcolor="#eeeeee">
	<td><input class="inp" type="text" size="10" name="level" value="'.$row['id'].'" /></td>
	<td><input class="inp" type="text" size="10" name="percent" value="'.$row['sum'].'" /></td>
	<td align="center" bgcolor="#ffffff"><input type="image" src="images/save.gif" width="28" height="29" border="0" title="Сохранить!" /></td>
	<td align="center" bgcolor="#ffffff"><img style="cursor:pointer;" onclick="if(confirm(\'Вы действительно хотите удалить данный уровень?\')) top.location.href=\'?act=dellevel&id='.$row['id'].'\';" src="images/delite.gif" width="20" height="20" border="0" alt="Удалить" /></td>
</tr></form>';

}
?>
</table>

	</FIELDSET>
	</td>
</tr>
</table>

<p align="center"><a href="http://hy-ip.ru/" target="_blank">Добавьте свой проект в монниторинг</a></p>