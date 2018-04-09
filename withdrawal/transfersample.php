<?php
defined('ACCESS') or die();
include "ApiAgent.php";
$auth = new Authentication($cfgLiberty, $cfgPAYEE_NAME, $cfgLRkey);

$payee		= $purse;
$currency	= "Usd";
$amount		= $sum;
$memo		= $cfgURL;
$private	= "false";
$purpose	= "Salary";
$reference	= "Reference1";

$apiAgent = ApiAgentFactory::createApiAgent(ApiAgentFactory::JSON, $auth); 
$transfer = $apiAgent->transfer($payee, $currency, $amount, $private, $purpose, $reference, $memo);
?>