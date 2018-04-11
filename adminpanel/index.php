<?php
/*


-> Страница с формой аторизации администратора (Главная)
*/
include "../cfg.php";
include "../ini.php";
if(($status == 1 || $status == 2) && $login) {
	print "<html><head><script language=\"javascript\">top.location.href='adminstation.php';</script></head><body><a href=\"adminstation.php\"><b>Enter</b></a></body></html>";
} else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="files/styles.css" rel="stylesheet">
<link href="files/favicon.ico" type="image/x-icon" rel="shortcut icon">
<title>Управление проектом Ibit</title>
</head>
<body bgcolor="#ffffff" style="background:URL(images/login.jpg) no-repeat right top; background-color: #ffffff;">
<table width="100%" height="100%">
<tr height="11">
	<td></td>
</tr>
<form action="login.php" method="post">
<input type="hidden" name="submit" value="go">
	<tr>
		<td align="center">
<?php
$error = intval($_GET['error']);
if($error == 1) {
	print "<p class=\"er\" style=\"width: 292px;\">Введите логин/пароль</p>";
} elseif($error == 2) {
	print "<p class=\"er\" style=\"width: 292px;\">Введите правильный логин/пароль</p>";
}

?>

			<table width="300" height="60" cellpadding="0" cellspacing="0" border="0" bgcolor="#eeeeee">
				<tr height="4">
					<td width="9"><img src="images/index_up_left.gif" width="9" height="4" border="0"></td>
					<td style="background:URL(images/index_bg.gif) repeat-x left bottom;"></td>
					<td width="9"><img src="images/index_up_right.gif" width="9" height="4" border="0"></td>
				</tr>
				<tr>
					<td style="background:URL(images/index_left_bg.gif) repeat-y right top;"></td>
					<td align="center">

						<table cellspacing="1" cellpadding="0" border="0">
							<tr>
								<td><input class="input" style="width: 130px;" type="text" name="login" size="20" maxlength="20" onblur="if (value == '') {value='Login'}" onfocus="if (value == 'Login') {value =''}" value="Login" /></td>
								<td width="100" style="background:URL(images/cookie.gif) no-repeat" valign="top"><input type="checkbox" name="cookies" value="1" /></td>
							</tr>
							<tr>
								<td><input class="input" style="width: 130px;" type="password" name="pass" size="20" maxlength="50" onblur="if (value == '') {value='password'}" onfocus="if (value == 'password') {value =''}" value="password" /></td>
								<td><input type="image" src="images/submit.gif" width="100" height="19" border="0" title="Войти в систему!" /></td>
							</tr>
						</table>

					</td>
					<td style="background:URL(images/index_right_bg.gif) repeat-y left top;"></td>
				</tr>
				<tr height="4">
					<td><img src="images/index_down_left.gif" width="9" height="4" border="0"></td>
					<td style="background:URL(images/index_bg.gif) repeat-x left top;"></td>
					<td><img src="images/index_down_right.gif" width="9" height="4" border="0"></td>
				</tr>
			</table>

		</td>
	</tr>
	</form>
	<tr height="25">
		<td align="center">
<font color="#999999">&copy; 2007 - <?php print date(Y); ?> CMS <a style="font-weight: normal;" href="<?php echo BASE_PATH;?>" target="_blank">ibit</a> v3.1.1 Все права защищены!<br />
Разработка компании информационных технологий <a style="font-weight: normal;" href="<?php echo BASE_PATH;?>" target="_blank">ibit</a></font>
		</td>
	</tr>
</table>
</body>
</html>
<?php } ?>