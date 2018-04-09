<form method=post action='?a=payment&action=3'>
<input type=hidden name='id' value=<?echo $_GET['id']?>>
<input type=hidden name='l' value=<?echo $_GET['l']?>>
<input type=text name='sum' value='0.00'> - Сумма пополнения
<br>
<input type=submit value='Оплачено'>
</form>
<?if($_GET['action'] == 3) {
	$id = $_POST['id'];
	$log= $_POST['l'];
	$money=number_format($_POST['sum'], 8, '.', '');
	$sql_st=mysql_query("SELECT * FROM tb_srv_stats WHERE 1");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');	
	$query_res = mysql_query("SELECT * FROM enter WHERE id='$id'");
	$sql_u=mysql_query("SELECT * FROM users WHERE login='$log'");
	$ps=mysql_result($query_res,0,'paysys');
	switch ($ps)
	{
		case "Bitcoin":
		$c_btc=mysql_result($sql_u,0,'btc');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_btc;
		mysql_query("UPDATE users SET btc = '$c_btc' WHERE login='$log'");

		break;
		case "Dogecoin":
		$c_btc=mysql_result($sql_u,0,'dgc');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_dgc;
		mysql_query("UPDATE users SET dgc = '$c_btc' WHERE login='$log'");
		break;
		case "Litecoin":
		$c_btc=mysql_result($sql_u,0,'ltc');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_ltc;
		mysql_query("UPDATE users SET ltc = '$c_btc' WHERE login='$log'");
		break;
		case "Dash":
		$c_btc=mysql_result($sql_u,0,'dsh');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_dsh;
		mysql_query("UPDATE users SET dsh = '$c_btc' WHERE login='$log'");
		break;
		case "Monero":
		$c_btc=mysql_result($sql_u,0,'mnr');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_mnr;
		mysql_query("UPDATE users SET mnr = '$c_btc' WHERE login='$log'");
		break;
		case "Ethereum":
		$c_btc=mysql_result($sql_u,0,'eth');
		$c_btc=$c_btc+$money;
		$enter=$money*$price_eth;
		mysql_query("UPDATE users SET eth = '$c_btc' WHERE login='$log'");
		break;		
	}
	$t=time();
		mysql_query("UPDATE enter SET status = 2, sum = '$money', date='$t' WHERE id = '$id'");
		mysql_query("UPDATE users SET sum_enter=sum_enter+'$enter' WHERE login='$log'");
		echo 'USER '.$log.' recieved '.$money.' for his '.$ps.' wallet.';

}?>