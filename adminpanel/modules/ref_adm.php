<?php
$sql2=mysql_query("SELECT * FROM ref_table ORDER BY id");
$num2=mysql_num_rows($sql2);
$nid=$num2+1;
if($_GET['act']=='add')
{
	mysql_query("INSERT INTO ref_table (cly, referals) VALUES (0 , 0)");
}
if($_GET['act']=='del')
{
	mysql_query("DELETE FROM ref_table ORDER BY id DESC LIMIT 1 ");
}
if($_POST['ref0'])
{
	$sql1=mysql_query("SELECT * FROM ref_table ORDER BY id");
	$num=mysql_num_rows($sql1);
	for($i=0;$i<$num;$i++){
		$id=mysql_result($sql1,$i,'id');
		$r=$_POST['ref'.$i];
		$c=$_POST['cly'.$i];
		mysql_query("UPDATE ref_table SET referals = '$r', cly= '$c' WHERE id='$id'");
	}
}
$sql=mysql_query("SELECT * FROM ref_table");
$num=mysql_num_rows($sql)
?>
<a href="?a=ref_adm&act=add">Добавить поле</a>
<br>
<a href="?a=ref_adm&act=del">Удалить поле</a>
<form action="?a=ref_adm" method="post">
<?
for($i=0;$i<$num;$i++)
{
$ref=mysql_result($sql,$i,'referals');
$cly=mysql_result($sql,$i,'cly');
?>
Сумма облаков:<input type=text name='<?echo 'ref'.$i;?>' value='<?echo $ref;?>'>******* clodd<input type=text name='<?echo 'cly'.$i?>' value='<?echo $cly?>'><br>
<?}?>
<input type=submit value="Сохранить">
</form>