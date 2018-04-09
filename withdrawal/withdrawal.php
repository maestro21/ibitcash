<script language="javascript" src="../jquery-2.2.1.js"></script>
<?php
defined('ACCESS') or die();
include '../att_en.php';
if ($login) {

	$sql	= 'SELECT `pm`, `pm_balance`, `ref` FROM `users` WHERE `id` = '.$user_id.' LIMIT 1';
	$rs		= mysql_query($sql);
	$r		= mysql_fetch_array($rs);

	if($_GET['cancel']) {
			$sql2	= 'SELECT * FROM `output` WHERE `id` = '.mysql_real_escape_string(intval($_GET['cancel'])).' AND status = 0 AND login = "'.$login.'" LIMIT 1';
			$rs2	= mysql_query($sql2);
			$r2		= mysql_fetch_array($rs2);
			$sum1=$r2['sum'];
			switch($r2['paysys'])
			{
				case 3:mysql_query("UPDATE users SET btc = btc+'$sum1' WHERE login = '$login'");
				break;
				
				case 4:mysql_query("UPDATE users SET dgc = dgc+'$sum1' WHERE login = '$login'");
				break;
				
				case 5:mysql_query("UPDATE users SET ltc = ltc+'$sum1' WHERE login = '$login'");
				break;
				
				case 6:mysql_query("UPDATE users SET dsh = dsh+'$sum1' WHERE login = '$login'");
				break;
				
				case 7:mysql_query("UPDATE users SET mnr = mnr+'$sum1' WHERE login = '$login'");
				break;
				
				case 8:mysql_query("UPDATE users SET eth = eth+'$sum1' WHERE login = '$login'");
				break;
				
			}

			if($r2['sum']) {
				//mysql_query('UPDATE `users` SET pm_balance = pm_balance + '.$r2['sum'].' WHERE id = '.$user_id.' LIMIT 1');
				mysql_query('UPDATE `output` SET status = 6 WHERE id = '.mysql_real_escape_string(intval($_GET['cancel'])).' LIMIT 1');
				print '<p class="erok">Заявка отменена, средства возвращены на баланс</p>';
			} else {
				print '<p class="er">Невозможно отменить заявку</p>';
			}
	}
$login1=$_SESSION['login'];
$sql=mysql_query("SELECT * FROM users WHERE login='$login1'");
$id=mysql_result($sql,0,'id');
$sql_o=mysql_query("SELECT * FROM tb_orders WHERE id_owner='$id'");
$btc=number_format(mysql_result($sql,0,'btc'),8 ,'.', '');
$dgc=number_format(mysql_result($sql,0,'dgc'),8,'.', '');
$ltc=number_format(mysql_result($sql,0,'ltc'),8,'.', '');
$dsh=number_format(mysql_result($sql,0,'dsh'),8,'.', '');
$eth=number_format(mysql_result($sql,0,'eth'),8,'.', '');
$mnr=number_format(mysql_result($sql,0,'mnr'),8,'.', '');
$beth=number_format(mysql_result($sql,0,'beth'),8 ,'.', '');
$bdgc=number_format(mysql_result($sql,0,'bdgc'),8,'.', '');
$ibtc=$btc;
$idgc=$dgc;
$iltc=$ltc;
$idsh=$dsh;
$ieth=$eth;
$imnr=$mnr;
$sql1=mysql_query("SELECT * FROM tb_srv_stats");
$m_btc=number_format(mysql_result($sql1,0,'min_btc'),8,'.', '');
$m_dgc=number_format(mysql_result($sql1,0,'min_dgc'),8,'.', '');
$m_ltc=number_format(mysql_result($sql1,0,'min_ltc'),8,'.', '');
$m_dsh=number_format(mysql_result($sql1,0,'min_dsh'),8,'.', '');
$m_mnr=number_format(mysql_result($sql1,0,'min_mnr'),8,'.', '');
$m_eth=number_format(mysql_result($sql1,0,'min_eth'),8,'.', '');
	if ($_GET['action'] == 'save') {
		$sum	= str_replace(',', '.', $_POST['sum']);
		$ps		= intval($_POST['ps']);
		$purse	= htmlspecialchars($_POST['purse'], ENT_QUOTES, ''); 
		$pin1	=$_POST['pin'];
		if ($sum <= 0) {
			?><SCRIPT>showatt(8);</SCRIPT><?;
		}  elseif($purse=='') {
			?><SCRIPT>showatt(8);</SCRIPT><?;
		} else {
			$ulg=$_SESSION['login'];
			$sql_st=mysql_query("SELECT * FROM tb_srv_stats");
			$sql_us=mysql_query("SELECT * FROM users WHERE login='$ulg'");
			$pin2=mysql_result($sql_us,0,'pin');
			$k=0;
			if($pin1==$pin2){
			switch ($ps)
			{
				case 3:
					$min_sum=number_format(mysql_result($sql_st,0,'min_btc'),8);
					$cur_sum=number_format(mysql_result($sql_us,0,'btc'),8);
					if($sum>=$min_sum && $sum <=$cur_sum)
					{
						$sum1=$cur_sum-$sum;
						mysql_query("UPDATE users SET btc = '$sum1' WHERE login = '$ulg'");
						$k=1;
					}
					break;
				case 4:
					$min_sum=mysql_result($sql_st,0,'min_dgc');
					$cur_sum=mysql_result($sql_us,0,'dgc');
					if($sum>=$min_sum && $sum <=$cur_sum)
					{
						$sum1=$cur_sum-$sum;
						mysql_query("UPDATE users SET dgc = '$sum1' WHERE login = '$ulg'");		
						$k=1;				
					}
					break;
				case 5:
					$min_sum=mysql_result($sql_st,0,'min_ltc');
					$cur_sum=mysql_result($sql_us,0,'ltc');
					if($sum>=$min_sum && $sum <=$cur_sum)
					{
						$sum1=$cur_sum-$sum;
						mysql_query("UPDATE users SET ltc = '$sum1' WHERE login = '$ulg'");	
						$k=1;	
						
					}
					break;
				case 6:
					$min_sum=number_format(mysql_result($sql_st,0,'min_dsh'),8);
					$cur_sum=number_format(mysql_result($sql_us,0,'dsh'),8);
					if($sum>=$min_sum && $sum <=$cur_sum)
					{
						$sum1=$cur_sum-$sum;
						mysql_query("UPDATE users SET dsh = '$sum1' WHERE login = '$ulg'");	
						$k=1;						
					}
					break;
				case 7:
					$min_sum=mysql_result($sql_st,0,'min_mnr');
					$cur_sum=mysql_result($sql_us,0,'mnr');
					if($sum>=$min_sum && $sum <=$cur_sum)
					{
						$sum1=$cur_sum-$sum;
						mysql_query("UPDATE users SET mnr = '$sum1' WHERE login = '$ulg'");		
						$k=1;						
					}
					break;
				case 8:
					$min_sum=mysql_result($sql_st,0,'min_eth');
					$cur_sum=mysql_result($sql_us,0,'eth');
					if($sum>=$min_sum && $sum <=$cur_sum)
					{
						$sum1=$cur_sum-$sum;
						mysql_query("UPDATE users SET eth = '$sum1' WHERE login = '$ulg'");	
						$k=1;						
					}
					break;
			}
			If($k==1)
			{
			$minus = $sum;

			//$sql	= 'UPDATE `users` SET pm_balance = pm_balance - '.$minus.' WHERE id = '.$user_id.' LIMIT 1';
			//mysql_query($sql);

				$st = 0; 

			$sql = 'INSERT INTO `output` (`sum`, `date`, `login`, `paysys`, `purse`, `status`) VALUES("'.$sum.'", "'.time().'", "'.$login.'", "'.$ps.'", "'.$purse.'", "'.$st.'")';

			if (mysql_query($sql)) {

					$lid = mysql_insert_id();
					?><SCRIPT>showatt(6);</SCRIPT><?;

			} else {
				print '<p class="er">Unable to send a request for withdrawal.</p>';
			}
		}
		}else{?><SCRIPT>showatt(7);</SCRIPT><?}
		}
	}
	?>
<script language="JavaScript">
function chang(s){
    $('.active').removeClass('active');
    $(s).addClass('active');
	switch(s)
	{
	  case "#cbtc":
	  document.getElementById("ps").value=3;
	  document.getElementById("img").src='../image/bitcoin.png';
	  document.getElementById("sum").placeholder='BTC';
	  	document.getElementById('sum').value=<?echo $ibtc?>.toFixed(8);
		document.getElementById('mxbal').innerHTML=<?echo $btc?>.toFixed(8);
	document.getElementById('mbal').innerHTML=<?echo $m_btc?>.toFixed(8);
	  break;
	  case "#cltc":
	  document.getElementById("ps").value=5;
	  document.getElementById("img").src='../image/litecoin.png';
	  document.getElementById("sum").placeholder='LTC';
	  	document.getElementById('sum').value=<?echo $iltc?>.toFixed(8);
		document.getElementById('mxbal').innerHTML=<?echo $ltc?>.toFixed(8);
	document.getElementById('mbal').innerHTML=<?echo $m_ltc?>.toFixed(8);
	  break;
	  case "#cdsh":
	  document.getElementById("ps").value=6;
	  document.getElementById("img").src='../image/dash.png';
	  document.getElementById("sum").placeholder='XRP';
	  	document.getElementById('sum').value=<?echo $idsh?>.toFixed(8);
		document.getElementById('mxbal').innerHTML=<?echo $dsh?>.toFixed(8);
	document.getElementById('mbal').innerHTML=<?echo $m_dsh?>.toFixed(8);
	  break;
	  case "#cdgc":
	  document.getElementById("ps").value=4;
	  document.getElementById("img").src='../image/dogecoin.png';
	  document.getElementById("sum").placeholder='DOGE';
	  	document.getElementById('sum').value=<?echo $idgc?>.toFixed(8);
		document.getElementById('mxbal').innerHTML=<?echo $dgc?>.toFixed(8);
	document.getElementById('mbal').innerHTML=<?echo $m_dgc?>.toFixed(8);
	  break;
	  case "#ceth":
	  document.getElementById("ps").value=8;
	  document.getElementById("img").src='../image/ethereum.png';
	  document.getElementById("sum").placeholder='ETH';
	  	document.getElementById('sum').value=<?echo $ieth?>.toFixed(8);
		document.getElementById('mxbal').innerHTML=<?echo $eth?>.toFixed(8);
	document.getElementById('mbal').innerHTML=<?echo $m_eth?>.toFixed(8);
	  break;
	  case "#crdd":
	  document.getElementById("ps").value=7;
	  document.getElementById("img").src='../image/redocoin.png';
	  document.getElementById("sum").placeholder='BCH';
	  	document.getElementById('sum').value=<?echo $imnr?>.toFixed(8);
		document.getElementById('mxbal').innerHTML=<?echo $mnr?>.toFixed(8);
	document.getElementById('mbal').innerHTML=<?echo $m_mnr?>.toFixed(8);
	  break;
	}
}
</script>
<div style="margin-left:10%;margin-right:10%;"><br>
					  <div class="left_div">
					  <div>
							<ul class="left-menu">
		<li><a href="/mining/">Mining</a></li>
		<li><a href="/enter/">Deposit funds</a></li>
<li><a href="/exchange/">Buy Cloud power</a></li>
<li class="active_l"><a href="/withdrawal/">Withdraw</a></li>
<li><a href="/history/">Transaction history</a></li>
<li><a href="/calc/">Income calculator</a></li>
<li><a href="/ref/">Affiliate program</a></li>
<li><a href="/profile/">Profile</a></li>
							</ul>
							</div>
					 </div>
					 <div class="right_div">
					 							<div class="pay_menu">		
							
								<ul>
									<li id='cbtc' class='active'>
										 <a  onclick="chang('#cbtc');" ><img src="../image/bitcoin.png"width="40"></a>
									</li>
									<li id='cdsh'>
										 <a  onclick="chang('#cdsh');" ><img src="../image/dash.png"width="40"></a>
									</li>
									<li id='cdgc'>
										 <a  onclick="chang('#cdgc');" ><img src="../image/dogecoin.png"width="40"></a>
									</li>
									<li id='ceth'>
										 <a  onclick="chang('#ceth');" ><img src="../image/ethereum.png"width="40"></a>
									</li>
									<li id='cltc'>
										 <a  onclick="chang('#cltc');" ><img src="../image/litecoin.png"width="40"></a>
									</li>
									<li id='crdd'>
										 <a  onclick="chang('#crdd');" ><img src="../image/redocoin.png"width="40"></a>
									</li>					
								</ul>
							</div>
							<div class="pay_content">
								<div class="tab_pane" id="tab2BTC">
												<p id="draw_h">

													<img id=img src='../image/bitcoin.png'>
												Minimum:<span id='mbal'><?echo $btc;?></span><br>Available:<span id='mxbal'><?echo $m_btc;?></span></p>
												<div class="forms_right">
												<form action="?action=save" method="post">
												<input type=hidden id="ps" name="ps" value='3'>
													<input type="text"  id="purse" name='purse' class="drawal" placeholder="&nbsp;&nbsp;Recipient's wallet" required><br>
													<input type="text" autocomplete='off' id="sum" value='<?echo $ibtc;?>' name='sum' class="inp_btc" placeholder='&nbsp;&nbsp;BTC'>
													<button class="exchange_button" type="submit" style='width:16%;margin-left:2%'>Withdraw</button><br>	 
													
													</form>
													<p>Bonus DOGE:<?echo $bdgc?></p>
													<p>Bonus Ethereum:<?echo $beth?></p>
												</div>
								</div>
							</div>
					 </div>
					

</div>
<?}else{?><script>document.location.href = 'https://coincloud.pro/login';</script><?}?>