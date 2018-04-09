<?PHP 
include 'cfg.php';
$sql=mysql_query("SELECT * FROM tb_srv_stats");
$obtc=mysql_result($sql,0,'btc');
$odgc=mysql_result($sql,0,'dgc');
$oltc=mysql_result($sql,0,'ltc');
$odsh=mysql_result($sql,0,'dsh');
$ordd=mysql_result($sql,0,'mnr');
$oeth=mysql_result($sql,0,'eth');
$sbtc=mysql_result($sql,0,'sbtc');
$sdgc=mysql_result($sql,0,'sdgc');
$sltc=mysql_result($sql,0,'sltc');
$sdsh=mysql_result($sql,0,'sdsh');
$srdd=mysql_result($sql,0,'smnr');
$seth=mysql_result($sql,0,'seth');
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,'https://api.cryptonator.com/api/ticker/btc-usd');
$result=curl_exec($ch);
$obj=(json_decode($result, true));
$pbtc= $obj['ticker']['price'];
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,'https://api.cryptonator.com/api/ticker/doge-usd');
$result=curl_exec($ch);
$obj=(json_decode($result, true));
$pdgc= $obj['ticker']['price'];
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,'https://api.cryptonator.com/api/ticker/ltc-usd');
$result=curl_exec($ch);
$obj=(json_decode($result, true));
$pltc= $obj['ticker']['price'];
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,'https://api.cryptonator.com/api/ticker/XRP-usd');
$result=curl_exec($ch);
$obj=(json_decode($result, true));
$pdsh= $obj['ticker']['price'];
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,'https://api.cryptonator.com/api/ticker/BCH-usd');
$result=curl_exec($ch);
$obj=(json_decode($result, true));
$prdd= $obj['ticker']['price'];
curl_close($ch);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,'https://api.cryptonator.com/api/ticker/eth-usd');
$result=curl_exec($ch);
$obj=(json_decode($result, true));
$peth= $obj['ticker']['price'];
curl_close($ch);
if($pbtc<$obtc){
$sbtc=1;
}elseif($pbtc>$obtc){
$sbtc=0;
}
if($pdgc<$odgc){
$sdgc=1;
}elseif($pdgc>$odgc){
$sdgc=0;
}
if($pltc<$oltc){
$sltc=1;
}elseif($pltc>$oltc){
$sltc=0;
}
if($pdsh<$odsh){
$sdsh=1;
}elseif($pdsh>$odsh){
$sdsh=0;
}
if($prdd<$ordd){
$srdd=1;
}elseif($prdd>$ordd){
$srdd=0;
}
if($peth<$oeth){
$seth=1;
}elseif($peth>$oeth){
$seth=0;
}
echo $obtc.' ddd';
mysql_query("UPDATE tb_srv_stats SET btc='$pbtc', dgc='$pdgc', ltc='$pltc', dsh='$pdsh', mnr='$prdd', eth='$peth',sbtc='$sbtc', sdgc='$sdgc', sltc='$sltc', sdsh='$sdsh', smnr='$srdd', seth='$seth'");
?>