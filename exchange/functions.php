<?
include '../cfg.php';
include '../ini.php';	
if($login){
if(isset($_POST['exch'])) {
$id=$user_id;
$cv=intval($_POST['cv']);
$cv2=intval($_POST['cv2']);
$mn=str_replace(',', '.', $_POST['mn']);
$sql_st=mysql_query("SELECT * FROM tb_srv_stats");
$sql3=mysql_query("SELECT * FROM users WHERE id='$id'");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');	  
$btc=mysql_result($sql3,0,'btc');
$dgc=mysql_result($sql3,0,'dgc');
$bdgc=mysql_result($sql3,0,'bdgc');
$ltc=mysql_result($sql3,0,'ltc');
$dsh=mysql_result($sql3,0,'dsh');
$mnr=mysql_result($sql3,0,'mnr');
$eth=mysql_result($sql3,0,'eth');
$beth=mysql_result($sql3,0,'beth');
$cld=mysql_result($sql3,0,'cloud');	  
$refer=mysql_result($sql3,0,'ref');
switch($cv2){
	case 0:
		$tc=$price_cld;
		$fs='Cloud';
		$tm='cloud=cloud+';
		break;
	case 1:
		$tc=$price_btc;
		$fs='BITCOIN';
		$tm='btc=btc+';
		break;
	case 2:
		$tc=$price_dgc;
		$fs='DOGE';
		$tm='dgc=dgc+';
		break;
	case 3:
		$tc=$price_ltc;
		$fs='LITECOIN';
		$tm='ltc=ltc+';
		break;
	case 4:
		$tc=$price_dsh;
		$fs='RIPPLE';
		$tm='dsh=dsh+';
		break;
	case 5:
		$tc=$price_mnr;
		$fs='BITCOIN CASH';
		$tm='mnr=mnr+';
		break;
	case 6:
		$tc=$price_eth;
		$fs='ETHEREUM';
		$tm='eth=eth+';
		break;
}
switch($cv){
	case 1:
		$gc=$price_btc;
		$lim=$btc;
		$ls='BITCOIN';
		$gm='btc=btc-';
		break;
	case 2:
		$gc=$price_dgc;
		$lim=$dgc;
		if($cv2==0)
		{
		$lim+=$bdgc;
		}
		$ls='DOGE';
		$gm='dgc=dgc-';
		break;
	case 3:
		$gc=$price_ltc;
		$lim=$ltc;
		$ls='LITECOIN';
		$gm='ltc=ltc-';
		break;
	case 4:
		$gc=$price_dsh;
		$lim=$dsh;
		$ls='RIPPLE';
		$gm='dsh=dsh-';
		break;
	case 5:
		$gc=$price_mnr;
		$lim=$mnr;
		$ls='BITCOIN CASH';
		$gm='mnr=mnr-';
		break;
	case 6:
		$gc=$price_eth;
		$lim=$eth;
		if($cv2==0)
		{
		$lim+=$beth;
		}
		$ls='ETHEREUM';
		$gm='eth=eth-';
		break;
}
if($mn>0 AND $mn<=$lim)
{
	$t=time();
	$str=$ls.' -> '.$fs;
	if($cv2==0)
	{
		$ts=$mn*$gc/$tc;
		if($refer!=0)
		{	
			$sql_r=mysql_query("SELECT * FROM users WHERE id='$refer'");
			$rl=mysql_result($sql_r,0,'login');
			$rb=$ts*0.1;
			mysql_query("INSERT INTO refbonus (login,rlogin,date,sum) VALUES ('$rl','$login','$t','$rb')");
			mysql_query("UPDATE users SET cloud=cloud+'$rb' WHERE id='$refer'");
		}
		$query="UPDATE users SET ".$tm.$ts.", ".$gm.$mn." WHERE id='$id'";
		if($cv==6)
		{
			if($mn<=$beth)
			{
				$query="UPDATE users SET beth=beth-".$mn.", ".$tm.$ts." WHERE id='$id'";
			}
			else
			{
				$mn-=$beth;
				$query="UPDATE users SET eth=eth-".$mn.", beth=0, ".$tm.$ts." WHERE id='$id'";
			}
		}
		if($cv==2)
		{
			if($mn<=$bdgc)
			{
				$query="UPDATE users SET bdgc=bdgc-".$mn.", ".$tm.$ts." WHERE id='$id'";
			}
			else
			{
				$mn-=$bdgc;
				$query="UPDATE users SET dgc=dgc-".$mn.", bdgc=0, ".$tm.$ts." WHERE id='$id'";
			}
		}
	}
	else
	{
		$ts=$mn*$gc/$tc*0.85;
		$query="UPDATE users SET ".$tm.$ts.", ".$gm.$mn." WHERE id='$id'";
	}
	mysql_query($query);
	mysql_query("INSERT INTO exchange (login,date,sum,sumc,paysys) VALUES ('$login','$t','$mn','$ts','$str')");
	echo "OK";
	}
else
{
	echo 'NO';
}
}
}
?>