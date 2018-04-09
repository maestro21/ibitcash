<?php
$s=$_GET['s'];
if ($s==1)
{
$c_btc=$_POST['c_btc'];
$c_dgc=$_POST['c_dgc'];
$c_ltc=$_POST['c_ltc'];
$c_dsh=$_POST['c_dsh'];
$c_mnr=$_POST['c_mnr'];
$c_eth=$_POST['c_eth'];
$c_cld=$_POST['c_cld'];
$m_btc=$_POST['m_btc'];
$m_dgc=$_POST['m_dgc'];
$m_ltc=$_POST['m_ltc'];
$m_dsh=$_POST['m_dsh'];
$m_mnr=$_POST['m_mnr'];
$m_eth=$_POST['m_eth'];
$beth=$_POST['beth'];
$bdgc=$_POST['bdgc'];
$nc=$_POST['nc'];
$gc=$_POST['gc'];
$prm=$_POST['prm'];
mysql_query("UPDATE tb_srv_stats SET btc='$c_btc',dgc='$c_dgc',ltc='$c_ltc',dsh='$c_dsh',mnr='$c_mnr',eth='$c_eth',cloud='$c_cld',min_btc='$m_btc',min_dgc='$m_dgc',min_ltc='$m_ltc',min_dsh='$m_dsh',min_mnr='$m_mnr',min_eth='$m_eth',need_cld='$nc',get_cld='$gc',param1='$prm',bdgc='$bdgc',beth='$beth'");
}
$sql=mysql_query("SELECT * FROM tb_srv_stats");
$c_btc=mysql_result($sql,0,'btc');
$c_dgc=mysql_result($sql,0,'dgc');
$c_ltc=mysql_result($sql,0,'ltc');
$c_dsh=mysql_result($sql,0,'dsh');
$c_mnr=mysql_result($sql,0,'mnr');
$c_eth=mysql_result($sql,0,'eth');
$bdgc=mysql_result($sql,0,'bdgc');
$beth=mysql_result($sql,0,'beth');
$c_cld=mysql_result($sql,0,'cloud');
$m_btc=mysql_result($sql,0,'min_btc');
$m_dgc=mysql_result($sql,0,'min_dgc');
$m_ltc=mysql_result($sql,0,'min_ltc');
$m_dsh=mysql_result($sql,0,'min_dsh');
$m_mnr=mysql_result($sql,0,'min_mnr');
$m_eth=mysql_result($sql,0,'min_eth');
$nc=mysql_result($sql,0,'need_cld');
$gc=mysql_result($sql,0,'get_cld');
$prm=mysql_result($sql,0,'param1');
?>
<form action='adminstation.php?a=params&s=1' method=post>
<table>
<tr>
<td colspan=2>
Курсы валют
</td>
</tr>
<tr>
<td>
BTC
</td>
<td>
<input type=text name='c_btc' value=<?=$c_btc?>>
</td>
</tr>
<tr>
<td>
DGC
</td>
<td>
<input type=text name='c_dgc' value=<?=$c_dgc?>>
</td>
</tr>
<tr>
<td>
LTC
</td>
<td>
<input type=text name='c_ltc' value=<?=$c_ltc?>>
</td>
</tr>
<tr>
<td>
DSH
</td>
<td>
<input type=text name='c_dsh' value=<?=$c_dsh?>>
</td>
</tr>
<tr>
<td>
MNR
</td>
<td>
<input type=text name='c_mnr' value=<?=$c_mnr?>>
</td>
</tr>
<tr>
<td>
Eth
</td>
<td>
<input type=text name='c_eth' value=<?=$c_eth?>>
</td>
</tr>
<tr>
<td>
Cloud
</td>
<td>
<input type=text name='c_cld' value=<?=$c_cld?>>
</td>
</tr>
<tr>
<td colspan=2>
Минимальная сумма вывода
</td>
</tr>
<tr>
<td>
BTC
</td>
<td>
<input type=text name='m_btc' value=<?=$m_btc?>>
</td>
</tr>
<tr>
<td>
DGC
</td>
<td>
<input type=text name='m_dgc' value=<?=$m_dgc?>>
</td>
</tr>
<tr>
<td>
LTC
</td>
<td>
<input type=text name='m_ltc' value=<?=$m_ltc?>>
</td>
</tr>
<tr>
<td>
DSH
</td>
<td>
<input type=text name='m_dsh' value=<?=$m_dsh?>>
</td>
</tr>
<tr>
<td>
MNR
</td>
<td>
<input type=text name='m_mnr' value=<?=$m_mnr?>>
</td>
</tr>
<tr>
<td>
Eth
</td>
<td>
<input type=text name='m_eth' value=<?=$m_eth?>>
</td>
</tr>
<tr>
<td colspan=2>
Прочие параметры
</td>
</tr>
<tr>
<td>
Нужная сумма облака рефералов для бонуса
</td>
<td>
<input type=text name='nc' value=<?=$nc?>>
</td>
</tr>
<tr>
<td>
получаемая сумма облаков 
</td>
<td>
<input type=text name='gc' value=<?=$gc?>>
</td>
</tr>
<tr>
<td>
Множитель на расчёт майнинга (стд - 6000)
</td>
<td>
<input type=text name='prm' value=<?=$prm?>>
</td>
</tr>
<tr>
<td>
Ежедневный бонус ДОГЕ
</td>
<td>
<input type=text name='bdgc' value=<?=$bdgc?>>
</td>
</tr>
<tr>
<td>
Ежедневный бонус ЭФИР
</td>
<td>
<input type=text name='beth' value=<?=$beth?>>
</td>
</tr>
<tr>
<td colspan=2>
<input type=submit value="Сохранить">
</td>
</tr>
</table>