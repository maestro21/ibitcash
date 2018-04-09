<?php
$t=time-(60*60*24*7);
$sql=mysql_query("SELECT * FROM users WHERE isactive=1 AND refbal>'1' AND refbal<'10' ORDER BY refbal DESC");
echo "WE HAVE ".mysql_num_rows($sql)." USERS<BR>";
for($i=0;$i<mysql_num_rows($sql);$i++)
{
$uid=mysql_result($sql,$i,'id');
$cref=mysql_num_rows(mysql_query("SELECT * FROM users WHERE ref='$uid'"));
if(mysql_query("UPDATE users SET referals='$cref' WHERE id='$uid'")){
echo $i.")USER ".$uid." HAVE ".$cref." REFERALS<BR>";}
}
echo "END";