<div style="margin-left:29%;margin-right:15%;text-align:center>">
<h1>Account activation</h1>
<br><br>
<?
if(!$_GET['code'])
{
?>
	<p>You must activate your account in order to proceed</p>
<?
if(mysql_num_rows(mysql_query("SELECT * FROM activation WHERE uid='$login'"))>0)
{
	?>
	<p>Activation code was sent to your email.</p>
<?
}else{
		?>
	<p>Your activation code was sent to your email!</p>
	<?
$subject = DOMAIN . " account activation";
$code=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
mysql_query("INSERT INTO activation (uid, code) VALUES ('$login', '$code')");
			$headers = "From: ".$adminmail."\n";
			$headers .= "Reply-to: ".$adminmail."\n";
			$headers .= "X-Sender: < ".$cfgURL." >\n";
			$headers .= "Content-Type: text/html; charset=utf-8\n";

			$text = "<b>".$login."!</b><br />
			 Activation link:<a href=\"" . BASE_PATH . "/activation?code=".$code."&l=".$login."\">Activate!</a>";

			mail($user_mail, $subject, $text, $headers);
}
}else{
$code=htmlspecialchars($_GET['code'], ENT_QUOTES);
$l=htmlspecialchars($_GET['l'], ENT_QUOTES);
if(mysql_num_rows(mysql_query("SELECT * FROM activation WHERE uid='$l' AND code='$code'"))>0)
{
	mysql_query("UPDATE users SET isactive=1 WHERE login='$l'");
	echo "<p>Your account has been successfully activated!</p>";
}
	
}
?><br><br><br><br>
</div>