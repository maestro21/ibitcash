<?php
require('./coinpayments.inc.php');
Error_Reporting(1);

$type = stripslashes($_POST['type']);

$hostname				= "localhost";					// Хост
$mysql_login			= "oblmi198_1";						// Логин к БД
$mysql_password			= "0991846376";						// Пароль к БД
$database				= "oblmi198_1";						// База данных

// Соединение с БД
if (!($conn = mysql_connect($hostname, $mysql_login , $mysql_password))) {
    include "../includes/errors/db.php";
    exit();
} else {
    if (!(mysql_select_db($database, $conn))) {
        include "../includes/errors/db.php";
        exit();
    }

}
// Конец соединения с БД


mysql_query("SET NAMES 'utf8'");

set_magic_quotes_runtime(0);
@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);

switch ($type) {
    case '1':
        $currency = 'BTC';
        break;
    case '2':
        $currency = 'LTC';
        break;
    case '3':
        $currency = 'DOGE';
        break;
    case '4':
        $currency = 'XRP';
        break;
    case '5':
        $currency = 'BCH';
        break;
    case '6':
        $currency = 'ETH';
        break;
}



$id = stripslashes($_POST['id']); //user_id
$amount = $_POST['amount'] / 100000000000;


//echo 'name of coin '.$currency.'<br>'; //валюта
//echo $amount.'<br>'; // сума юзера


$cps = new CoinPaymentsAPI();


$get_user_info = mysql_query("SELECT * FROM users WHERE id = '$id' LIMIT 1");
$row = mysql_fetch_array($get_user_info);
$login = $row['login'];

$req = array(
    'amount' => $amount,
    'currency1' => $currency,
    'currency2' => $currency,
    'address' => '', // leave blank send to follow your settings on the Coin Settings page
    'invoice' => "$login", //ай ди юзера получим при ответе
    'item_name' => 'Test Item/Order Description',
    'ipn_url' =>  BASE_PATH . 'enter/IPMunsver.php',
);
$result = $cps->CreateTransaction($req);


$tx = $result['result']['txn_id'];
$t = time();

$amount = $result['result']['amount']; //сума с ответа
$result['result']['txn_id']; //id платежа
if ($result['error'] == 'ok') {
    mysql_query("INSERT INTO `enter` (`secret`,`login`,`sum`,`date`,`status`,`purse`,`service`,`paysys`) VALUES (0,'$login',$amount,$t,0,'$tx','bal','$currency')");
}

if ($result['error'] == 'ok') {
    $le = php_sapi_name() == 'cli' ? "\n" : '<br />';
//    print 'Transaction created with ID: '.$result['result']['txn_id'].$le;          //id платежа
//    print 'Buyer should send '.sprintf('%.08f', $result['result']['amount']).$currency.$le;  //количество коинов

    if (( $_GET['lang'] == 'ru' || $_GET['lang'] == 'en' )) {
        setcookie( 'lng', htmlspecialchars( $_GET['lang'], ENT_QUOTES ), time(  ) + 2592000, '/' );
        $lng = htmlspecialchars( $_GET['lang'], ENT_QUOTES );
    }
    else {
        if (( $_COOKIE['lng'] == 'ru' || $_COOKIE['lng'] == 'en' )) {
            $lng = htmlspecialchars( $_COOKIE['lng'], ENT_QUOTES );
        }
        else {
            $get_lang = mysql_fetch_array( mysql_query( 'SELECT `data` FROM `settings` WHERE id = 13 LIMIT 1' ) );
            $lng = 'en';
        }
    }
    if($lng == "ru") {
        $text = 'Для большей информации перейдите по этой ссылке';
    } else {
        $text = 'For more information click this link';
    }
    print 'Address: '.$result['result']['address'].$le;                 // кошелек
    print '<a target="_black" class="hreff" href="'.$result['result']['status_url'].'">'.$text.'</a>'.$le;                // ссылка на коин пеймент с оплатой
    print 'Status URL: '.$le.'<input style="width:100%;" class="coin_input hreff" value="'.$result['result']['status_url'].'">'.$le;                // ссылка на коин пеймент с оплатой

} else {
    print 'Error: '.$result['error']."\n";
}



//$result = $cps->GetCallbackAddress($currency,'https://dev3.infinitum.tech/enter/IPMunsver');
//if ($result['error'] == 'ok') {
//    $le = php_sapi_name() == 'cli' ? "\n" : '<br />';
//
////    echo 'Status address: '.var_dump($result['result']).$le;
//    echo 'Status address: '.$result['result']['address'].$le;
//    echo 'Status pubkey: '.$result['result']['pubkey'].$le;
//    echo 'Status dest_tag: '.$result['result']['dest_tag'].$le;
//} else {
//    echo 'Error: '.$result['error']."\n";
//}

?>