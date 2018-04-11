<script language="javascript" src="../jquery-2.2.1.js"></script>
<?
if($login){
$sql_ent=mysql_query("SELECT * FROM enter WHERE login='$login' AND status!=10 ORDER by date DESC LIMIT 10");
$sql_wd=mysql_query("SELECT * FROM output WHERE login='$login' ORDER by date DESC LIMIT 10");
$sql_ex=mysql_query("SELECT * FROM refbonus WHERE login='$login' ORDER by date DESC LIMIT 10");
?>
<script>

function chang(s){
    $('.active').removeClass('active');
    $(s).addClass('active');

	switch(s)
	{
	  case "#cent":
      $('.his').slideUp(500);
	  $('#ent').slideDown(500);
	  break;
	  case "#cvd":
      $('.his').slideUp(500);
	  $('#vd').slideDown(500);
	  break;
	  case "#ctc":
      $('.his').slideUp(500);
	  $('#ex').slideDown(500);
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
<li><a href="/withdrawal/">Withdraw</a></li>
<li class="active_l"><a href="/history/">Transaction history</a></li>
<li><a href="/calc/">Income calculator</a></li>
<li><a href="/ref/">Affiliate program</a></li>
<li><a href="/profile/">Profile</a></li>
							</ul>
							</div>
					 </div>
					 <div class="right_div">
					 <p id="supp_h">Transaction history</p>
					 <div class="pay_menu">		
							
								<ul style="font-size:1em;">
								<li id='cent' style="padding:0.3em;margin:0.5em;" class="active">
										 <a onclick="chang('#cent');" style="margin:0.2em;padding:0.2em;"><span>Deposit history</span></a>
									</li>
								<li id='cvd' style="padding:0.3em;margin:0.5em;" id='cinf'>
										 <a onclick="chang('#cvd');" style="margin:0.2em;padding:0.2em;"><span>Withdrawal history</span></a>
									</li>
								<li id='ctc' style="padding:0.3em;margin:0.5em;" id='cinf'>
										 <a onclick="chang('#ctc');" style="margin:0.2em;padding:0.2em;"><span>Affiliate bonuses</span></a>
									</li>
								</ul>
					</div>
					 <div class='his' id='ent'>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Date</td>
						<td class="table_td1">Amount</td>
						<td class="table_td1">Wallet</td>
						<td class="table_td1">Currency</td>
						<td class="table_td1" style="width:20%;">Status</td>
					</tr>
					<?for($i=0;$i<mysql_num_rows($sql_ent);$i++)
					{
						$date=date("d.m.y H:i", mysql_result($sql_ent,$i,'date'));
						
						?>
					<tr style="background: #fff;">
							<td class="table_td1"><?echo $date;?></td>
							<td class="table_td1"><?echo mysql_result($sql_ent,$i,'sum')?></td>
							<td class="table_td1"><?echo mysql_result($sql_ent,$i,'purse')?></td>
							<td class="table_td1"><?echo mysql_result($sql_ent,$i,'paysys')?></td>
							<td class="table_td1"><?if(mysql_result($sql_ent,$i,'status')==2) echo "Done"; else echo "In process";?></td>
					</tr>
					<?}?>
				</table>
				<center><a href='/his_all?t=1'><button class='exchange_button'> Show full history</button></a></center>
				</div>
									 <div class='his' id='vd'>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Date</td>
						<td class="table_td1">Amount</td>
						<td class="table_td1">Wallet</td>
						<td class="table_td1">Currency</td>
						<td class="table_td1" style="width:20%;">Status</td>
					</tr>
					<?for($i=0;$i<mysql_num_rows($sql_wd);$i++)
					{
						$date=date("d.m.y H:i", mysql_result($sql_wd,$i,'date'));
						
						?>
					<tr style="background: #fff;">
							<td class="table_td1"><?echo $date;?></td>
							<td class="table_td1"><?echo mysql_result($sql_wd,$i,'sum')?></td>
							<td class="table_td1"><?echo mysql_result($sql_wd,$i,'purse')?></td>
							<td class="table_td1"><?
							
							$ps=mysql_result($sql_wd,$i,'paysys');
							switch($ps){
								case 3: echo 'Bitcoin';
								break;
								case 4: echo 'Dogecoin';
								break;
								case 5: echo 'Litecoin';
								break;
								case 6: echo 'Ripple';
								break;
								case 7: echo 'Bitcoin cash';
								break;
								case 8: echo 'Ethereum';
								break;
							}
							?></td>
							<td class="table_td1"><?if(mysql_result($sql_wd,$i,'status')==2){ echo "Done"; }elseif(mysql_result($sql_wd,$i,'status')==0){ echo "In process"; }else{ echo "Denied";}?></td>
					</tr>
					<?}?>
				</table>
				<center><a href='/his_all?t=2'><button class='exchange_button'> Show full history</button></a></center>
				</div>
									 <div class='his' id='ex'>
									 <?
									 echo "<p>The amount of referrals' clouds:<b>".$refbal.'</b></p><br>';
									 ?>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Date</td>
						<td class="table_td1">Nickname</td>
						<td class="table_td1">Cloud Received</td>
					</tr>
					<?
					for($i=0;$i<mysql_num_rows($sql_ex);$i++)
					{
						$date=date("d.m.y H:i", mysql_result($sql_ex,$i,'date'));
						
						?>
					<tr style="background: #fff;">
							<td class="table_td1"><?echo $date;?></td>
							<td class="table_td1"><?echo mysql_result($sql_ex,$i,'rlogin')?></td>
							<td class="table_td1"><?echo mysql_result($sql_ex,$i,'sum')?></td>
					</tr>
					<?}?>
				</table>
				<center><a href='/his_all?t=3'><button class='exchange_button'> Show full history</button></a></center>
				</div>
					 </div>
					 </div>
					 <script>
					 	$('.his').slideUp();
	$('#ent').slideDown(1);
	</script>
<?}else{?><script>document.location.href = '<?php echo BASE_PATH;?>login';</script><?}