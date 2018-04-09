<?
$sql=mysql_query("SELECT * FROM enter WHERE status=10 order by date DESC");
?>
<table border=1 style="padding:5px;">
<?
for($i=0;$i<mysql_num_rows($sql);$i++)
{
	$login=mysql_result($sql,$i,'login');
	$paysys=mysql_result($sql,$i,'paysys');
	$purse=mysql_result($sql,$i,'purse');
	$date=mysql_result($sql,$i,'date');
	$id=mysql_result($sql,$i,'id');
?>
<tr>
<td style="padding:5px;">
<?echo $login;?>
</td>
<td style="padding:5px;">
<?echo $paysys;?>
</td>
<td style="padding:5px;">
<?echo $purse;?>
</td>
<td style="padding:5px;">
<?echo $date;?>
</td>
<td style="padding:5px;">
<a href="?a=payment&id=<?echo $id;?>&l=<?echo $login?>">Подтвердить</a>
</td>
</tr>
<?
}
?>
</table>