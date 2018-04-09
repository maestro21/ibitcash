<?
$lg=$_GET['login'];
$sql=mysql_query("SELECT * FROM history WHERE login='$lg' order by date desc limit 50");
echo 'user<b>:'.$lg.'</b>';
?>
<br>
<h1>Last <?echo mysql_num_rows($sql);?> history saves of this user</h1>
<br>
<?
for($i=0;$i<mysql_num_rows($sql);$i++)
{
$date=mysql_result($sql,$i,'date');
$comment=mysql_result($sql,$i,'comment');
$money=mysql_result($sql,$i,'money');
$num=mysql_num_rows($sql)-$i;
echo $num.') date:'.$date.' - '.date("d.m.y H:i", $date).'<br> comment:'.$comment.'<br>Currencies:'.$money.'<br><br>';
}