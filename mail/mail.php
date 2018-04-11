<?
if($login){
?>
<div style="margin-left:10%;margin-right:10%;"><br>	
<center><h1> Mail </h1><br></center>
<?if(!isset($_GET['read'])){
$sql=mysql_query("SELECT * FROM admmail WHERE login='$login' ORDER BY date DESC");	
if(mysql_num_rows($sql)>0){?>
<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">Subject</td>
						<td class="table_td1">Date</td>
					</tr>
<?
for($i=0;$i<mysql_num_rows($sql);$i++)
{
$theme=mysql_result($sql,$i,'theme');
$date=mysql_result($sql,$i,'date');
$st=mysql_result($sql,$i,'status');
?>
<tr style='background: #fff'>
<td class="table_td1"><a href='/mail?read=<?=$date;?>'><?echo $theme;?></a><?if ($st==1){echo ' <b>  - Непрочитано</b>';}?></td>
<td class="table_td1"><?echo date("d.m.y H:i", $date);?></td>
</tr>
<?
}
?>
</table><br>
</div>
<?}else{echo '<center><p>У вас пока нет сообщений!</p><br><br></center>';}
}else{
$date=$_GET['read'];
$sql=mysql_query("SELECT * FROM admmail WHERE login='$login' AND date='$date' LIMIT 1");
mysql_query("UPDATE admmail SET status=0 WHERE login='$login' AND date='$date' LIMIT 1");
?>
<table class="table_supp" cellpadding="5" style="width:100%;">
					<tr class="table_tr">
						<td class="table_td1" style="width:10%;">ibit Team</td>
						<td class="table_td1">Sent:<?echo date("d.m.y H:i", $date);?></td>
					</tr>
				</table>
									<h2><?echo mysql_result($sql,0,'theme');?></h2><br><p><?echo mysql_result($sql,0,'body');?></p><br><br><a href='/mail'>Back</a><br><br>
					
<?
}
}
else
{
?><script>document.location.href = '<?php echo BASE_PATH;?>login';</script><?
}