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
		<li><a href="/mining/">Майнинг</a></li>
		<li><a href="/enter/">Пополнить баланс</a></li>
<li><a href="/exchange/">Обмен на облако Cloud</a></li>
<li><a href="/withdrawal/">Вывести средства</a></li>
<li><a href="/history/">История операций</a></li>
<li><a href="/calc/">Калькулятор дохода</a></li>
<li class="active_l"><a href="/ref/">Партнерская программа</a></li>
<li><a href="/profile/">Профиль</a></li>
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
						<h1>Партнерская программа</h1>
						<br>
						<p>Вас привёл <b><?echo $rl;?></b></p>
						<p>Вы принесли ему <b><?echo $rm;?> Cloud</b></p>
						
<b>Сумма облака ваших рефералов: <span id='rcloud'><?echo $k?></span></b><br><br>
					<center><button class='exchange_button' onclick='refsh()'>Показать рефералов</button></center>
						<div class='referals' hidden>
							<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
					<td class="table_td1" style="width:10%;">№</td>
						<td class="table_td1" style="width:10%;">Реферал</td>
						<td class="table_td1">Принёс </td>
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
						<h5>Мы предлагаем вам выгодную реферальную систему, благодаря которой вы сможете увеличить ваш заработок от отчислений с заработка ваших приглашенных пользователей. Мы начисляем 10% бонуса с покупки рефералом Cloud валюты.<br/><br/>Вы можете привлекать новых участников каким угодно способом: через Email, YouTube, Вконтакте, Facebook, Twitter, форумы, блоги и т.д. <br/><br/>Реферальная система срабатывает после того, как посетитель перешел на наш сайт по реферальной ссылке или по клику на баннер.<br/><br/></h5>
						<br>* Партнерские отчисления идут только за активных пользователей.</br>
						<br><center><h6>Пользователь автоматически становится вашим рефералом, когда переходит по вашей персональной ссылке или кликает по баннеру.</h6></center>
						<br>
						<center>
							<p>
								<b>Ваша партнерская ссылка: <a href="https://ibit.cash/?ref=<?php print $user_id; ?>">https://ibit.cash/?ref=<?php print $user_id; ?></a></b>
							</p>
						</center>
						<br>
					</div>
						<br>
					
				</div>
			</div>
			</div><?}else{	header( 'Location: /login/', true, 303 );}