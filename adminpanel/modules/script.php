<?
$sql=mysql_query("SELECT * FROM users");
for($i=0;$i<mysql_query($sql);$i++)
{
$sum=0;
$uid=mysql_result($sql,$i,'id')
$sql_nr=mysql_query("SELECT * FROM users WHERE ref='$uid'");
	 for($j=0;$j<mysql_num_rows($sql_nr);$j++)
	 {
		 $sum=$sum+mysql_result($sql_nr,$j,'cloud');
	 }
	  mysql_query("UPDATE users SET refbal = '$sum' WHERE id='$uid'");
}
?>