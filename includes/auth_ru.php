<?php
if(!$login) {
?>
	<table align="center" cellpadding="1" cellspacing="0">
	<form action="/login/" method="post">
	<tr>
		<td style="padding-left: 2px;">Логин</td>
		<td style="padding-left: 2px;">Пароль</td>
	</tr>
	<tr>
		<td><input type="text" name="user" size="13"></td>
		<td><input type="password" name="pass" size="13"></td>
	</tr>
	<tr>
		<td style="padding-left: 2px;"><a href="/registration/">Регистрация</a><br /><a href="/reminder/">Забыли пароль?</a></td>
		<td align="right"><input style="border: none;" type="image" src="/images/enter.gif" title="Войти" /></td>
	</tr>
	</form>
	</table>
	<hr />
<?php
} else {
    print "<p align=\"center\"><b>Добро пожаловать <b style=\"color: green\">".$login."</b>!</b><br /> Баланс: $<b>".$balance."</b></p>";
	print '<ul>';
	if($status == 1) {
		print '<li><a href="/adminpanel/"><b>Администратору</b></a></li>';
	}
	print '<li><a href="/enter/">Пополнить баланс</a></li>';
	print '<li><a href="/deposit/">Открыть депозит</a></li>';
	print '<li><a href="/deposits/">Ваши депозиты</a></li>';
	print '<li><a href="/withdrawal/">Вывести средства</a></li>';
	print '<li><a href="/ref/">Партнерская программа</a></li>';
	print '<li><a href="/stat/">Статистика</a></li>';
	print '<li><a href="/profile/">Ваш профиль</a></li>';
	print '<li><a href="/exit.php">Выход</a></li>';
	print '</ul>';
}
?>