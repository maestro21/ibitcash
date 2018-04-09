<?php


	function cfgSET($cfgname) {
		$cedbbcjhba = mysql_fetch_array( mysql_query( 'SELECT * FROM `settings` WHERE cfgname = \'' . $cfgname . '\' LIMIT 1' ) );
		return $cedbbcjhba['data'];
	}


	if (!( defined( 'ACCESS' ))) {
		exit(  );
		(bool)true;
	}

	$cfgLiberty =  'x';
	$key2 = 'Z201OlC1985';
	$adminmail = 'admin@ibitcash.com';
	$cfgPerfect = cfgSET( 'cfgPerfect' );
	$cfgPAYEE_NAME = cfgSET( 'cfgPAYEE_NAME' );
	$cfgLRsecword = cfgSET( 'cfgLRsecword' );
	$ALTERNATE_PHRASE_HASH = cfgSET( 'ALTERNATE_PHRASE_HASH' );
	$cfgAutoPay = cfgSET( 'cfgAutoPay' );
	$cfgPMID = cfgSET( 'cfgPMID' );
	$cfgPMpass = cfgSET( 'cfgPMpass' );
	$cfgLRkey = cfgSET( 'cfgLRkey' );
	cfgSET( 'cfgMinOut' );
	$cfgMinOut = cfgSET( 'adminmail' );
	cfgSET( 'cfgPercentOut' );
	$cfgPercentOut = cfgSET( 'cfgLiberty' );
?>