<a href='?a=addnews&action=2'>Новая новость</a>
<br>
<?if($_GET['action']==2){?>
<form enctype="multipart/form-data" action="?a=addnews&action=1" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
<h1>Новая новость</h1>
<table>
<tr>
<td>
Изображение новости</td><td><input name="userfile" type="file"></td></tr>
<td>Титул:</td><td><input name="title" type=text></td></tr>
<td>Тело:</td><td><textarea name='body' cols=60 rows=10></textarea></td></tr>
<td colspan=2>
<p><input name="lng" type="radio" value="ru" checked>RU</p>
<p><input name="lng" type="radio" value="en">EN</p>
<input type="submit" value="Отправить">
</form></td></tr></table>
<?
}
if($_GET['action']==1)
{
$uploaddir = '../img/';
$t=time();
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$t.$_FILES['userfile']['name'])) {
    print "File is valid, and was successfully uploaded.";
	$lg=$_POST['lng'];
	$hd=0;
	if($lg=='en'){$hd=2;}
	$title=$_POST['title'];
	$body=$_POST['body'];
	$img=$t.$_FILES['userfile']['name'];
	$str_sql="INSERT INTO tb_news (title, date, body, image, hidden) VALUES ('$title', '$t', '$body', '$img', '$hd')";
	if(mysql_query($str_sql)){echo 'OK!';}else{echo 'NO!!!';}
	echo '<br>'.' * '.$title.' * '.$t.' * '.$body.' * '.$img.' * '.$hd;
} else {
    print "There some errors!";
}
}
if($_GET['action']==3)
{
$t=$_GET['t'];
$sql=mysql_query("DELETE FROM tb_news WHERE date='$t'");
}
if($_GET['action']!=2){
$sql_n=mysql_query("SELECT * FROM tb_news WHERE hidden=0 OR hidden=2 ORDER by date DESC");
?>
<div style="margin-left:10%;margin-right:10%;"><br>	
<?
for($i=0;$i<mysql_num_rows($sql_n);$i++)
{
?>
<div style='border:1px solid black; padding:5px;margin:5px'>
<?
$title=mysql_result($sql_n,$i,'title');
$date=date("d.m.y H:i", mysql_result($sql_n,$i,'date'));
$image=mysql_result($sql_n,$i,'image');
$body=mysql_result($sql_n,$i,'body');
echo $title.'<br>'.$date.'<br><img src="../img/'.$image.'" width=100 height=30/><br>'.$body.'<br><br>';
?><a href='?a=addnews&action=3&t=<? echo mysql_result($sql_n,$i,'date');?>'>Delete!</a></div><?}}?></div>