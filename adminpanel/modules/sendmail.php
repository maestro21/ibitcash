<form method='post' action="?a=sendmail">
<table>
<tr>
<td> Ник </td><td> <input type=text name='lg'></td>
</tr>
<tr>
<td> Тема </td><td> <input type=text name='th'></td>
</tr>
<table>
<p><input type="checkbox" name="a" value="5"> Отправить всем</p>
<textarea rows=10 cols=20 name='body'></textarea>
<input type=submit value='Отправить'> 
</form>
<?
if($_GET['del'])
{
	$date=$_GET['del'];
	mysql_query("DELETE FROM admmail WHERE date='$date'");
	echo 'Сообщение удалено';
}
if($_POST['th'])
{
	$login=$_POST['lg'];
	$theme=$_POST['th'];
	$body=$_POST['body'];
	$t=time();
	if($_POST['a']!=5){
	mysql_query("INSERT INTO admmail (login, body, date, status, theme) VALUES ('$login', '$body', '$t', 1, '$theme')");
	}else{
		$sql=mysql_query("SELECT * FROM users WHERE status=0");
		for($i=0;$i<mysql_num_rows($sql);$i++)
		{
			$login=mysql_result($sql,$i,'login');
			mysql_query("INSERT INTO admmail (login, body, date, status, theme) VALUES ('$login', '$body', '$t', 1, '$theme')");
		}
	}
	?><script>alert('Сообщение отправлено!');</script><?
}?>
<br>
<?
$sql=mysql_query("SELECT * FROM admmail ORDER BY date DESC");
for($i=0;$i<mysql_num_rows($sql);$i++)
{
	$date=mysql_result($sql,$i,'date');
	$login=mysql_result($sql,$i,'login');
	$body=mysql_result($sql,$i,'body');
	$status=mysql_result($sql,$i,'status');
	$theme=mysql_result($sql,$i,'theme');
	echo '-----<br>Тема :'.$theme.'<br>Кому :'.$login.'<br>Когда :'.date("d.m.y H:i", $date).'<br>Текст:<p>'.$body.'</p><br>Status :'.$status.'<br>';
	echo "<a href='?a=sendmail&del=".$date."'>Удалить</a><br><br><br>";
}