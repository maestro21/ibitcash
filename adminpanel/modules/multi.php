<a href="?a=multi&du=a">del all</a><br>
<a href="?a=multi&bu=a">ban all</a><br>
_________________<br>
_________________<br>
<?
if($_GET['du'])
{
	$du=$_GET['du'];
	if($du!='a')
	{
		$sql_m=mysql_query("SELECT * FROM multi WHERE u_id='$du'");
		$cip=mysql_result($sql_m,0,'ip');
		mysql_query("DELETE FROM users WHERE ip='$cip'");
		mysql_query("DELETE FROM multi WHERE u_id='$du'");
	}
	else
	{
		$sql=mysql_query("SELECT * FROM multi");
		$nums=mysql_num_rows($sql);
		for($i=0;$i<$nums;$i++)
			{
				$cip=mysql_result($sql,$i,'ip');
				mysql_query("DELETE FROM users WHERE ip='$cip'");
			}
			mysql_query("DELETE FROM multi");
	}
}
if($_GET['bu'])
{
	$du=$_GET['bu'];
	if($du!='a')
	{
		$sql_m=mysql_query("SELECT * FROM multi WHERE u_id='$du'");
		$cip=mysql_result($sql_m,0,'ip');
		mysql_query("UPDATE users SET status='3' WHERE ip='$cip'");
		mysql_query("DELETE FROM multi WHERE u_id='$du'");
	}
	else
	{
		$sql=mysql_query("SELECT * FROM multi");
		$nums=mysql_num_rows($sql);
		for($i=0;$i<$nums;$i++)
			{
				$cip=mysql_result($sql,$i,'ip');
				mysql_query("UPDATE users SET status='3' WHERE ip='$cip'");
			}
			mysql_query("DELETE FROM multi");
	}
}
$sql=mysql_query("SELECT * FROM multi");
$nums=mysql_num_rows($sql);
for($i=0;$i<$nums;$i++)
{
$cid=mysql_result($sql,$i,'u_id');
echo '_________________';?><br><?
echo 'ip:   '.mysql_result($sql,$i,'ip');?><br><?
echo 'ids:   '.mysql_result($sql,$i,'m_ids');?><br><?
?><a href="?a=multi&du=<?=$cid?>">del</a>____<a href="?a=multi&bu=<?=$cid?>">ban</a><br><?
echo '_________________';?><br><?
}
?>