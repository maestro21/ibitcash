<script language="javascript" type="text/javascript" src="files/alt.js"></script>
<?php

defined('ACCESS') or die();
?>
<table border="0" align="center" width="100%" cellpadding="1" cellspacing="1" bgcolor="#547898">
	<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
		<td width="40"><b>ID</b></td>
  		<td><b>Логин</b></td>
		<td width="90"><b>Баланс LR</b></td>
		<td width="90"><b>Баланс PM</b></td>
		<td width="90"><b>Реферальские</b></td>
		<td width="80"><b>Регистрация</b></td>
		<td width="110"><b>EDIT</b></td>
	</tr>
<?php
function users_list($query) {

	$result = mysql_query($query);
	$themes = mysql_num_rows($result);

	if (!$themes) {
		print '<tr><td colspan="7" align="center"><font color="#ffffff"><b>Пользователей нет.</b></font></td></tr>';
	} else {
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result)) {

		print "<tr bgcolor=\"#eeeeee\" align=\"center\">
		<td>".$row['id']."</td>
		<td align=\"left\"><a href=\"mailto:".$row['mail']."\"><b>".$row['login']."</b></a></td>
		<td>".$row['lr_balance']."</td>
		<td>".$row['pm_balance']."</td>
		<td>".$row['reftop']."</td>
		<td>".date("d.m.y H:i", $row['reg_time'])."</td>";

		print '<td><nobr><a href="?a=edit_user&id='.$row[id].'"><img src="images/edit_small.gif" width="12" height="12" border="0" alt="Редактировать"></a> <a href="?a=referals&id='.$row[id].'"><img src="images/partners.gif" width="12" height="12" border="0" alt="Привлечённые рефералы"></a> <a href="?a=logip&id='.$row[id].'"><img src="images/ip.gif" width="12" height="12" border="0" alt="Лог IP"></a></nobr></td></tr>';

		}
	}
	print "</table>";
}

$sql = "SELECT * FROM users ORDER BY reftop DESC LIMIT 100";
users_list($sql);
?>