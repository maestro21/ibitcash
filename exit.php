<?php
session_start();
include "cfg.php";
$_SESSION['login'] = "";
setcookie("adminstation1", '', time() - 1, "/");
setcookie("adminstation2", '', time() - 1, "/");
$login = "";
print "<html><head><script language=\"javascript\">top.location.href=\"/\";</script></head></html>";
?>