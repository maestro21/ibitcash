<script language="javascript" src="javascr.js"></script>
<script type="text/javascript">function up() {  
  var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);  
if(top > 0) {  
  window.scrollBy(0,((top+100)/-10));  
  t = setTimeout('up()',20);  
} else clearTimeout(t);  
return false;  
} 
var isActive = true;
function onBlur() {
    isActive = false;
}
function onFocus() {
	if(isActive==false) {}
    isActive = true;
}
    window.onfocus = onFocus;
    window.onblur = onBlur;

</script>
<br>
<?
defined('ACCESS') or die();
if($login) {
$id=$user_id;
$mkey=urlencode(as_md5($key,$id.$login));
$mkey=preg_replace('/[^0-9]/', '', $mkey);
$mkey=substr($mkey, 0, 12);
$mkey=123;
$sql=mysql_query("SELECT * FROM users WHERE login='$login' LIMIT 1");
$sql_o=mysql_query("SELECT * FROM tb_orders WHERE id_owner='$id' LIMIT 1");
$sql_st=mysql_query("SELECT * FROM tb_srv_stats LIMIT 1");
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$sbtc=mysql_result($sql_st,0,'sbtc');
$sdgc=mysql_result($sql_st,0,'sdgc');
$sltc=mysql_result($sql_st,0,'sltc');
$sdsh=mysql_result($sql_st,0,'sdsh');
$smnr=mysql_result($sql_st,0,'smnr');
$seth=mysql_result($sql_st,0,'seth');
$price_cld=mysql_result($sql_st,0,'cloud');
$param=mysql_result($sql_st,0,'param');
$par1=mysql_result($sql_st,0,'param1');
$par2=mysql_result($sql_st,0,'param2');
$par3=mysql_result($sql_st,0,'param3');
$par4=mysql_result($sql_st,0,'param4');
$par5=mysql_result($sql_st,0,'param5');
$par6=mysql_result($sql_st,0,'param6');
$par7=mysql_result($sql_st,0,'param7');
$cur_btc=mysql_result($sql,0,'btc');
$cur_dgc=mysql_result($sql,0,'dgc')+mysql_result($sql,0,'bdgc');
$cur_ltc=mysql_result($sql,0,'ltc');
$cur_dsh=mysql_result($sql,0,'dsh');
$cur_mnr=mysql_result($sql,0,'mnr');
$cur_eth=mysql_result($sql,0,'eth')+mysql_result($sql,0,'beth');
$cur_id=mysql_result($sql,0,'id');
$cur_cld=mysql_result($sql,0,'cloud');
?>
<script language=javascript>

var cloud=<?echo $cur_cld;?>;
var param=<?echo $param;?>;
// Валюты
var cursrt = [];
var parcur = [];
var сurrsum = [];
var currency = [];
 cursrt[1]='btc';
 cursrt[2]='dgc';
 cursrt[3]='ltc';
 cursrt[4]='dsh';
 cursrt[5]='mnr';
 cursrt[6]='eth';
 cursrt[7]='cld';
 parcur[1]=<?echo $par1;?>;
 parcur[2]=<?echo $par2;?>;
 parcur[3]=<?echo $par3;?>;
 parcur[4]=<?echo $par4;?>;
 parcur[5]=<?echo $par5;?>;
 parcur[6]=<?echo $par6;?>;
 parcur[7]=<?echo $par7;?>;
 сurrsum[1]=<?echo $cur_btc;?>;
 сurrsum[2]=<?echo $cur_dgc?>;
 сurrsum[3]=<?echo $cur_ltc;?>;
 сurrsum[4]=<?echo $cur_dsh;?>;
 сurrsum[5]=<?echo $cur_mnr;?>;
 сurrsum[6]=<?echo $cur_eth;?>;
 сurrsum[7]=<?echo $cur_cld;?>;
 currency[1]=<?echo $price_btc;?>;
 currency[2]=<?echo $price_dgc;?>;
 currency[3]=<?echo $price_ltc;?>;
 currency[4]=<?echo $price_dsh;?>;
 currency[5]=<?echo $price_mnr;?>;
 currency[6]=<?echo $price_eth;?>;
 currency[7]=<?echo $price_cld;?>;
</script><?

?>
<div style="margin-left:10%;margin-right:10%;">
					  <div class="left_div">
					  <div>
							<ul class="left-menu">
		<li class="active_l"><a href="/mining/">Майнинг</a></li>
		<li><a href="/enter/">Пополнить баланс</a></li>
<li><a href="/exchange/">Обмен на облако Cloud</a></li>
<li><a href="/withdrawal/">Вывести средства</a></li>
<li><a href="/history/">История операций</a></li>
<li><a href="/calc/">Калькулятор дохода</a></li>
<li><a href="/ref/">Партнерская программа</a></li>
<li><a href="/profile/">Профиль</a></li>
							</ul>
							</div>
					 </div>
					 <div class="right_div">
					 
									<div class="mining">
						<div style=" width:100%; height:1px; clear:both;"></div>
						<div class="mining_div"><img src="cld.png" /></div> 
						<div class="mining_div"><b>Cloud</b><br>Цена:<br><b>Сгенерировано:</b><br><br></div> 
						<div class="mining_div"><br><span style='font-size:1em;color:#33AA33;'>$<?echo number_format($price_cld,8,',','');?></span><br><b><span id='cldsum' style="font-size:1em;"><?echo number_format($cur_cld,8,',','');?> </span></b><br><br><br></div> 
						<div class="mining_div btntop"><input id='bcld'type="button" class="submit ming" onclick="curInterval(7,0)" value="МАЙНИТЬ" /></div>
						<div style=" width:100%; height:1px; clear:both;"></div> 
					</div>
<div class="mining">
						<div style=" width:100%; height:1px; clear:both;"></div>
						<div class="mining_div"><img src="bitcoin.png" /></div> 
						<div class="mining_div"><b>Bitcoin</b><br>Сгенерировано:<br>В час:<br>Цена:<br><b>Доступно:</b></div> 
						<div class="mining_div"><br><span id='btcsum' style="font-size:1em;">0.00000000</span><br><?echo number_format(($cur_cld*(0.0000021839506173*10/$param)*60*60)/$price_btc*$par2,8,',','');?> <span style='font-size:1em;color:#CC6633'>BTC</span><br><?	
						$res1=number_format($price_btc,8,',','');
if($sbtc==0){
	echo "<span style='font-size:1em;color:#33AA33;'>$".$res1."↑</span>";
	}else{
	echo "<span style='font-size:1em;color:#AA3333;'>$".$res1."↓</span>"; 
	}?><br><b><span id='btcplus' style="font-size:1em;"><?echo number_format($cur_btc,8,',','');?></span></b></div> 
						<div class="mining_div btntop"><input id='bbtc' type="button" class="submit ming" onclick="curInterval(1,0)" value="МАЙНИТЬ" /></div>
						<div style=" width:100%; height:1px; clear:both;"></div> 
					</div>
					
					<div class="mining">
						<div style=" width:100%; height:1px; clear:both;"></div>
						<div class="mining_div"><img src="litecoin.png" /></div> 
						<div class="mining_div"><b>Litecoin</b><br>Сгенерировано:<br>В час:<br>Цена:<br><b>Доступно:</b></div> 
						<div class="mining_div"><br><span id='ltcsum' style="font-size:1em;">0.00000000</span><br><?echo number_format(($cur_cld*(0.0000021839506173*10/$param)*60*60)/$price_ltc*$par2,8,',','');?> <span style='font-size:1em;color:#9999CC'>LTC</span><br><?
												$res1=number_format($price_ltc,8,',','');
if($sltc==0){
	echo "<span style='font-size:1em;color:#33AA33;'>$".$res1."↑</span>";
	}else{
	echo "<span style='font-size:1em;color:#AA3333;'>$".$res1."↓</span>"; 
	}
?><br><b><span id='ltcplus' style="font-size:1em;"><?echo number_format($cur_ltc,8,',','');?></span></b></div> 
						<div class="mining_div btntop"><input id='bltc' type="button" class="submit ming" onclick="curInterval(3,0)" value="МАЙНИТЬ" /></div>
						<div style=" width:100%; height:1px; clear:both;"></div> 
					</div>
					
					<div class="mining">
						<div style=" width:100%; height:1px; clear:both;"></div>
						<div class="mining_div"><img src="dogecoin.png" /></div> 
						<div class="mining_div"><b>Dogecoin</b><br>Сгенерировано:<br>В час:<br>Цена:<br><b>Доступно:</b></div> 
						<div class="mining_div"><br><span id='dgcsum' style="font-size:1em;">0.00000000</span><br><?echo number_format(($cur_cld*(0.0000021839506173*10/$param)*60*60)/$price_dgc*$par3,8,',','');?> <span style='font-size:1em;color:#CC9900'>DOGE</span><br><?
						
												$res1=number_format($price_dgc,8,',','');
if($sdgc==0){
	echo "<span style='font-size:1em;color:#33AA33;'>$".$res1."↑</span>";
	}else{
	echo "<span style='font-size:1em;color:#AA3333;'>$".$res1."↓</span>"; 
	}
?><br><b><span id='dgcplus' style="font-size:1em;"><?echo number_format($cur_dgc,8,',','');?></span></b></div> 
						<div class="mining_div btntop"><input id='bdgc' type="button" class="submit ming" onclick="curInterval(2,0)" value="МАЙНИТЬ" /></div>
						<div style=" width:100%; height:1px; clear:both;"></div> 
					</div>
					
					<div class="mining">
						<div style=" width:100%; height:1px; clear:both;"></div>
						<div class="mining_div"><img src="d.png" /></div> 
						<div class="mining_div"><b>Ripple</b><br>Сгенерировано:<br>В час:<br>Цена:<br><b>Доступно:</b></div> 
						<div class="mining_div"><br><span id='dshsum' style="font-size:1em;">0.00000000</span><br><?echo number_format(($cur_cld*(0.0000021839506173*10/$param)*60*60)/$price_dsh*$par4,8,',','');?> <span style='font-size:1em;color:#0099FF'>XRP</span><br><?						
						$res1=number_format($price_dsh,8,',','');
if($sdsh==0){
	echo "<span style='font-size:1em;color:#33AA33;'>$".$res1."↑</span>";
	}else{
	echo "<span style='font-size:1em;color:#AA3333;'>$".$res1."↓</span>"; 
	}
?><br><b><span id='dshplus' style="font-size:1em;"><?echo number_format($cur_dsh,8,',','');?></span></b></div> 
						<div class="mining_div btntop"><input id='bdsh' type="button" class="submit ming" onclick="curInterval(4,0)" value="МАЙНИТЬ" /></div>
						<div style=" width:100%; height:1px; clear:both;"></div> 
					</div>	
					<div class="mining">
						<div style=" width:100%; height:1px; clear:both;"></div>
						<div class="mining_div"><img src="e.png" /></div> 
						<div class="mining_div"><b>Ethereum</b><br>Сгенерировано:<br>В час:<br>Цена:<br><b>Доступно:</b></div> 
						<div class="mining_div"><br><span id='ethsum' style="font-size:1em;">0.00000000</span><br><?echo number_format(($cur_cld*(0.0000021839506173*10/$param)*60*60)/$price_eth*$par5,8,',','');?> <b>ETH</b><br><?						
						$res1=number_format($price_eth,8,',','');
if($seth==0){
	echo "<span style='font-size:1em;color:#33AA33;'>$".$res1."↑</span>";
	}else{
	echo "<span style='font-size:1em;color:#AA3333;'>$".$res1."↓</span>"; 
	}
?><br><b><span id='ethplus' style="font-size:1em;"><?echo number_format($cur_eth,8,',','');?></span></b></div> 
						<div class="mining_div btntop"><input id='beth' type="button" class="submit ming" onclick="curInterval(6,0)" value="МАЙНИТЬ" /></div>
						<div style=" width:100%; height:1px; clear:both;"></div> 
					</div>
					
					<div class="mining">
						<div style=" width:100%; height:1px; clear:both;"></div>
						<div class="mining_div"><img src="r.png" /></div> 
						<div class="mining_div"><b>Bitcoin cash</b></b><br>Сгенерировано:<br>В час:<br>Цена:<br><b>Доступно:</b></div> 
						<div class="mining_div"><br><span id='mnrsum' style="font-size:1em;">0.00000000</span><br><?echo number_format(($cur_cld*(0.0000021839506173*10/$param)*60*60)/$price_mnr*$par6,8,',','');?> <span style='font-size:1em;color:#FF0000'>B</span><span style='font-size:1em;color:#FF9933'>C</span><span style='font-size:1em;color:#0066FF'>H</span><br><?
												$res1=number_format($price_mnr,8,',','');
if($smnr==0){
	echo "<span style='font-size:1em;color:#33AA33;'>$".$res1."↑</span>";
	}else{
	echo "<span style='font-size:1em;color:#AA3333;'>$".$res1."↓</span>"; 
	}
?><br><b><span id='mnrplus' style="font-size:1em;"><?echo number_format($cur_mnr,8,',','');?></span></b></div> 
						<div class="mining_div btntop"><input id='bmnr' type="button" class="submit ming" onclick="curInterval(5,0)" value="МАЙНИТЬ" /></div>
						<div style=" width:100%; height:1px; clear:both;"></div> 
					</div>
				</div>
				</div>
		<?
		if(mysql_num_rows($sql_o)>0)
		{
			$ls=mysql_result($sql_o,0,'pre_sum');
			$par=mysql_result($sql_o,0,'param'); 
			$type=mysql_result($sql_o,0,'type');
			$st=mysql_result($sql_o,0,'s_time');
			$sm=mysql_result($sql_o,0,'s_mount');
			$currency=mysql_result($sql_o,0,'curr');
			$progress=$ls+$cur_cld*(0.0000021839506173/$param)*10/$currency*$par*(time()-$st);
			if($type==7){$progress+=$cur_cld;}
			?>
			<script>
			var progress=<?echo $progress;?>;
			curInterval(<?echo $type?>,1);
			</script>
			<?
		}
		}
 else{header( 'Location: /login/', true, 303 );}?>