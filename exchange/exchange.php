<script language="javascript" src="javascr.js"></script>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<?php
defined('ACCESS') or die();
include '../att.php';	
if($login) {
$sql_ex=mysql_query("SELECT * FROM exchange WHERE login='$login' ORDER BY date DESC LIMIT 10");
$login1=$_SESSION['login'];
$sql=mysql_query("SELECT * FROM users WHERE login='$login1'");
$id=mysql_result($sql,0,'id');
$sql_o=mysql_query("SELECT * FROM tb_orders WHERE id_owner='$id'");
$sql_st=mysql_query("SELECT * FROM tb_srv_stats");
$cur_btc=mysql_result($sql,0,'btc')-0.00000001;
if($cur_btc<0){$cur_btc=0;}
$cur_dgc=mysql_result($sql,0,'dgc')+mysql_result($sql,0,'bdgc')-0.00000001;
$cur_ltc=mysql_result($sql,0,'ltc')-0.00000001;
$cur_dsh=mysql_result($sql,0,'dsh')-0.00000001;
$cur_eth=mysql_result($sql,0,'eth')+mysql_result($sql,0,'beth')-0.00000001;
$cur_mnr=mysql_result($sql,0,'mnr')-0.00000001;
$cur_cld=mysql_result($sql,0,'cloud')-0.00000001;
$cdgc=mysql_result($sql,0,'dgc')-0.00000001;
$ceth=mysql_result($sql,0,'eth')-0.00000001;
$price_btc=mysql_result($sql_st,0,'btc');
$price_dgc=mysql_result($sql_st,0,'dgc');
$price_ltc=mysql_result($sql_st,0,'ltc');
$price_dsh=mysql_result($sql_st,0,'dsh');
$price_mnr=mysql_result($sql_st,0,'mnr');
$price_eth=mysql_result($sql_st,0,'eth');
$price_cld=mysql_result($sql_st,0,'cloud');	  
?><script language=javascript>
var dgcwb=<?echo $cur_dgc;?>;
var ethwb=<?echo $cur_eth;?>;
var btc=<?echo $cur_btc;?>;
var dgc=<?echo $cdgc?>;
var ltc=<?echo $cur_ltc;?>;
var dsh=<?echo $cur_dsh;?>;
var mnr=<?echo $cur_mnr;?>;
var eth=<?echo $ceth;?>;
var p2=<?echo $cur_cld;?>;
var c_btc=<?echo $price_btc;?>;
var c_dgc=<?echo $price_dgc;?>;
var c_ltc=<?echo $price_ltc;?>;
var c_dsh=<?echo $price_dsh;?>;
var c_mnr=<?echo $price_mnr;?>;
var c_eth=<?echo $price_eth;?>;
var c_cld=<?echo $price_cld;?>;
var c_v1=<?echo $price_cld;?>;
	</script>
<div style="margin-left:10%;margin-right:10%;padding-top:3%;">
					  <div class="left_div">
					  <div>
							<ul class="left-menu">
		<li><a href="/mining/">Mining</a></li>
		<li><a href="/enter/">Deposit funds</a></li>
<li class="active_l"><a href="/exchange/">Buy Cloud power</a></li>
<li><a href="/withdrawal/">Withdraw</a></li>
<li><a href="/history/">Transaction history</a></li>
<li><a href="/calc/">Income calculator</a></li>
<li><a href="/ref/">Affiliate program</a></li>
<li><a href="/profile/">Profile</a></li>
							</ul>
							<br><br>
							</div>
					 </div>
					 <div class="right_div">
									<h1 >Exchange service</h1>
							<h5><b>If you exchange cryptocurrency - you will have to pay fee - 15%
							<h5><i>All exchanges provides momentaly.</i></h5>
							<br>
							<form action="/exchange/exch.php" method="post" name="drop_down_box">
								<table class="exchange">
									<tr>
										<td rowspan="2">
										<img id='imgv' style="height:60px;width:60px;" src="/image/select.png" alt="Exchange"/>
										</td>
										<td>
											<select name="menu" id='chsbar' size="1" onChange="ch_val(this.value)" class="exchage_choice" autocomplete="off">
												<option value="0">Choose currency</option>
												<option value="1">Bitcoin</option>
												<option value="3">Litecoin</option>
												<option value="2">Dogecoin</option>
												<option value="4">Ripple</option>
												<option value="6">Ethereum</option>
												<option value="5">Bitcoin cash</option>
											</select>   

										</td>

										<td>
											<select name="menu1" id='chsbar1' size="1" onChange="ch_val1(this.value)" class="exchage_choice" autocomplete="off">
												<option value="0">Cloud</option>
												<option value="1">Bitcoin</option>
												<option value="3">Litecoin</option>
												<option value="2">Dogecoin</option>
												<option value="4">Ripple</option>
												<option value="6">Ethereum</option>
												<option value="5">Bitcoin cash</option>
											</select>  
										</td>
										<td rowspan="2">
											<img id='imgv1' style="height:60px;width:60px;" src="/image/cc.png" alt="Exchange"/>
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" id="cur_val" onkeyup="cld_f(this.value)" placeholder="&nbsp Enter sum" class="exchage_text"/>
										</td>
										<td>
											<input type="text" id="cur_cld" placeholder="&nbsp Take" disabled class="exchage_text"/>
										</td>
									</tr>
									<tr>
									<td colspan=5>
									<input type=button id='be' style='width:25%' value='EXCHAGE' class="exchange_button" onclick="exchange(<?echo $id;?>)">
									</td>
									</tr>
								</table>
								</form>
								<br>
								<h1> Exchange history</h1>
								<p>Last 10 operations</p>
								<div class='his' id='ex'>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Date</td>
						<td class="table_td1">Give</td>
						<td class="table_td1">Way</td>
						<td class="table_td1">Take</td>
					</tr>
					<?for($i=0;$i<mysql_num_rows($sql_ex);$i++)
					{
						$date=date("d.m.y H:i", mysql_result($sql_ex,$i,'date'));
						
						?>
					<tr style="background: #fff;">
							<td class="table_td1"><?echo $date;?></td>
							<td class="table_td1"><?echo mysql_result($sql_ex,$i,'sum');?></td>
							<td class="table_td1">
													<?	$ps=mysql_result($sql_ex,$i,'paysys');
							switch($ps){
								case 3: echo 'Bitcoin -> Cloud';
								break;
								case 4: echo 'Dogecoin -> Cloud';
								break;
								case 5: echo 'Litecoin -> Cloud';
								break;
								case 6: echo 'Ripple -> Cloud';
								break;
								case 7: echo 'Bitcoin cash -> Cloud';
								break;
								case 8: echo 'Ethereum -> Cloud';
								break;
							default:
								echo $ps;
								break;
							}
							?></td>
							
							<td class="table_td1"><?echo number_format(mysql_result($sql_ex,$i,'sumc'),8,',','');
							
							?></td>
					</tr>
					<?}?>
				</table>
				<center><a href='/his_all?t=4'><button class='exchange_button'> Show full history</button></a></center><br>
				</div>
					 </div>
					</div></div>

<br>
<?
}else{

header( 'Location: /login/', true, 303 );

}