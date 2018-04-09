<?php

defined('ACCESS') or die();
if($_GET['action'] == "edit") {

	$name			= htmlspecialchars($_POST['name'], ENT_QUOTES);
	$minsum			= sprintf("%01.2f", $_POST['minsum']);
	$maxsum			= sprintf("%01.2f", $_POST['maxsum']);
	$percent		= sprintf("%01.2f", $_POST['percent']);
	$period			= intval($_POST['period']);
	$days			= intval($_POST['days']);
	$back			= intval($_POST['back']);
	$bonusdeposit	= sprintf("%01.2f", $_POST['bonusdeposit']);
	$bonusbalance	= sprintf("%01.2f", $_POST['bonusbalance']);

	if($name && $minsum && $percent && $days) {

	mysql_query("UPDATE plans SET back = ".$back.", name = '".$name."', minsum = ".$minsum.", maxsum = ".$maxsum.", percent = ".$percent.", period = ".$period.", days = ".$days.", bonusdeposit = ".$bonusdeposit.", bonusbalance = ".$bonusbalance." WHERE id = ".intval($_GET['id'])." LIMIT 1");

	print "<p class=\"erok\">Новые данные сохранены!</p>";

	} else {
		print '<p class="er">Заполните все поля</p>';
	}
}

$get_terif = mysql_query("SELECT * FROM plans WHERE id = ".intval($_GET['id'])." LIMIT 1");
$row = mysql_fetch_array($get_terif);
?>
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
<LEGEND><b>Редактирование тарифного плана</b></LEGEND>
<form action="?a=plan_edit&action=edit&id=<?php print intval($_GET['id']); ?>" method="post">
<table width="650" bgcolor="#eeeeee" align="center" border="0" style="border: solid #cccccc 1px;">
	<tr>
		<td width="50%"><font color="red"><b>!</b></font>Название:</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="name" size="80" maxlength="100" value="<?php print $row['name']; ?>" /></td>
	</tr>
	<tr>
		<td><font color="red"><b>!</b></font>Минимальная сумма вклада:</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="minsum" size="80" maxlength="10" value="<?php print $row['minsum']; ?>" /></td>
	</tr>
	<tr>
		<td>Максимальная сумма вклада:</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="maxsum" size="80" maxlength="10" value="<?php print $row['maxsum']; ?>" /></td>
	</tr>
	<tr>
		<td><font color="red"><b>!</b></font>Процент:</td>
		<td align="right"><input class="inp" style="width: 325px;" type="text" name="percent" size="80" maxlength="5" value="<?php print $row['percent']; ?>" /><select class="input" name="period" id="period" onChange="checkPeriod();"><option value="4"<?php if($row['period'] == 4) { print " selected"; } ?>>В час</option><option value="1"<?php if($row['period'] == 1) { print " selected"; } ?>>В день</option><option value="2"<?php if($row['period'] == 2) { print " selected"; } ?>>В неделю</option><option value="3"<?php if($row['period'] == 3) { print " selected"; } ?>>В месяц</option></select></td>
	</tr>
	<tr>
		<td><font color="red"><b>!</b></font>Срок (<span id="srok"><?php if($row['period'] == 4) { print "часов"; } elseif($row['period'] == 1) { print "дней"; } elseif($row['period'] == 2) { print "недель"; } elseif($row['period'] == 3) { print "месяцев"; } ?></span>):</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="days" size="80" maxlength="10" value="<?php print $row['days']; ?>" /></td>
	</tr>
	<tr>
		<td>Бонус к сумме депозита (%):</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="bonusdeposit" size="80" maxlength="10" value="<?php print $row['bonusdeposit']; ?>" /></td>
	</tr>
	<tr>
		<td>Бонус на баланс от суммы депозита (%):</td>
		<td align="right"><input class="inp" style="width: 400px;" type="text" name="bonusbalance" size="80" maxlength="10" value="<?php print $row['bonusbalance']; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><input class="check" type="checkbox" name="back" value="1"<?php if($row['back']) { print " checked"; } ?> /></td>
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