<form action='?a=givebonus&give=1' method=post>
<table>
<tr>
<td>
Ник
</td>
<td>
<input type=text name='lg'>
</td>
</tr>
<tr>
<td>
Сумма
</td>
<td>
<input type=text name='sm'>
</td>
</tr>
<tr>
<td>
<p><input name="cur" type="radio" value="bdgc">DOGE</p>
</td>
<td>
<p><input name="cur" type="radio" value="beth">ETHEREUM</p>
</td>
</tr>
</table>
<p><input type="checkbox" name="all" value="5"> Дать всем</p>
<input type=submit value='Дать бонус'>
</form>
<?
if($_GET['give']==1)
{
	$sum=$_POST['sm'];
	$cur=$_POST['cur'];
	$t=time();
	if($_POST['all']==5)
	{	
		if($cur=='bdgc'){
			mysql_query("UPDATE users SET bdgc=bdgc+'$sum' WHERE status=0");
			$usql=mysql_query("SELECT * FROM users WHERE status=0");
			for($i=0;$i<mysql_num_rows($usql);$i++)
			{
				$login=mysql_result($usql,$i,'login');
				mysql_query("INSERT INTO enter (sum, date, login, paysys, status) VALUES ('$sum', '$t', '$login', 'BONUS Doge', 2)");
			}
		}else{
			mysql_query("UPDATE users SET beth=beth+'$sum' WHERE status=0");
			$usql=mysql_query("SELECT * FROM users WHERE status=0");
			for($i=0;$i<mysql_num_rows($usql);$i++)
			{
				$login=mysql_result($usql,$i,'login');
				mysql_query("INSERT INTO enter (sum, date, login, paysys, status) VALUES ('$sum', '$t', '$login', 'BONUS Ethereum', 2)");
			}
			
		}
	}
	else
	{
		$lg=$_POST['lg'];
		if($cur=='bdgc'){
			mysql_query("UPDATE users SET bdgc=bdgc+'$sum' WHERE login='$lg'");
			mysql_query("INSERT INTO enter (sum, date, login, paysys, status) VALUES ('$sum', '$t', '$login', 'BONUS Ethereum', 2)");
		}else{
			mysql_query("UPDATE users SET beth=beth+'$sum' WHERE login='$lg'");
			mysql_query("INSERT INTO enter (sum, date, login, paysys, status) VALUES ('$sum', '$t', '$login', 'BONUS Ethereum', 2)");
		}
	}
echo 'OK!';
}
?>