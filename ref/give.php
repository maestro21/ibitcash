<?
$hostname="mysql.hostinger.ru";					
$mysql_login= "u960338842_qwe";						
$mysql_password	= "123123";						
$database= "u960338842_qwe";					
$mysql_c=mysql_connect($hostname, $mysql_login , $mysql_password);
mysql_select_db($database,$mysql_c);	
		$sql_st=mysql_query("SELECT * FROM tb_srv_stats");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');	  
$param=mysql_result($sql_st,0,'param1');
if(isset($_POST['vals'])) {
$id=$_POST['id'];
$sql3=mysql_query("SELECT * FROM users WHERE id='$id'");
echo $login1;
$j2=mysql_result($sql3,0,'btc');
$j3=mysql_result($sql3,0,'dgc');
$j4=mysql_result($sql3,0,'ltc');
$j5=mysql_result($sql3,0,'dsh');
$j6=mysql_result($sql3,0,'mnr');
$j7=mysql_result($sql3,0,'eth');
$j8=mysql_result($sql3,0,'cloud');
echo $j1." ".$j2." ".$j3." ".$j4." ".$j5." ".$j6." ".$j7." ".$j8;
}
if(isset($_POST['type'])) {

		$id=$_POST['id'];
		$type=$_POST['type'];
		$sql=mysql_query("SELECT * FROM tb_orders WHERE id_owner='$id'");
		$sql2=mysql_query("SELECT * FROM users WHERE id='$id'");
		$cm=mysql_result($sql2,0,'cloud');
if(mysql_num_rows($sql)<1)
		  {
			  $ct=time();
			  $cm=mysql_result($sql2,0,'cloud');
			  mysql_query("INSERT INTO `tb_orders`(`id_owner`, `type`, `s_mount`, `s_time`) VALUES ('$id','$type','$cm','$ct')");
		  }
else
	{
		$t_o=mysql_result($sql,0,'type');
		if($t_o!=$type)
		{
			$ct=time();
			  $cm=mysql_result($sql2,0,'cloud');
			  mysql_query("INSERT INTO `tb_orders`(`id_owner`, `type`, `s_mount`, `s_time`) VALUES ('$id','$type','$cm','$ct')");
			  switch ($t_o) {
case 1:
			$cur_usd=mysql_result($sql2,0,'usd');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10;
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `usd`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
    break;
case 2:
			$cur_usd=mysql_result($sql2,0,'btc');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_btc;
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `btc`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
    break;
case 3:
			$cur_usd=mysql_result($sql2,0,'dgc');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_dgc;
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `dgc`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
    break;
	case 4:
			$cur_usd=mysql_result($sql2,0,'ltc');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_ltc;
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `ltc`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
    break;
	case 5:
			$cur_usd=mysql_result($sql2,0,'dsh');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_dsh;
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `dsh`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
    break;
	case 6:
			$cur_usd=mysql_result($sql2,0,'mnr');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_mnr;
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `mnr`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
    break;
	case 7:
			$cur_usd=mysql_result($sql2,0,'eth');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_eth;
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `eth`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
    break;
	case 8:
			$cur_usd=mysql_result($sql2,0,'cloud');
			$s_time=mysql_result($sql,0,'s_time');//57839506173
			$s_mount=mysql_result($sql,0,'s_mount'); //96399176,955
			$profit=$s_mount*0.0000000096399176955*(time()-$s_time);
			$sum=number_format(($cur_usd+$profit),8,',','');
			mysql_query("UPDATE `users` SET `cloud`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			echo number_format($profit,11);
    break;
}			$ct=time();
			  $cm=mysql_result($sql2,0,'cloud');
			  mysql_query("INSERT INTO `tb_orders`(`id_owner`, `type`, `s_mount`, `s_time`) VALUES ('$id','$type','$cm','$ct')");

		}
		if($t_o==1 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'usd');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10;
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `usd`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			
		}
				if($t_o==2 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'btc');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_btc;
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `btc`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			
		}
				if($t_o==3 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'dgc');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_dgc;
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `dgc`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			
		}
				if($t_o==4 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'ltc');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_ltc;
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `ltc`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			
		}
				if($t_o==5 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'dsh');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_dsh;
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `dsh`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			
		}
				if($t_o==6 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'mnr');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_mnr;
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `mnr`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			
		}
				if($t_o==7 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'eth');
			$s_time=mysql_result($sql,0,'s_time');
			$s_mount=mysql_result($sql,0,'s_mount');
			$profit=$s_mount*0.0000057839506173/$param*(time()-$s_time)*10/$price_eth;
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `eth`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			
		}
				if($t_o==8 AND $t_o==$type)
		{
			$cur_usd=mysql_result($sql2,0,'cloud');
			$s_time=mysql_result($sql,0,'s_time');//57839506173
			$s_mount=mysql_result($sql,0,'s_mount'); //96399176,955
			$profit=$s_mount*0.0000000096399176955*$param/6000*(time()-$s_time);
			$sum=$cur_usd+$profit;
			mysql_query("UPDATE `users` SET `cloud`='$sum' WHERE id='$id'");
			mysql_query("DELETE FROM `tb_orders` WHERE id_owner='$id'");
			echo number_format($profit,11);
			
		}
	}
	}
?>
