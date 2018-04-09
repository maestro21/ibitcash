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
/*
Данный скрипт разработан Михайленко Виктором Леонидовичем, далее автор.
Любое использование данного скрипта, разрешено только с письменного согласия автора.
Скрипт защещён законом: http://adminstation.ru/images/docs/doc1.jpg
Дата разработки: 21.09.2008 г.

-> Редактирование данных пользователя
*/
defined('ACCESS') or die();
if($_GET[action] == "add") {
	$pass		= $_POST['pass'];
	$repass		= $_POST['re_pass'];
	$mail		= htmlspecialchars($_POST['mail'], ENT_QUOTES);
	$ul			= htmlspecialchars($_POST['ul'], ENT_QUOTES);
	$com		= htmlspecialchars($_POST['com'], ENT_QUOTES);
	$lr			= htmlspecialchars($_POST['lr'], ENT_QUOTES);
	$pm			= htmlspecialchars($_POST['pm'], ENT_QUOTES);
	 $cld		= htmlspecialchars($_POST['cloud'], ENT_QUOTES);
	$btc		= htmlspecialchars($_POST['btc'], ENT_QUOTES);
	$dgc		= htmlspecialchars($_POST['dgc'], ENT_QUOTES);
	$ltc		= htmlspecialchars($_POST['ltc'], ENT_QUOTES);
	$dsh		= htmlspecialchars($_POST['dsh'], ENT_QUOTES);
	$mnr		= htmlspecialchars($_POST['mnr'], ENT_QUOTES);
	$eth		= htmlspecialchars($_POST['eth'], ENT_QUOTES);
	$pin		= htmlspecialchars($_POST['pin'], ENT_QUOTES);
	$bdgc		= htmlspecialchars($_POST['bdgc'], ENT_QUOTES);
	$beth		= htmlspecialchars($_POST['beth'], ENT_QUOTES);
	if($pass && $repass) {

		if($pass == $repass) {
			mysql_query('UPDATE users SET pass = "'.as_md5($key, $pass).'" WHERE id = '.intval($_GET[id]).' LIMIT 1');
			print "<font color=\"green\">1. Пароль изменён!</font><br />";
		} else {
			print "<font color=\"red\">1. Пароль не изменён, из-за несовпадения введённых паролей!</font><br />";
		}

	} else {
		print "<font color=\"blue\">1. Пароль остался преждним!</font><br />";
	}

	if($mail) {
		if(!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is",$mail)) {
			print "<font color=\"red\">2. Введите правильный e-mail!</font><br />";
		} else {
			$cld		= $_POST['cloud'];
			$rm		= $_POST['rm'];
			$btc		= $_POST['btc'];
			$dgc		= $_POST['dgc'];
			$ltc		= $_POST['ltc'];
			$dsh		= $_POST['dsh'];
			$mnr		= $_POST['mnr'];
			$eth		= $_POST['eth'];
			$cid=intval($_GET['id']);
			mysql_query("UPDATE users SET pin='$pin', mail = '$mail', ref_money='$rm', comment = '$com', cloud = '$cld', btc = '$btc', dgc = '$dgc', bdgc = '$bdgc', beth = '$beth', ltc = '$ltc', dsh = '$dsh', mnr = '$mnr', eth = '$eth' WHERE id = '$cid)' LIMIT 1");
			print "<font color=\"green\">2. Данные сохранены!</font><br />";

		}
	} else {
		print "<font color=\"red\">2. Не заполнены все поля!</font><br />";
	}
}

if($_GET[action] == "mailto") {

$subject	= $_POST['subject'];
$msg		= $_POST['msg'];

	$query	= "SELECT mail FROM users WHERE id = ".intval($_GET[id])." LIMIT 1";
	$result	= mysql_query($query);
	$row	= mysql_fetch_array($result);
	$mail	= $row['mail'];

	$headers = "From: ".$adminmail."\n";
	$headers .= "Reply-to: ".$adminmail."\n";
	$headers .= "X-Sender: < http://".$cfgURL." >\n";
	$headers .= "Content-Type: text/html; charset=windows-1251\n";

	mail($mail, $subject, $msg, $headers);

	print "<p class=\"erok\">Сообщение отправлено</p>";

}

$get_user = mysql_query("SELECT * FROM users WHERE id = ".intval($_GET['id'])." LIMIT 1");
$rows = mysql_fetch_array($get_user);
 $email		= $rows['mail'];
  $rm		= $rows['ref_money'];
 $cld		= $rows['cloud'];
 $btc		= $rows['btc'];
 $dgc		= $rows['dgc'];
 $ltc		= $rows['ltc'];
 $dsh		= $rows['dsh'];
 $mnr		= $rows['mnr'];
 $eth		= $rows['eth'];
 $com		= $rows['comment'];
 $pin		= $rows['pin'];
 $beth		= $rows['beth'];
 $bdgc		= $rows['bdgc'];
