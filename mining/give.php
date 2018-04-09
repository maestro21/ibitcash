<?
if($_POST['check']==1 OR $_POST['type']>0 AND $_POST['type']<8)
{
include '../cfg.php';
include '../ini.php';
//include_once "../sth.php";
if($login){
if(isset($_POST['type'])) {
$sql=mysql_query("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
$sql_st=mysql_query("SELECT * FROM tb_srv_stats LIMIT 1");
$price[1]=mysql_result($sql_st,0,'btc');
$price[2]=mysql_result($sql_st,0,'dgc');
$price[3]=mysql_result($sql_st,0,'ltc');
$price[4]=mysql_result($sql_st,0,'dsh');
$price[5]=mysql_result($sql_st,0,'mnr');
$price[6]=mysql_result($sql_st,0,'eth');
$price[7]=mysql_result($sql_st,0,'cloud');	 
$par[1]=mysql_result($sql_st,0,'param1');
$par[2]=mysql_result($sql_st,0,'param2');
$par[3]=mysql_result($sql_st,0,'param3');
$par[4]=mysql_result($sql_st,0,'param4');
$par[5]=mysql_result($sql_st,0,'param5');
$par[6]=mysql_result($sql_st,0,'param6');
$par[7]=mysql_result($sql_st,0,'param7');
$param=mysql_result($sql_st,0,'param'); 
$id=$user_id;
$sql_o=mysql_query("SELECT * FROM tb_orders WHERE id_owner='$user_id'");
$curstr[1]="btc=btc+";
$curstr[2]="dgc=dgc+";
$curstr[3]="ltc=ltc+";
$curstr[4]="dsh=dsh+";
$curstr[5]="mnr=mnr+";
$curstr[6]="eth=eth+";
$curstr[7]="cloud=cloud+";
	$type=intval($_POST['type']);
	$sql_o=mysql_query("SELECT * FROM tb_orders WHERE id_owner='$id'");
	$cm=mysql_result($sql,0,'cloud');
	$ct=time();
if(mysql_num_rows($sql_o)==0)
		{
		  if(mysql_query("INSERT INTO `tb_orders`(`id_owner`, `type`, `s_mount`, `s_time`, `curr`, `param`, `pre_sum`) VALUES ('$id','$type','$cm','$ct','$price[$type]','$par[$type]', '0')"))
		  {echo 'create query OK! ';}
		}
else
	{
			$t_o=mysql_result($sql_o,0,'type');
			$ls=mysql_result($sql_o,0,'pre_sum');
			$par[8]=mysql_result($sql_o,0,'param'); 
			$st=mysql_result($sql_o,0,'s_time');
			$sm=mysql_result($sql_o,0,'s_mount');
			$currency=mysql_result($sql_o,0,'curr');
			$result=$ls+$sm*(0.0000021839506173/$param*(time()-$st)*10/$currency)*$par[8];
			$query="UPDATE users SET ".$curstr[$t_o]."'".$result."' WHERE id='".$user_id."'";
			echo $query;
			if(mysql_query($query))
			{
			echo ' - OK! ';
			}
			mysql_query("DELETE FROM tb_orders WHERE id_owner='$user_id'");
		if($t_o!=$type)
		{
			if(mysql_query("INSERT INTO `tb_orders`(`id_owner`, `type`, `s_mount`, `s_time`, `curr`, `param`, `pre_sum`) VALUES ('$id','$type','$cm','$ct','$price[$type]','$par[$type]', '0')"))
			{echo 'recreate query OK! ';}
			}
	}
	}
	}
	}
?>
