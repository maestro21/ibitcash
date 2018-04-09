<a href='?a=referal_table'>Сумма облак рефералов</a> - <a href='?a=referal_table&sort=1'>Кол-во рефералов</a> <br><br>
<?
if($_GET['sort']==1)
{
?>
<table>
<tr>
<td>
Имя
</td>
<td>
Сумма облак
</td>
<td>
Кол-во рефов
</td>
</tr>
<?
$sql=mysql_query("SELECT * FROM users WHERE isactive=1 and refbal>1 order by referals DESC");
for($i=0;$i<mysql_num_rows($sql);$i++){
$ul=mysql_result($sql,$i,'login');
$rb=mysql_result($sql,$i,'refbal');
$rs=mysql_result($sql,$i,'referals');
$k=$i+1;
?>
<tr>
<td>
<?
echo $k.")<b>".$ul."</b>";
?>
</td>
<td>
<?
echo $rb;
?>
</td>
<td>
<?
echo $rs;
?>
</td>
</tr>
<?
}
?>
</table>
<?}else{?>
<table>
<tr>
<td>
Имя
</td>
<td>
Сумма облак
</td>
<td>
Кол-во рефов
</td>
</tr>
<?
$sql=mysql_query("SELECT * FROM users WHERE isactive=1 and refbal>1 order by refbal DESC");
for($i=0;$i<mysql_num_rows($sql);$i++){
$ul=mysql_result($sql,$i,'login');
$rb=mysql_result($sql,$i,'refbal');
$rs=mysql_result($sql,$i,'referals');
$k=$i+1;
?>
<tr>
<td>
<?
echo $k.")<b>".$ul."</b>";
?>
</td>
<td>
<?
echo $rb;
?>
</td>
<td>
<?
echo $rs;
?>
</td>
</tr>
<?
}
?>
</table>
<?}