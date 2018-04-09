<?
$lg = 'Служба поддержки';
if($_GET['m']=='send')
{
$id=intval($_GET['sid']);
$sql=mysql_query("SELECT * FROM tb_tickets WHERE id='$id'");
$fa=intval($_GET['f']);
if(mysql_num_rows($sql)>0)
{
	$t=time();
	$body=mysql_real_escape_string($_POST['text']);
	mysql_query("INSERT INTO tb_ticket_messages (body,ticket_id,login,date) VALUES ('$body', '$id', '$lg', '$t')");
	echo 'Сообщение отправлено';
}
else
{
	echo 'Wrong request';
}
	
}
if($_GET['m']=='close')
{
	$id=intval($_GET['id']);
	$sql=mysql_query("UPDATE tb_tickets SET status=1 WHERE id='$id'");
	echo 'Тикет Закрыт<br>';
}
if($_GET['tiks']=='closed'){
	echo '<h1>Закрытые тикеты:</h1><br>';
	$sql=mysql_query("SELECT * FROM tb_tickets WHERE status=1");
	$title=mysql_result($sql,$i,'theme');
	$tid=mysql_result($sql,$i,'id');
	$nm=mysql_result($sql,$i,'login');
	for($i=0;$i<mysql_num_rows($sql);$i++)
{
		if($i%2==0)
	{
		$bgc='#CCCCCC';
		$sql_us=mysql_query("SELECT * FROM users WHERE login='$nm'");
		$uid=mysql_result($sql_us,0,'id');
	}
	else{
		$bgc='#DDDDDD';
		$uid='adm';
	}

	$date=date("d.m.y H:i", mysql_result($sql,$i,'date'));
	?>
	<table style='width:100%;background-color:<?echo $bgc;?>;'>
	<tr>
	<td style='font-size:18px;width:70%;'>
	<?echo $title;?><br><br>
	</td>
	<td style='font-size:16px;color:#FF4444';><b><?echo $nm.'('.$uid.')';?></b>
	</td>
	</tr>
	<tr>
	<td style='font-size:12px;color:#FF5555;'>
	<a href='?a=tickets&m=read&id=<?echo $tid?>'>Почитать</a>
	<span style='color:red'>
	|
	</span>
	<a href='?a=tickets&m=del&id=<?echo $tid?>'>Удалить</a>
	</td>
	<td style='font-size:12px;'>
	<b><?echo $date?></b>
	</td>
	</tr>
	</table>
		<hr>
	<?
	}
}
if($_GET['tiks']=='open' or $_GET['fa']==1)
{
	$sql=mysql_query("SELECT * FROM tb_tickets WHERE status=0");
echo '<h1>Открытые тикеты:</h1><br>';
for($i=0;$i<mysql_num_rows($sql);$i++)
{		$nm=mysql_result($sql,$i,'login');
	$tid=mysql_result($sql,$i,'id');
	$sql_m=mysql_query("SELECT * FROM tb_ticket_messages WHERE ticket_id='$tid' ORDER by DATE DESC");
	$l=mysql_result($sql_m,0,'login');
	if($nm==$l || mysql_num_rows($sql_m)==0){
		if($i%2==0)
	{
		$bgc='#CCCCCC';
		$sql_us=mysql_query("SELECT * FROM users WHERE login='$nm'");
		$uid=mysql_result($sql_us,0,'id');
	}
	else{
		$bgc='#DDDDDD';
		$uid='adm';
	}

	$title=mysql_result($sql,$i,'theme');
	$date=date("d.m.y H:i", mysql_result($sql,$i,'date'));
	?>
	<table style='width:100%;background-color:<?echo $bgc;?>'>
	<tr>
	<td style='font-size:18px;width:70%;'>
	<?echo $title;
	?><br><br>
	</td>
	<td style='font-size:16px;color:#FF4444';><b><?echo $nm.'('.$uid.')';?></b>
	</td>
	</tr>
	<tr>
	<td style='font-size:10px;color:#FF5555;'>
	<a href='?a=tickets&m=chat&f=1&id=<?echo $tid?>'>Ответить</a>
	<span style='color:red'>
	|
	</span>
	<a href='?a=tickets&m=close&fa=1&id=<?echo $tid?>'>Закрыть</a>
	<span style='color:red'>
	|
	</span>
	<a href='?a=tickets&m=bnd&id=<?echo $tid?>'>Бан автора/Удалить</a>
	</td>
	<td style='font-size:12px;'>
	<b><?echo $date?></b>
	</td>
	</tr>
	</table>
	<hr>
	<?
	}
}

}
if($_GET['tiks']=='wa' or $_GET['fa']==2)
{
	$sql=mysql_query("SELECT * FROM tb_tickets WHERE status=0");
echo '<h1>Тикеты с ответом:</h1><br>';
for($i=0;$i<mysql_num_rows($sql);$i++)
{
	$tid=mysql_result($sql,$i,'id');
		$sql_m=mysql_query("SELECT * FROM tb_ticket_messages WHERE ticket_id='$tid' ORDER by DATE DESC");
	$nm=mysql_result($sql,$i,'login');
			$l=mysql_result($sql_m,0,'login');
	if($nm!=$l && mysql_num_rows($sql_m)!=0){
	if($i%2==0)
	{
		$bgc='#CCCCFF';
	}
	else{
		$bgc='#DDDDFF';
	}
	$title=mysql_result($sql,$i,'theme');

	$date=date("d.m.y H:i", mysql_result($sql,$i,'date'));
	?>
	<table style='width:100%;background-color:<?echo $bgc;?>'>
	<tr>
	<td style='font-size:18px;width:70%;'>
	<?echo $title;
	?><br><br>
	</td>
	<td style='font-size:16px;color:#FF4444';><b><?echo $nm?></b>
	</td>
	</tr>
	<tr>
	<td style='font-size:10px;color:#FF5555;'>
	<a href='?a=tickets&m=chat&f=2&id=<?echo $tid?>'>Ответить</a>
	<span style='color:red'>
	|
	</span>
	<a href='?a=tickets&m=close&fa=2&id=<?echo $tid?>'>Закрыть</a>
	<span style='color:red'>
	|
	</span>
	<a href='?a=tickets&m=bnd&id=<?echo $tid?>'>Бан автора/Удалить</a>
	</td>
	<td style='font-size:12px;'>
	<b><?echo $date?></b>
	</td>
	</tr>
	</table>
	<hr>
	<?
	}
}

}
if($_GET['m']=='chat')
{
	$tid=intval($_GET['id']);
	$sql_m=mysql_query("SELECT * FROM tb_ticket_messages WHERE ticket_id='$tid'");
	for($i=0;$i<mysql_num_rows($sql_m);$i++)
{
	$name=mysql_result($sql_m,$i,'login');
	$body=mysql_result($sql_m,$i,'body');
	$date=date("d.m.y H:i", mysql_result($sql_m,$i,'date'));
	if($name==$lg){$ct='#AAAAAA';}else{$ct='#ABABAB';}
	?>
	<table style='position:relative;background-color:<?echo $ct;?>;<?if($ct=='#AAAAAA'){echo 'margin-left:100px;';}?>'>
	<tr>
	<td style='margin:15px;padding:15px;width:100px'>
	<?echo $name;?>
	</td>
	<td style='margin:15px;padding:15px;width:400px;' align=right;>
	<?echo $date;?>
	</td>
	<tr>
	<td colspan=2 style="margin:15px;padding:15px;width:500px">
	<?echo $body;?>
	</td>
	</tr>
	</table>
	<BR>
	<BR>
	<?
}
?>
<BR>
	<BR>
	<center>
<form action='?a=tickets&m=send&fa=<?echo $_GET['f'];?>&sid=<?echo $tid?>' method=post>
<a href='?a=tickets&m=close&id=<?echo $tid?>'>Закрыть тикет</a>
Отправить сообщение:<br><textarea rows="8" cols="40" name="text"></textarea><br>
<input type=submit value="Отправить">
</form>
</center>
	<br>
	<br>
	<a href='?a=tickets&fa=<?echo $_GET['f'];?>'>Назад</a>
<?
}elseif($_GET['m']=='bnd')
{
	$id=intval($_GET['id']);
	$sql=mysql_query("SELECT * FROM tb_tickets WHERE id='$id'");
	mysql_query("DELETE FROM tb_tickets WHERE id='$id'");
	$ulg=mysql_result($sql,0,'login');
	mysql_query("UPDATE users SET status=3 WHERE login='$ulg'");
	echo 'Юзер забанен/Тикет удалён';
	?>
	<br>
	<br>
	<a href='?a=tickets'>Назад</a>
	<?
}elseif($_GET['m']=='del')
{
		$id=intval($_GET['id']);
		mysql_query("DELETE FROM tb_tickets WHERE id='$id'");
		echo 'Тикет удалён';
	?>
	<br>
	<br>
	<a href='?a=tickets'>Назад</a>
	<?
	
}elseif($_GET['m']=='read')
{
	$tid=intval($_GET['id']);
	$sql_m=mysql_query("SELECT * FROM tb_ticket_messages WHERE ticket_id='$tid'");
	for($i=0;$i<mysql_num_rows($sql_m);$i++)
{
	$name=mysql_result($sql_m,$i,'login');
	$body=mysql_result($sql_m,$i,'body');
	$date=date("d.m.y H:i", mysql_result($sql_m,$i,'date'));
	if($name==$lg){$ct='#AAAAAA';}else{$ct='#ABABAB';}
	?>
	<table style='position:relative;background-color:<?echo $ct;?>;<?if($ct=='#AAAAAA'){echo 'margin-left:100px;';}?>'>
	<tr>
	<td style='margin:15px;padding:15px;width:100px'>
	<?echo $name;?>
	</td>
	<td style='margin:15px;padding:15px;width:400px;' align=right;>
	<?echo $date;?>
	</td>
	<tr>
	<td colspan=2 style="margin:15px;padding:15px;width:500px">
	<?echo $body;?>
	</td>
	</tr>
	</table>
	<BR>
<BR><?}?>
		<a href='?a=tickets'>Назад</a><?
}else{
?>
<a href='?a=tickets&tiks=open'>Открытые</a><br>
<a href='?a=tickets&tiks=wa'>Последний ответ от админа</a><br>
<a href='?a=tickets&tiks=closed'>Закрытые</a><br>
<?
}
	
