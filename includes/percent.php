<?php
defined('ACCESS') or die();
// НАЧИСЛЯЕМ ПРОЦЕНТЫ
if(cfgSET('autopercent') == "on" && cfgSET('datestart') < time()) {

	// Вытаскиваем депозиты

	$result	= mysql_query("SELECT * FROM `deposits` WHERE nextdate <= ".time());
	while($row = mysql_fetch_array($result)) {

		// Получаем данные о тарифном плане
		$result2	= mysql_query("SELECT * FROM plans WHERE id = ".$row['plan']." LIMIT 1");
		$row2		= mysql_fetch_array($result2);

		$p			= sprintf("%01.2f", $row['sum'] / 100 * $row2['percent']);	// процентики

			// Начисляем на баланс
			if($row['paysys'] == 1) {
				mysql_query('UPDATE users SET pm_balance = pm_balance + '.$p.' WHERE id = '.$row['user_id'].' LIMIT 1');
			} elseif($row['paysys'] == 2) {
				mysql_query('UPDATE users SET lr_balance = lr_balance + '.$p.' WHERE id = '.$row['user_id'].' LIMIT 1');
			}

			// Вносим в статистику
			mysql_query('INSERT INTO stat (user_id, date, plan, sum, paysys) VALUES ('.$row['user_id'].', '.$row['nextdate'].', '.$row['plan'].', '.$p.', '.$row['paysys'].')');

			// Проверяем последнее ли начисление
			if(intval($row['count'] + 1) >= $row2['days']) {

				if($row2['back'] == 1) {
					// Если вконце срока возврат депозита, то ложим деньги на счет пользователю
					if($row['paysys'] == 1) {
						mysql_query('UPDATE users SET pm_balance = pm_balance + '.$row['sum'].' WHERE id = '.$row['user_id'].' LIMIT 1');
					} elseif($row['paysys'] == 2) {
						mysql_query('UPDATE users SET lr_balance = lr_balance + '.$row['sum'].' WHERE id = '.$row['user_id'].' LIMIT 1');
					}
					mysql_query("DELETE FROM deposits WHERE id = ".$row['id']." LIMIT 1");
				} else {
					// Просто удаляем депозит
					mysql_query("DELETE FROM deposits WHERE id = ".$row['id']." LIMIT 1");
				}

			} else {
				// Вычисляем следующие даты
				if($row2['period'] == 1) {
					$nextdate = $row['nextdate'] + 86400;
				} elseif($row2['period'] == 2) {
					$nextdate = $row['nextdate'] + 604800;
				} elseif($row2['period'] == 3) {
					$nextdate = $row['nextdate'] + 2592000;
				} elseif($row2['period'] == 4) {
					$nextdate = $row['nextdate'] + 3600;
				}
				mysql_query('UPDATE deposits SET count = count + 1, lastdate = '.$row['nextdate'].', nextdate = '.$nextdate.' WHERE id = '.$row['id'].' LIMIT 1');
			}

	}
}
// Закончили начислять
?>