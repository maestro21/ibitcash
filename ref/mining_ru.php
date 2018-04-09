<script language="javascript" src="javascr.js"></script>
</script>
<style>
.btcsum{
	float:right;
}
</style>
<?
defined('ACCESS') or die();

if($login) {

$login1=$_SESSION['login'];
$sql=mysql_query("SELECT * FROM users WHERE login='$login1'");
$id=mysql_result($sql,0,'id');
$sql_o=mysql_query("SELECT * FROM tb_orders WHERE id_owner='$id'");
$sql_st=mysql_query("SELECT * FROM tb_srv_stats");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');
$param=mysql_result($sql_st,0,'param1');
?><script>val_Prices(<?echo $price_btc;?>,<?echo $price_dgc;?>,<?echo $price_ltc;?>,<?echo $price_dsh;?>,<?echo $price_mnr;?>,<?echo $price_eth;?>,<?echo $param;?>);</script><?
?><script>val_sum(<?echo $id?>);</script><?
$cur_usd=mysql_result($sql,0,'usd');
$cur_btc=mysql_result($sql,0,'btc');
$cur_dgc=mysql_result($sql,0,'dgc');
$cur_ltc=mysql_result($sql,0,'ltc');
$cur_dsh=mysql_result($sql,0,'dsh');
$cur_eth=mysql_result($sql,0,'eth');
$cur_mnr=mysql_result($sql,0,'mnr');
$cur_cld=mysql_result($sql,0,'cloud');
if(mysql_num_rows($sql_o)>0)
	{
		$type=mysql_result($sql_o,0,'type');
		$st_time=mysql_result($sql_o,0,'s_time');
		$st_mount=mysql_result($sql_o,0,'s_mount');
		$st_time=time()-$st_time;
				if ($type==2){
		?><script>btcIntervalW(<?echo $st_time;?>,<?echo $st_mount;?>,<?echo $cur_btc;?>);</script><?
		}
				if ($type==3){
		?><script>dgcIntervalW(<?echo $st_time;?>,<?echo $st_mount;?>,<?echo $cur_dgc;?>);</script><?
		}
				if ($type==4){
		?><script>ltcIntervalW(<?echo $st_time;?>,<?echo $st_mount;?>,<?echo $cur_ltc;?>);</script><?
		}
				if ($type==5){
		?><script>dshIntervalW(<?echo $st_time;?>,<?echo $st_mount;?>,<?echo $cur_dsh;?>);</script><?
		}
				if ($type==6){
		?><script>mnrIntervalW(<?echo $st_time;?>,<?echo $st_mount;?>,<?echo $cur_mnr;?>);</script><?
		}
				if ($type==7){
		?><script>ethIntervalW(<?echo $st_time;?>,<?echo $st_mount;?>,<?echo $cur_eth;?>);</script><?
		}
				if ($type==8){
		?><script>cldIntervalW(<?echo $st_time;?>,<?echo $st_mount;?>,<?echo $cur_cld;?>);</script><?
		}
	}
		$cur_usd=mysql_result($sql,0,'usd');
		$cur_id=mysql_result($sql,0,'id');
		$cur_cloud=mysql_result($sql,0,'cloud');
?>
		<table bgcolor="#DDDDDD" width=400 height=200 border=0>
		<tr>
		<td width=100 rowspan=5>
		<img src="Bitcoin.png">
		</td>
		<td width=200>
		<center>
		Bitcoin
		</center>
		</td>
		<td width=300>
		</td>
		<td width=100 rowspan=5>
		<input type=button value='Mining' onClick="btcInterval(<?echo $cur_cloud;?>,<?echo $cur_btc;?>,<?echo $cur_id;?>)";>
		</td>
		</tr>
		<tr>
		<td>
		&#1047;&#1072; &#1095;&#1072;&#1089;
		</td>
		<td style="float:right;">
		<?
		$i=($cur_cld*(0.0000057839506173*10/$param)*60*60)/$price_btc;
		echo number_format($i,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1062;&#1077;&#1085;&#1072;
		</td>
		<td style="float:right;">
		$<?echo number_format($price_btc,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1085;&#1086;
		</td>
		<td style="float:right;"><div id='btcsum'><?echo number_format($cur_btc,8,',','');?></div>
		</td>
		</tr>
		</table>
		<table bgcolor="#DDDDDD" width=400 height=200 border=0>
		<tr>
		<td width=100 rowspan=5>
		<img src="Dogecoin.png">
		</td>
		<td width=200>
		<center>
		Dogecoin
		</center>
		</td>
		<td width=300>
		</td>
		<td width=100 rowspan=5>
		<input type=button value='Mining' onClick="dgcInterval(<?echo $cur_cloud;?>,<?echo $cur_dgc;?>,<?echo $cur_id;?>)";>
		</td>
		</tr>
		<tr>
		<td>
		&#1047;&#1072; &#1095;&#1072;&#1089;
		</td>
		<td style="float:right;">
		<?
		$i=($cur_cld*(0.0000057839506173*10/$param)*60*60)/$price_dgc;
		echo number_format($i,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1062;&#1077;&#1085;&#1072;
		</td>
		<td style="float:right;">
		$<?echo number_format($price_dgc,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1085;&#1086;
		</td>
		<td style="float:right;"><div id='dgcsum'><?echo number_format($cur_dgc,8,',','');?></div>
		</td>
		</tr>
		</table>
								<table bgcolor="#DDDDDD" width=400 height=200 border=0>
		<tr>
		<td width=100 rowspan=5>
		<img src="Litecoin.png">
		</td>
		<td width=200>
		<center>
		Litecoin
		</center>
		</td>
		<td width=300>
		</td>
		<td width=100 rowspan=5>
		<input type=button value='Mining' onClick="ltcInterval(<?echo $cur_cloud;?>,<?echo $cur_ltc;?>,<?echo $cur_id;?>)";>
		</td>
		</tr>
		<tr>
		<td>
		&#1047;&#1072; &#1095;&#1072;&#1089;
		</td>
		<td style="float:right;">
		<?
		$i=($cur_cld*(0.0000057839506173*10/$param)*60*60)/$price_ltc;
		echo number_format($i,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1062;&#1077;&#1085;&#1072;
		</td>
		<td style="float:right;">
				$<?echo number_format($price_ltc,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1085;&#1086;
		</td>
		<td style="float:right;"><div id='ltcsum'><?echo number_format($cur_ltc,8,',','');?></div>
		</td>
		</tr>
		</table>
		<table bgcolor="#DDDDDD" width=400 height=200 border=0>
		<tr>
		<td width=100 rowspan=5>
		<img src="WMZ.png">
		</td>
		<td width=200>
		<center>
		Dash
		</center>
		</td>
		<td width=300>
		</td>
		<td width=100 rowspan=5>
		<input type=button value='Mining' onClick="dshInterval(<?echo $cur_cloud;?>,<?echo $cur_dsh;?>,<?echo $cur_id;?>)";>
		</td>
		</tr>
		<tr>
		<td>
		&#1047;&#1072; &#1095;&#1072;&#1089;
		</td>
		<td style="float:right;">
		<?
		$i=($cur_cld*(0.0000057839506173*10/$param)*60*60)/$price_dsh;
		echo number_format($i,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1062;&#1077;&#1085;&#1072;
		</td>
		<td style="float:right;">
				$<?echo number_format($price_dsh,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1085;&#1086;
		</td>
		<td style="float:right;"><div id='dshsum'><?echo number_format($cur_dsh,8,',','');?></div>
		</td>
		</tr>
		</table>
		<table bgcolor="#DDDDDD" width=400 height=200 border=0>
		<tr>
		<td width=100 rowspan=5>
		<img src="WMZ.png">
		</td>
		<td width=200>
		<center>
		Monero
		</center>
		</td>
		<td width=300>
		</td>
		<td width=100 rowspan=5>
		<input type=button value='Mining' onClick="mnrInterval(<?echo $cur_cloud;?>,<?echo $cur_mnr;?>,<?echo $cur_id;?>)";>
		</td>
		</tr>
		<tr>
		<td>
		&#1047;&#1072; &#1095;&#1072;&#1089;
		</td>
		<td style="float:right;">
		<?
		$i=($cur_cld*(0.0000057839506173*10/$param)*60*60)/$price_mnr;
		echo number_format($i,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1062;&#1077;&#1085;&#1072;
		</td>
		<td style="float:right;">
				$<?echo number_format($price_mnr,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1085;&#1086;
		</td>
		<td style="float:right;"><div id='mnrsum'><?echo number_format($cur_mnr,8,',','');?></div>
		</td>
		</tr>
		</table>
		<table bgcolor="#DDDDDD" width=400 height=200 border=0>
		<tr>
		<td width=100 rowspan=5>
		<img src="WMZ.png">
		</td>
		<td width=200>
		<center>
		Ethereum
		</center>
		</td>
		<td width=300>
		</td>
		<td width=100 rowspan=5>
		<input type=button value='Mining' onClick="ethInterval(<?echo $cur_cloud;?>,<?echo $cur_eth;?>,<?echo $cur_id;?>)";>
		</td>
		</tr>
		<tr>
		<td>
		&#1047;&#1072; &#1095;&#1072;&#1089;
		</td>
		<td style="float:right;">
		<?
		$i=($cur_cld*(0.0000057839506173*10/$param)*60*60)/$price_eth;
		echo number_format($i,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1062;&#1077;&#1085;&#1072;
		</td>
		<td style="float:right;">
				$<?echo number_format($price_eth,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1085;&#1086;
		</td>
		<td style="float:right;"><div id='ethsum'><?echo number_format($cur_eth,8,',','');?></div>
		</td>
		</tr>
		</table>
								<table bgcolor="#DDDDDD" width=400 height=200 border=0>
		<tr>
		<td width=100 rowspan=3>
		<img src="CLD.png">
		</td>
		<td width=200>
		<center>
		CLD
		</center>
		</td>
		<td width=300>
		</td>
		<td width=100 rowspan=5>
		<input type=button value='Mining' onClick="cldInterval(<?echo $cur_cloud;?>,<?echo $cur_cld;?>,<?echo $cur_id;?>)";>
		</td>
		</tr>
		<tr>
		<td>
		&#1062;&#1077;&#1085;&#1072;
		</td>
		<td style="float:right;">
		$<?echo number_format($price_cld,8,',','');?>
		</td>
		</tr>
		<tr>
		<td>
		&#1044;&#1086;&#1089;&#1090;&#1091;&#1087;&#1085;&#1086;
		</td>
		<td style="float:right;"><div id='cldsum'><?echo number_format($cur_cld,8,',','');?></div>
		</td>
		</tr>
		</table>
		
		<??><script language="javascript">	  usd0=document.getElementById("usdsum").innerHTML;
	  usd11=document.getElementById("btcsum").innerHTML;
	  usd22=document.getElementById("dgcsum").innerHTML;
	  usd33=document.getElementById("ltcsum").innerHTML;
	  usd44=document.getElementById("dshsum").innerHTML;
	  usd55=document.getElementById("mnrsum").innerHTML;
	  usd66=document.getElementById("ethsum").innerHTML;
	  usd77=document.getElementById("cldsum").innerHTML;</script><?
		}
 else {
	print "<p class=\"er\">&#1044;&#1083;&#1103; &#1076;&#1086;&#1089;&#1090;&#1091;&#1087;&#1072; &#1082; &#1076;&#1072;&#1085;&#1085;&#1086;&#1081; &#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1077;, &#1074;&#1072;&#1084; &#1085;&#1077;&#1086;&#1073;&#1093;&#1086;&#1076;&#1080;&#1084;&#1086; &#1072;&#1074;&#1090;&#1086;&#1088;&#1080;&#1079;&#1080;&#1088;&#1086;&#1074;&#1072;&#1090;&#1100;&#1089;&#1103;!</p>";
}
?>