<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="">
<title>Регистрация</title>
<link type="text/css" rel="stylesheet" href="../../media/css/style.css">
</head>
<body>
<div id="wrapper">

<div id="header"><div class="wrap">




</div></div>

<div id="center"><div class="wrap">


<div class="register">
<h2 class="title">НОВАЯ РЕГИСТРАЦИЯ</h2>
<div class="line"></div>
<div class="reg_form">




 <?php
	defined('ACCESS') or die();
	if(!$page) {
		include "includes/index.php";
	} elseif(file_exists("../".$page."/index.php")) {
		print "";
		include "../".$page."/".$page."_ru.php";
	} else {
		include "includes/errors/404.php";
	}
?>
 
 


</div>
<div class="clear"></div>
</div>
</div></div>
</div>

</body>
</html>
<!-- This page generated in 0.427258 secs by XSLT, SITE MODE -->