?>
<FIELDSET style="border: solid #666666 1px; padding: 10px;">
<LEGEND><b>Редактирование данных пользователя</b></LEGEND>
<form action="?a=edit_user&id=<?php print intval($_GET['id']); ?>&action=add" method="post">
<input type="hidden" name="ul" value="<?php print $rows['login']; ?>" />
<table align="center" width="612" border="0" cellpadding="3" cellspacing="0" style="border: solid #cccccc 1px;">
<tr bgcolor="#dddddd">
	<td><b>Пароль</b>:</td>
	<td align="right"><input class="inp" style="background-color: #dddddd; width: 480px;" type="password" name="pass" size="70" maxlength="50" value="" /></td>
</tr>
<tr bgcolor="#eeeeee">
	<td><b>Пароль</b> <small>[повторно]</small>:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="password" name="re_pass" size="70" maxlength="50" value="" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><font color="red"><b>!</b></font> <b>E-mail</b>:</td>
	<td align="right"><input class="inp" style="background-color: #dddddd; width: 480px;" type="text" name="mail" size="70" maxlength="30" value="<?php print $email; ?>" /></td>
</tr>
<tr bgcolor="#eeeeee">
	<td><b>Комментарий</b>:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="com" size="70" maxlength="150" value="<?php print $com; ?>" /></td>
</tr>
<tr bgcolor="#eeeeee">
	<td><b>PIN</b>:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="pin" size="70" maxlength="150" value="<?php print $pin; ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>Cloud</b> [<?php echo $cld; ?>]:</td>
	<td align="right"><input class="inp" style="background-color: #dddddd; width: 480px;" type="text" name="cloud" size="70" maxlength="30" value="<?php echo $cld; ?>" /></td>
</tr>
<tr bgcolor="#eeeeee">
	<td><b>Баланс btc</b> [<?php echo $btc; ?>]:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="btc" size="70" maxlength="30" value="<?php echo $btc; ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>Баланс dgc</b> [<?php echo $dgc; ?>]:</td>
	<td align="right"><input class="inp" style="background-color: #dddddd; width: 480px;" type="text" name="dgc" size="70" maxlength="30" value="<?php echo $dgc; ?>" /></td>
</tr>
<tr bgcolor="#eeeeee">
	<td><b>Баланс ltc</b> [<?php echo $ltc; ?>]:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="ltc" size="70" maxlength="30" value="<?php echo $ltc; ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>Баланс dsh</b> [<?php echo $dsh; ?>]:</td>
	<td align="right"><input class="inp" style="background-color: #dddddd; width: 480px;" type="text" name="dsh" size="70" maxlength="30" value="<?php echo $dsh; ?>" /></td>
</tr>
<tr bgcolor="#eeeeee">
	<td><b>Баланс mnr</b> [<?php echo $mnr; ?>]:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="mnr" size="70" maxlength="30" value="<?php echo $mnr; ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>Баланс eth</b> [<?php echo $eth; ?>]:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="eth" size="70" maxlength="30" value="<?php echo $eth; ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>Бонусный счёт ДОГЕ</b> [<?php echo $bdgc; ?>]:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="bdgc" size="70" maxlength="30" value="<?php echo $bdgc; ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>Бонусный счёт ЭФИР</b> [<?php echo $beth; ?>]:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="beth" size="70" maxlength="30" value="<?php echo $beth; ?>" /></td>
</tr>
<tr bgcolor="#dddddd">
	<td><b>Реферальные начисления</b> [<?php echo $rm; ?>]:</td>
	<td align="right"><input class="inp" style="width: 480px;" type="text" name="rm" size="70" maxlength="30" value="<?php echo $rm; ?>" /></td>
</tr>
</table>
<table align="center" width="624" border="0">
	<tr>
		<td align="right"><input type="image" src="images/save.gif" width="28" height="29" border="0" title="Сохранить!" /></td>
	</tr>
</table>
</form>
</FIELDSET>

<script type="text/javascript" src="editor/tiny_mce_src.js"></script>
<script type="text/javascript">
	tinyMCE.init({

		mode : "exact",
		elements : "elm1",
		theme : "advanced",
		plugins : "cyberfm,safari, inlinepopups,advlink,advimage,advhr,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
		language: "ru",
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,sub,sup,|,justifyleft,justifycenter,justifyright,justifyfull,hr,|,forecolor,backcolor,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "pasteword,|,bullist,numlist,|,link,image,media,|,tablecontrols,|,replace,charmap,cleanup,fullscreen,preview,code",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		content_css : "/files/styles.css",

		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<FIELDSET style="border: solid #666666 1px;">
<LEGEND><b>Отправка сообщения пользователю</b></LEGEND>
<form action="?a=edit_user&id=<?php print intval($_GET['id']); ?>&action=mailto" method="post" name="mainForm">
<table bgcolor="#eeeeee" width="612" align="center" border="0" style="border: solid #cccccc 1px; width: 612px;">
<tr><td align="center"><input class="inp" style=" width: 606px;" size="97" name="subject" value="Сообщение от администратора проекта <?php print $cfgURL; ?>" type="text" maxlength="100"></td></tr>
<tr><td align="center" style="padding-bottom: 10px;"><textarea id="elm1" style="width: 605px;" name="msg" cols="103" rows="20"></textarea>
</td></tr>
</table>
<table align="center" width="624" border="0">
	<tr>
		<td align="right"><input type="image" src="images/save.gif" width="28" height="29" border="0" title="Отправить!" /></td>
	</tr>
</table>
</form>
</FIELDSET>