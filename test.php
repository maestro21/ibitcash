<?php
include "cfg.php";
include "ini.php";
if(mysql_query("INSERT INTO users (login, pass, mail) VALUES ('terax','1111','astana@loh.ru')"))
{
	echo "OK!";
}
