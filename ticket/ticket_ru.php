<?
defined('ACCESS') or die();
include '../att.php';
if($login) {
	?><center><br><p id="supp_h" style='margin:auto;'>Служба поддержки</p></center><?
if($_GET['new']=='create')
{
?>			<form method=post action='?new=save'>
<div style="margin-left:29%;margin-right:15%;"><br>
							<input type="text" class="theme" name='title' placeholder="&nbsp;&nbsp;Тема обращения"><br>
							<textarea name="text" class="sup_area" placeholder="&nbsp;&nbsp;Опишите вашу проблему"></textarea><br>			
							<input type="text" class="inp" name="code" size="20" maxlength="5"  placeholder="&nbsp;&nbsp;CAPTCHA" class="number"/> 
							<img class="capcha" src="../captcha.php" border="0" alt="КАПЧА" /><br>
							<br><a href="#"><button class="submit sup" name="" type="submit">Отправить</button></a>
								</div>	<br><br>
				</form>

<?
}
elseif($_GET['new']=='save')
{
$title=mysql_real_escape_string($_POST['title']);
$body=mysql_real_escape_string($_POST['text']);
$code=htmlspecialchars($_POST["code"], ENT_QUOTES);
$t=time();
if(isset($title,$body) AND mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND ip = '".getip()."' AND code = '".$code."'"))>0)
{
	mysql_query("INSERT INTO tb_tickets (login, theme, date) VALUES ('$login', '$title','$t')");
	$sql=mysql_query("SELECT * FROM tb_tickets WHERE login='$login' AND theme='$title' AND date='$t'");
	$tid=mysql_result($sql,0,'id');
	mysql_query("INSERT INTO tb_ticket_messages (login, body, ticket_id, date) VALUES ('$login', '$body', '$tid', '$t')");
	?><SCRIPT>showatt(4);</SCRIPT><?
}else{
	?><SCRIPT>showatt(3);</SCRIPT><?
}
}elseif($_GET['new']=='close')
{
	$id=intval($_GET['tid']);
	$sql=mysql_query("UPDATE tb_tickets SET status=1 WHERE id='$id'");
	?><SCRIPT>showatt(2);</SCRIPT><?
	?>
	<?
}elseif(isset($_GET['id']))
{
$id=mysql_real_escape_string($_GET['id']);
$sql=mysql_query("SELECT * FROM tb_tickets WHERE id='$id' AND login='$login'");
$st=mysql_result($sql,0,'status');
if(mysql_num_rows($sql)>0)
{
	?>
	<span style='font-size:1.2em'>
	<?
?> </span> <br><?
$sql_m=mysql_query("SELECT * FROM tb_ticket_messages WHERE ticket_id='$id' ORDER BY date ");
for($i=0;$i<mysql_num_rows($sql_m);$i++)
{
	$name=mysql_result($sql_m,$i,'login');
	$body=mysql_result($sql_m,$i,'body');
	$date=date("d.m.y H:i", mysql_result($sql_m,$i,'date'));
	if($name==$login){$ct='#DDDDFF';}else{$ct='#BBBBFF';}
	?><center>
	<table style='border-radius: 0.5em;
	position:relative;
	background-color:<?echo $ct;?>;<?if($ct=='#DDDDFF'){echo 'margin-left:7.5em;';}?>'>
	<tr>
	<td style='margin:1em;padding:1em;width:7.5em; text-decoration: underline;' align="left";>
	<?echo $name;?>
	</td>
	<td style='margin:1em;padding:1em;width:25em;' align="right";>
	<?echo $date;?><hr>
	</td>
	<tr>
	<td colspan=2 style="margin:1em;padding:1em;width:32.5em;">
	<?echo $body;?>
	</td>
	</tr>
	</table></center>
	<BR>
	<BR>
	<?
}
// Okno chata
if($st==0){
?>
<BR>
	<BR>
	<center>
<center><form action='?new=send&sid=<?echo $id?>' method=post><a href='?new=close&tid=<?echo $id?>'>Проблема решена, закрыть обращение</a><br><br>
Отправить сообщение:<br><br>							<textarea name="text" class="sup_area" placeholder="&nbsp;&nbsp;Введите сообщение"></textarea><br>			
							<input type="text" class="inp" name="code" size="20" maxlength="5"  placeholder="&nbsp;&nbsp;CAPTCHA" class="number"/> 
							<img class="capcha" src="../captcha.php" border="0" alt="КАПЧА" /><br>
							<br><a href="#"><button class="submit sup" name="" type="submit">Отправить</button></a><br><br>

</form>
</center>
<?
}
}
else{
	echo "Wrong id of ticket!";
}


}elseif($_GET['new']=='send')
{
$id=intval($_GET['sid']);
$code=htmlspecialchars($_POST["code"], ENT_QUOTES);
$sql=mysql_query("SELECT * FROM tb_tickets WHERE id='$id' AND login='$login'");
	$body=mysql_real_escape_string($_POST['text']);
if(mysql_num_rows($sql)>0 AND $body AND mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND ip = '".getip()."' AND code = '".$code."'"))>0)
{
	$t=time();
	mysql_query("INSERT INTO tb_ticket_messages (body,ticket_id,login,date) VALUES ('$body', '$id', '$login', '$t')");
	?><SCRIPT>showatt(1);</SCRIPT><?
}
else
{
	?><SCRIPT>showatt(3);</SCRIPT><?
}
}
if(!isset($_GET['id']) and $_GET['new']!='create'){
?>
<center><br>


<table class="table_supp" width="80%">
							<tr class="supp_tr">
								<td><b>Тема</b></td>
								<td><b>Дата</b></td>
								<td><b>Статус</b></td>
							</tr>
<?
$sql=mysql_query("SELECT * FROM tb_tickets WHERE login='$login' ORDER BY date DESC");
for($i=0;$i<mysql_num_rows($sql);$i++)
{
	$date=date("d.m.y H:i", mysql_result($sql,$i,'date'));
	$theme=mysql_result($sql,$i,'theme');
	$status=mysql_result($sql,$i,'status');
	$tid=mysql_result($sql,$i,'id');?>
								<tr>
								<td><a href='?id=<?=$tid?>'><?echo $theme;?></a></td>
								<td><?echo $date;?></td>
								<td><b><?
	if($status==0){echo "Открыт";}else{echo "Закрыт";}?></b></td>
							</tr><?
	
}
?></table><br><div>
<a href='?new=create' style="text-align:center;">
<button class="submit sup" type=submit>Создать тикет</button>
</a></div><br><br></center>
<?
}
}else{?><script>document.location.href = '<?php echo BASE_PATH;?>login';</script><?}
?>
