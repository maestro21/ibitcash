<?php
defined('ACCESS') or die();
// ��������� ��������
if(cfgSET('autopercent') == "on" && cfgSET('datestart') < time()) {

	// ����������� ��������

	$result	= mysql_query("SELECT * FROM `deposits` WHERE nextdate <= ".time());
	while($row = mysql_fetch_array($result)) {

		// �������� ������ � �������� �����
		$result2	= mysql_query("SELECT * FROM plans WHERE id = ".$row['plan']." LIMIT 1");
		$row2		= mysql_fetch_array($result2);

		$p			= sprintf("%01.2f", $row['sum'] / 100 * $row2['percent']);	// ����������

			// ��������� �� ������
			if($row['paysys'] == 1) {
				mysql_query('UPDATE users SET pm_balance = pm_balance + '.$p.' WHERE id = '.$row['user_id'].' LIMIT 1');
			} elseif($row['paysys'] == 2) {
				mysql_query('UPDATE users SET lr_balance = lr_balance + '.$p.' WHERE id = '.$row['user_id'].' LIMIT 1');
			}

			// ������ � ����������
			mysql_query('INSERT INTO stat (user_id, date, plan, sum, paysys) VALUES ('.$row['user_id'].', '.$row['nextdate'].', '.$row['plan'].', '.$p.', '.$row['paysys'].')');

			// ��������� ��������� �� ����������
			if(intval($row['count'] + 1) >= $row2['days']) {

				if($row2['back'] == 1) {
					// ���� ������ ����� ������� ��������, �� ����� ������ �� ���� ������������
					if($row['paysys'] == 1) {
						mysql_query('UPDATE users SET pm_balance = pm_balance + '.$row['sum'].' WHERE id = '.$row['user_id'].' LIMIT 1');
					} elseif($row['paysys'] == 2) {
						mysql_query('UPDATE users SET lr_balance = lr_balance + '.$row['sum'].' WHERE id = '.$row['user_id'].' LIMIT 1');
					}
					mysql_query("DELETE FROM deposits WHERE id = ".$row['id']." LIMIT 1");
				} else {
					// ������ ������� �������
					mysql_query("DELETE FROM deposits WHERE id = ".$row['id']." LIMIT 1");
				}

			} else {
				// ��������� ��������� ����
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
// ��������� ���������
?>