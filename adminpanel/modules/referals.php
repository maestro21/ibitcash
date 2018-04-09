<table border="0" align="center" width="100%" cellpadding="1" cellspacing="1" bgcolor="#547898">
<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
	<td width="50"><b>#</b></td>
	<td align="left"><b>Login:</b></td>
	<td width="150"><b>Баланс:</b></td>
	<td width="150"><b>Доход $:</b></td>
</tr>
<?php
defined('ACCESS') or die();
	$sql	= 'SELECT * FROM users WHERE ref = '.intval($_GET[id]);
	$rs		= mysql_query($sql);
	if(mysql_num_rows($rs)) {

		$i = 1;
		$m = 0;
		while($a = mysql_fetch_array($rs)) {
			$money = $a['ref_money'];
			print "<tr bgcolor=\"#ffffff\" align=\"center\"><td>".$i."</td><td align=\"left\">".$a['login']."</td><td>".$a[balance]."</td><td>".sprintf("%01.4f", $money)."</td></tr>";
			$m = $m + $money;
			$i++;
		}
print "<tr align=\"center\" bgcolor=\"#dddddd\">
	<td align=\"right\" colspan=\"3\"><b>Всего:</b></td>
	<td><b>".sprintf("%01.4f", $m)."</b></td>
</tr>";
	} else {
		print "<tr bgcolor=\"#ffffff\"><td colspan=\"4\" align=\"center\">Пользователь пока никого не пригласил!</td></tr>";
	}
print "</table>";
?>