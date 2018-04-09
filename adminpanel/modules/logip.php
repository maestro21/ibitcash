<?php
defined('ACCESS') or die();
?>
<form action="adminstation.php" method="get">
<FIELDSET style="border: solid #666666 1px; padding: 10px;">
<LEGEND><b>Показать лог авторизации IP</b></LEGEND>
<input type="hidden" name="a" value="logip" />
<table width="100%" border="0">
	<tr>
		<td width="60"><strong>USER ID:</strong></td>
		<td><input class="inp" style="background-color: #ffffff; width: 625px;" type="text" name="id" size="93" /></td>
		<td align="center"><input type="image" src="images/search.gif" width="28" height="29" border="0" title="Поиск!" /></td>
	</tr>
</table>
</FIELDSET>
</form>

<hr />

<form action="adminstation.php" method="get">
<FIELDSET style="border: solid #666666 1px; padding: 10px;">
<LEGEND><b>Показать пользователей с  данным IP</b></LEGEND>
<input type="hidden" name="a" value="logip" />
<table width="100%" border="0">
	<tr>
		<td width="60"><strong>IP:</strong></td>
		<td><input class="inp" style="background-color: #ffffff; width: 625px;" type="text" name="ip" size="93" /></td>
		<td align="center"><input type="image" src="images/search.gif" width="28" height="29" border="0" title="Поиск!" /></td>
	</tr>
</table>
</FIELDSET>
</form>

<hr />

<?php

if($_GET[ip]) {

?>

<table width="100%" align="center" cellpadding="1" cellspacing="1" border="0" bgcolor="#eeeeee">
<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
	<td><strong>Дата</strong></td>
	<td><strong>IP</strong></td>
	<td><strong>ID</strong></td>
	<td><strong>Логин</strong></td>
</tr>
<?php

$idlist = "";

$sql	 = "SELECT * FROM logip WHERE ip = '".$_GET[ip]."' ORDER BY id DESC";
$rs		 = mysql_query($sql);
while($a = mysql_fetch_array($rs)) {

$sql2	= 'SELECT * FROM users WHERE id = '.$a['user_id'].' LIMIT 1';
$rs_u	= mysql_query($sql2);
$a2		= mysql_fetch_array($rs_u);

if(!substr_count($idlist, "|".$a['user_id']."|")) {

print "<tr bgcolor=\"#ffffff\" align=\"center\">
	<td>".date("d.m.Y H:i:s", $a['date'])."</td>
	<td>".$a['ip']."</td>
	<td>".$a['user_id']."</td>
	<td><a href=\"?a=edit_user&id=".$a['user_id']."\">".$a2['login']."</a></td>
</tr>";

$idlist .= "|".$a['user_id']."|";

}

}

?>
</table>

<?php
} elseif($_GET[id]) {
?>

<table width="100%" align="center" cellpadding="1" cellspacing="1" border="0" bgcolor="#eeeeee">
<tr align="center" height="19" style="background:URL(images/menu.gif) repeat-x top left;">
	<td width="50%"><strong>Дата</strong></td>
	<td><strong>IP</strong></td>
</tr>
<?php
$sql	 = "SELECT * FROM logip WHERE user_id = ".intval($_GET[id])." ORDER BY id DESC";
$rs		 = mysql_query($sql);
while($a = mysql_fetch_array($rs)) {
print "<tr bgcolor=\"#ffffff\" align=\"center\">
	<td>".date("d.m.Y H:i:s", $a['date'])."</td>
	<td>".$a['ip']."</td>
</tr>";
}

?>
</table>

<?php
}
?>