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
<li><a href="/mining/">Майнинг</a></li>
<li><a href="/enter/">Пополнить баланс</a></li>
<li><a href="/exchange/">Обмен на облако Cloud</a></li>
<li><a href="/withdrawal/">Вывести средства</a></li>
<li class="active_l"><a href="/history/">История операций</a></li>
<li><a href="/calc/">Калькулятор дохода</a></li>
<li><a href="/ref/">Партнерская программа</a></li>
<li><a href="/profile/">Профиль</a></li>
							</ul>
							</div>
					 </div>
					 <div class="right_div">
					 <p id="supp_h">История операций</p>
					 <div class="pay_menu">		
							
								<ul style="font-size:1em;">
								<li id='cent' style="padding:0.3em;margin:0.5em;" class="active">
										 <a onclick="chang('#cent');" style="margin:0.2em;padding:0.2em;"><span>История вводов</span></a>
									</li>
								<li id='cvd' style="padding:0.3em;margin:0.5em;" id='cinf'>
										 <a onclick="chang('#cvd');" style="margin:0.2em;padding:0.2em;"><span>История выводов</span></a>
									</li>
								<li id='ctc' style="padding:0.3em;margin:0.5em;" id='cinf'>
										 <a onclick="chang('#ctc');" style="margin:0.2em;padding:0.2em;"><span>Реферальные начисления</span></a>
									</li>
								</ul>
					</div>
					 <div class='his' id='ent'>
					<p>Последние 10 операций</p>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Дата</td>
						<td class="table_td1">Сумма</td>
						<td class="table_td1">Счет</td>
						<td class="table_td1">Система</td>
						<td class="table_td1" style="width:20%;">Статус</td>
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
							<td class="table_td1"><?if(mysql_result($sql_ent,$i,'status')==2) echo "Выполнено"; else echo "Не выполнено";?></td>
					</tr>
					<?}?>
				</table>
				<center><a href='/his_all?t=1'> <button class='exchange_button'> Показать всю историю</button></a></center>
				</div>
									 <div class='his' id='vd'>
									 <p>Последние 10 операций</p>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Дата</td>
						<td class="table_td1">Сумма</td>
						<td class="table_td1">Счет</td>
						<td class="table_td1">Система</td>
						<td class="table_td1" style="width:20%;">Статус</td>
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
					<td class="table_td1"><?if(mysql_result($sql_wd,$i,'status')==2){ echo "Выполнено"; }elseif(mysql_result($sql_wd,$i,'status')==0){ echo "В обработке";} else {echo "Не выполнено";}?></td>
					</tr>
					<?}?>
				</table>
				<center><a href='/his_all?t=2'> <button class='exchange_button'> Показать всю историю</button></a></center>
				</div>
									 <div class='his' id='ex'>
									 <?
									 echo "<p>Сумма облак рефералов:<b>".$refbal.'</b></p>';
									 ?>
									 <p>Последние 10 операций</p>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Дата</td>
						<td class="table_td1">Источник</td>
						<td class="table_td1">Получено Cloud</td>
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
				<center><a href='/his_all?t=3'><button class='exchange_button'> Показать всю историю</button></a></center>
				<br>
				</div>
					 </div>
					 </div>
					 <script>
					 	$('.his').slideUp();
	$('#ent').slideDown(1);
	</script>
<?}else{?><script>document.location.href = '<?php echo BASE_PATH;?>login';</script><?}