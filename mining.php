<?php

defined('ACCESS') or die();

if($login) {
?>
<p align="right">
	Показать:  <a href="?sort=1">Начисление %</a> | <a href="?sort=2">Открытие депозитов</a> | <a href="?sort=3">Пополнение счета</a> | <a href="?sort=4">Вывод</a> | <a href="?sort=5">Авторизации</a>
</p>
<?php
	if($_GET['sort'] == 2) {
		include "depo_ru.php";
	} elseif($_GET['sort'] == 3) {
		include "enter_ru.php";
	} elseif($_GET['sort'] == 4) {
		include "out_ru.php";
	} elseif($_GET['sort'] == 5) {
		include "auth_ru.php";
	} else {
		include "percent_ru.php";
	}

} else {
	print "<p class=\"er\">Для доступа к данной странице, вам необходимо авторизироваться!</p>";
}
?>