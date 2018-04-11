<div style="margin-left:29%;margin-right:15%;text-align:center>">
<h1> Активация Аккаунта</h1>
<br><br>
<?
if(!$_GET['code'])
{
?>
	<p>Для продолжения работы с сайтом активируйте ваш аккаунт!</p>
<?
if(mysql_num_rows(mysql_query("SELECT * FROM activation WHERE uid='$login'"))>0)
{
	?>
	<p>Код активации выслан вам на почту.</p>
<?

}else{
		?>
	<p>Ваш код активации был выслан вам на эмейл!</p>
	<?
$subject = DOMAIN . " активация аккаунта";
$code=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
mysql_query("INSERT INTO activation (uid, code) VALUES ('$login', '$code')");
			$headers = "From: ".$adminmail."\n";
			$headers .= "Reply-to: ".$adminmail."\n";
			$headers .= "X-Sender: < ".$cfgURL." >\n";
			$headers .= "Content-Type: text/html; charset=utf-8\n";

			$text = "<b>".$ulogin."!</b><br />
			 Ссылка активации:<a href=\"". BASE_PATH . "/activation?code=".$code."&l=".$login."\">Активировать!</a>";

			mail($user_mail, $subject, $text, $headers);
}
}else{
$code=htmlspecialchars($_GET['code'], ENT_QUOTES);
$l=htmlspecialchars($_GET['l'], ENT_QUOTES);
if(mysql_num_rows(mysql_query("SELECT * FROM activation WHERE uid='$l' AND code='$code'"))>0)
{
	mysql_query("UPDATE users SET isactive=1 WHERE login='$l'");
	echo "<p>Аккаунт успешно активирован!</p>";
}
	
}
?><br><br><br><br>
</div>