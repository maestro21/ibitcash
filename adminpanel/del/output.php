<?php
/*
Данный скрипт разработан Михайленко Виктором Леонидовичем, далее автор.
Любое использование данного скрипта, разрешено только с письменного согласия автора.
Скрипт защещён законом: http://adminstation.ru/images/docs/doc1.jpg
Дата разработки: 4.11.2008 г.

-> Файл удаления заявки на вывод средств
*/

include "../../cfg.php";
include "../../ini.php";

if ($status == 1) {
	if ($_GET['id']) {
		//$sql = 'DELETE FROM output WHERE `id` = '.$_GET['id'].' LIMIT 1';
		$sql = "UPDATE output SET status = 3 WHERE id = ".$_GET['id']." LIMIT 1";
		if (mysql_query($sql)) {
			$oid=$_GET['id'];
			$sql1=mysql_query("SELECT * FROM output WHERE id ='$oid'");
						$lg=mysql_result($sql1,0,'login');
			$sql_us=mysql_query("SELECT * FROM users WHERE login='$lg'");
			$ps=mysql_result($sql1,0,'paysys');
			$sum=mysql_result($sql1,0,'sum');
			switch ($ps)
			{
				case 3:
						$cur_sum=mysql_result($sql_us,0,'btc');
						$sum1=$cur_sum+$sum;
						mysql_query("UPDATE users SET btc = '$sum1' WHERE login = '$lg'");
						break;
				case 4:
						$cur_sum=mysql_result($sql_us,0,'dgc');
						$sum1=$cur_sum+$sum;
						mysql_query("UPDATE users SET dgc = '$sum1' WHERE login = '$lg'");
						break;
				case 5:
						$cur_sum=mysql_result($sql_us,0,'ltc');
						$sum1=$cur_sum+$sum;
						mysql_query("UPDATE users SET ltc = '$sum1' WHERE login = '$lg'");
						break;
				case 6:
						$cur_sum=mysql_result($sql_us,0,'dsh');
						$sum1=$cur_sum+$sum;
						mysql_query("UPDATE users SET dsh = '$sum1' WHERE login = '$lg'");
						break;
				case 7:
						$cur_sum=mysql_result($sql_us,0,'mnr');
						$sum1=$cur_sum+$sum;
						mysql_query("UPDATE users SET mnr = '$sum1' WHERE login = '$lg'");
						break;
				case 8:
						$cur_sum=mysql_result($sql_us,0,'eth');
						$sum1=$cur_sum+$sum;
						mysql_query("UPDATE users SET eth = '$sum1' WHERE login = '$lg'");
						break;
			}
					?><script>top.location.href='../adminstation.php?a=edit';</script><?
		} else {
			echo "<html><head><script>alert('Не удаётся удалить запись!'); top.location.href='../adminstation.php?a=edit';</script></head></html>";
		}
	} else {
		echo "<html><head><script>alert('Не указана запись!'); top.location.href='../adminstation.php?a=edit';</script></head></html>";
	}
}
?>