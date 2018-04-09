<?php

defined('ACCESS') or die();

if($_GET['action'] == "add") {

	$name			= htmlspecialchars($_POST['name'], ENT_QUOTES);
	$minsum			= sprintf("%01.2f", $_POST['minsum']);
	$maxsum			= sprintf("%01.2f", $_POST['maxsum']);
	$percent		= sprintf("%01.2f", $_POST['percent']);
	$bonusdeposit	= sprintf("%01.2f", $_POST['bonusdeposit']);
	$bonusbalance	= sprintf("%01.2f", $_POST['bonusbalance']);
	$period			= intval($_POST['period']);
	$days			= intval($_POST['days']);
	$back			= intval($_POST['back']);

	if($name && $minsum && $percent && $days) {
		mysql_query("INSERT INTO `plans` (`name`, `minsum`, `maxsum`, `percent`, `period`, `days`, `back`, `bonusdeposit`, `bonusbalance`) VALUES ('".$name."', ".$minsum.", ".$maxsum.", ".$percent.", ".$period.", ".$days.", ".$back.", ".$bonusdeposit.", ".$bonusbalance.")");
		print '<p class="erok">Тарифный план создан</p>';
	} else {
		print '<p class="er">Заполните все поля</p>';
	}

}

?>
<FIELDSET style="border: solid #666666 1px; margin-bottom: 20px;">
<LEGEND><b>Действующие тарифные планы</b></LEGEND>

<table width="100%" align="center">
<?php
$result	= mysql_query("SELECT * FROM plans ORDER BY id ASC");
while($row = mysql_fetch_array($result)) {

print "<tr>
	<td><b>".$row['name']."</b><br />Сумма вклада: $".$row['minsum']." - $".$row['maxsum']." под ".$row['percent']."% в ";
	if($row['period'] == 1) { print "день"; } elseif($row['period'] == 2) { print "неделю"; } elseif($row['period'] == 3) { print "месяц"; } else { print "час"; }
print ", сроком ".$row['days'];
	if($row['period'] == 4) { print " часов"; } elseif($row['period'] == 1) { print " дней"; } elseif($row['period'] == 2) { print " недель"; } elseif($row['period'] == 3) { print " месяцев"; }
print "</td>
	<td width=\"20\"><a href=\"?a=plan_edit&id=".$row['id']."\"><img src=\"images/edit.gif\" width=\"20\" height=\"20\" border=\"0\" alt=\"Редактировать\" /></a></td><td width=\"20\"><a style=\"cursor:hand\" onclick=\"if(confirm('Вы действительно хотите удалить данный тарифный план?')) top.location.href='del/plans.php?id=".$row['id']."';\"><img src=\"images/delite.gif\" width=\"20\" height=\"20\" border=\"0\" alt=\"Удалить\" /></a></td></tr>
<tr>
	<td colspan=\"3\" height=\"1\" bgcolor=\"#cccccc\"></td>
</tr>";
}
?>
</table>
</FIELDSET>

<script language="JavaScript">
<!--
	function checkPeriod() {
		if(document.getElementById('period').value == '4') {
			document.getElementById("srok").innerHTML = "часов"
		} else if(document.getElementById('period').value == '1') {
			document.getElementById("srok").innerHTML = "дней"
		} else if(document.getElementById('period').value == '2') {
			document.getElementById("srok").innerHTML = "недель"
		} else if(document.getElementById('period').value == '3') {
			document.getElementById("srok").innerHTML = "месяцев"
		}
	}
//-->
</script>

<FIELDSET style="border: solid #666666 1px;">
<LEGEND><b>Создание тарифных планов</b></LEGEND>
<form action="?a=plans&action=add" method="post">
<table width="650" bgcolor="#eeeeee" align="center" border="0" style="border: solid #cccccc 1px;">
	<tr>
		<td width="50%"><font color="red"><b>!</b></font>Название:</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="name" size="80" maxlength="100" value="" /></td>
	</tr>
	<tr>
		<td><font color="red"><b>!</b></font>Минимальная сумма вклада:</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="minsum" size="80" maxlength="10" value="0.1" /></td>
	</tr>
	<tr>
		<td>Максимальная сумма вклада:</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="maxsum" size="80" maxlength="10" value="0" /></td>
	</tr>
	<tr>
		<td><font color="red"><b>!</b></font>Процент:</td>
		<td align="right"><input class="inp" style="width: 325px;" type="text" name="percent" size="80" maxlength="5" value="" /><select class="input" name="period" id="period" onChange="checkPeriod();">
			<option value="4">В час</option>
			<option value="1" selected>В день</option>
			<option value="2">В неделю</option>
			<option value="3">В месяц</option>
		</select></td>
	</tr>
	<tr>
		<td><font color="red"><b>!</b></font>Срок (<span id="srok">дней</span>):</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="days" size="80" maxlength="10" value="" /></td>
	</tr>
	<tr>
		<td>Бонус к сумме депозита (%):</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="bonusdeposit" size="80" maxlength="10" value="0.00" /></td>
	</tr>
	<tr>
		<td>Бонус на баланс от суммы депозита (%):</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="bonusbalance" size="80" maxlength="10" value="0.00" /></td>
	</tr>
	<tr>
		<td align="right"><input class="check" type="checkbox" name="back" value="1" /></td>
		<td><b>Возврат вклада вконце срока</b></td>
	</tr>
</table>
<table align="center" width="660" border="0">
	<tr>
		<td align="right"><input type="image" src="images/save.gif" width="28" height="29" border="0" title="Сохранить!" /></td>
	</tr>
</table>
</form>
</FIELDSET>