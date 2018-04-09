<?php
if($_GET['save']==1)
{
$df2=intval($_POST['df1']);
$dt2=intval($_POST['dt1']);
$ef2=intval($_POST['ef1']);
$et2=intval($_POST['et1']);
$int2=intval($_POST['int1']);
if(mysql_query("UPDATE `tb_konk` SET `status`=1,`dogefrom`='$df2',`dogeto`='$dt2',`ethfrom`='$ef2',`ethto`='$et2',`interval`='$int2' WHERE 1"))
{
echo 'SAVED!<br>';
}
}
$sql=mysql_query("SELECT * FROM tb_konk");
$df=mysql_result($sql,0,'dogefrom');
$dt=mysql_result($sql,0,'dogeto');
$ef=mysql_result($sql,0,'ethfrom');
$et=mysql_result($sql,0,'ethto');
$int=mysql_result($sql,0,'interval');
$nt=date("d.m.y H:i", mysql_result($sql,0,'next_win'));
?>
<BR>
<BR>
<BR>
<center>
Следующая раздача бонусов:<? echo $nt;?><br><br>
<form action='?a=timebonus&save=1' method='post'>
DOGE:<BR><BR>
От<input type=text name='df1' value='<?echo $df?>'><BR>
До<input type=text name='dt1' value='<?echo $dt?>'> <BR><BR>
ETHEREUM(Умножаеться на 0.0001)<BR><BR>
От<input type=text name='ef1' value='<?echo $ef?>'><BR>
До<input type=text name='et1' value='<?echo $et?>'><BR><BR>
Обновляеться каждые (секунд)<input type=text name='int1' value='<?echo $int?>'><BR><BR>
<input type=submit>
</form>
</center>