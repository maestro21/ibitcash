<?php
if($login) {?>
<script>
function refsh(){
$('.referals').toggle(500);
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
<li><a href="/history/">Transaction history</a></li>
<li><a href="/calc/">Income calculator</a></li>
<li class="active_l"><a href="/ref/">Affiliate program</a></li>
<li><a href="/profile/">Profile</a></li>
							</ul>
							</div>
					 </div>
					 <div class="right_div">

<?
	$get_user_info = mysql_query("SELECT ref, ref_money FROM users WHERE id = ".$user_id." LIMIT 1");
	$row = mysql_fetch_array($get_user_info);
	 $ref			= $row['ref'];
	 $ref_money		= $row['ref_money'];	

	if($ref) {

		$get_user_info2	= mysql_query("SELECT login FROM users WHERE id = ".$ref." LIMIT 1");
		$row2 			= mysql_fetch_array($get_user_info2);
		 $uplogin	= $row2['login'];

	}
?>
<?
$lg=$_SESSION['login'];
$sql=mysql_query("SELECT * FROM users WHERE login='$lg'");
$uid=mysql_result($sql,0,'id');
$rm=mysql_result($sql,0,'ref_money');
$sql2=mysql_query("SELECT * FROM users WHERE ref='$uid'");
$refb=mysql_result($sql,0,'refb');
$sql3=mysql_query("SELECT * FROM tb_srv_stats");
$nc=mysql_result($sql3,0,'need_cld');
$gc=mysql_result($sql3,0,'get_cld');
$k=0;
for ($i=0;$i<mysql_num_rows($sql2);$i++)
{
	$b=mysql_result($sql2,$i,'cloud');
	$k=$k+$b;
}
?>
			<div class="ref">
					<div>
					<?
					$sql=mysql_query("SELECT * FROM users WHERE id='$uref'");
					$rl=mysql_result($sql,0,'login');
					?>
						<h1>Affiliate program</h1>
						<br>
						<p>Your referrer: <b><?echo $rl;?></b></p>
						<p>You made him <b><?echo $rm;?> Cloud</b></p>
<b>The amount of referrals' clouds:: <span id='rcloud'><?echo $k?></span></b><br>
<br>
					<center><button class='exchange_button' onclick='refsh()'>Show referals</button></center>
						<div class='referals' hidden>
							<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
					<td class="table_td1" style="width:10%;">№</td>
						<td class="table_td1" style="width:10%;">Referal</td>
						<td class="table_td1">Profit </td>
					</tr>
					<?
					$sql_ent=mysql_query("SELECT * FROM users WHERE ref='$user_id'");
					for($i=0;$i<mysql_num_rows($sql_ent);$i++)
					{
						$lg=mysql_result($sql_ent,$i,'login');
						$rm=mysql_result($sql_ent,$i,'ref_money');
						?>
					<tr style="background: #fff;">
					<td class="table_td1" style="width:10%;"><?echo $i+1;?></td>
							<td class="table_td1"><?echo $lg;?></td>
							<td class="table_td1"><?echo $rm;?></td>
					</tr>
					<?}?>
				</table>
						</div>
	
<br>
						<h5>We offer you a beneficial affiliate program, so you can increase your income by getting referral fees from those you've invited. You get 10% of any Cloud purchases your referral makes.<br></br>Besides that, you always get a priority in ibit.cash Support!</h5>
						<br>You can invite new users using whatever method you like, that is including but not limited to: E-mail, YouTube, Facebook, Twitter, forums, blogs etc.</br>
						<br>*Referral fees are rewarded only for active users.</br>
						<br><center><h6>User is considered active if they made at least one deposit.</h6></center>
						<br>
						
						<center>
							<p>
								<b>Your affiliate link: <a href="<?php echo BASE_PATH;?>?ref=<?php print $user_id; ?>"><?php echo BASE_PATH;?>?ref=<?php print $user_id; ?></a></b>
							</p>
						</center>
						<br>
					</div>
						<br>
					
				</div>
			</div>
			</div><?}else{	header( 'Location: /login/', true, 303 );}