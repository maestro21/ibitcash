<h1>Бан пользователя</h1>
<?
if($_GET['login']){
	$lg=$_GET['login'];
}else{$lg='';}
?>
<form enctype="multipart/form-data" action="?a=ban_user&action=1" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="500000">
<table>
<tr>
<tr><td>Ник:</td><td><input name="login" value='<?echo $lg;?>' type=text></td></tr>
<td>
Скриншот(пруф)</td><td><input name="userfile" type="file"></td></tr>
<tr><td>Титул:</td><td><input name="title" type=text></td></tr>
<tr><td>Тело:</td><td><textarea name='body' cols=60 rows=10></textarea></td></tr>
<tr><td colspan=2><input type="submit" value="Забанить">
</form></td></tr></table>
<?
if($_GET['action']==1)
{
$uploaddir = '../img/';
$t=time();
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$t.$_FILES['userfile']['name'])) {
    print "<BR><BR>USER BANNED!";
	$title=$_POST['title'];
	$body=$_POST['body'];
	$lg=$_POST['login'];
	$img=$t.$_FILES['userfile']['name'];
	mysql_query("INSERT INTO ban_pr (title, date, body, img, login) VALUES ('$title', '$t', '$body', '$img', '$lg')");
	mysql_query("UPDATE users SET status=3 WHERE login='$lg'");
	echo '<br>'.$lg;
} else {
    print "There some errors!";
}
}