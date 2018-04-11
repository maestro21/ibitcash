<?
if($login){
$type=$_GET['t'];
$sql_ent=mysql_query("SELECT * FROM enter WHERE login='$login' AND status!=10 ORDER BY date DESC");
$sql_wd=mysql_query("SELECT * FROM output WHERE login='$login' ORDER BY date DESC");
$sql_ex=mysql_query("SELECT * FROM refbonus WHERE login='$login' ORDER by date DESC");
$sql_ex1=mysql_query("SELECT * FROM exchange WHERE login='$login' ORDER BY date DESC");
?>
<div style="margin-left:10%;margin-right:10%;padding-top:3%;">
<br>
<a href='/his_all?t=1'>История выводов</a> -
<a href='/his_all?t=2'>История вводов</a> -
<a href='/his_all?t=3'>История реферальных начислений</a> -
<a href='/his_all?t=4'>История обмена на Cloud</a> -
<br><br>
<?
switch($type)
{
	case 1:?>					 <p>История выводов</p>
	<div class='his' id='ent'>
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
				</div><?
				break;
	case 2:?>			 <p>История вводов</p><div class='his' id='vd'>
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
								case 7: echo 'bitcoin cash';
								break;
								case 8: echo 'Ethereum';
								break;
							}
							?></td>
							<td class="table_td1"><?if(mysql_result($sql_wd,$i,'status')==2) echo "Выполнено"; else echo "Не выполнено";?></td>
					</tr>
					<?}?>
				</table>
				</div><?
				break;
	case 3:?><p>История реферальных начислений</p><div class='his' id='ex'>
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
				<br>
				</div><?
				break;
	case 4:?><p>История обмена на  Cloud</p><div class='his' id='ex'>
					<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Дата</td>
						<td class="table_td1">Сумма</td>
						<td class="table_td1">Получeно Cloud</td>
						<td class="table_td1">Система</td>
					</tr>
					<?for($i=0;$i<mysql_num_rows($sql_ex1);$i++)
					{
						$date=date("d.m.y H:i", mysql_result($sql_ex1,$i,'date'));
						
						?>
					<tr style="background: #fff;">
							<td class="table_td1"><?echo $date;?></td>
							<td class="table_td1"><?echo mysql_result($sql_ex1,$i,'sum');?></td>
							<td class="table_td1"><?echo number_format(mysql_result($sql_ex1,$i,'sumc'),8,',','');?></td>
							<td class="table_td1"><?
							
							$ps=mysql_result($sql_ex1,$i,'paysys');
							switch($ps){
								case 3: echo 'Bitcoin';
								break;
								case 4: echo 'Dogecoin';
								break;
								case 5: echo 'Litecoin';
								break;
								case 6: echo 'Ripple';
								break;
								case 7: echo 'bitcoin cash';
								break;
								case 8: echo 'Ethereum';
								break;
							}
							?></td>
					</tr>
					<?}?>
				</table>
				</div>
					<?
				break;
		
	
	
}?></div><?
}else{?><script>document.location.href = '<?php echo BASE_PATH;?>login';</script><?}
?>