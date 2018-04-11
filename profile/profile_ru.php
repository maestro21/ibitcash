<?php
include '../att.php';
	function downcounter($date){
        $check_time = $date - time();
        if($check_time <= 0){
            return false;
        }
        $days = floor($check_time/86400);
        $hours = floor(($check_time%86400)/3600);
        $minutes = floor(($check_time%3600)/60);
        $seconds = $check_time%60; 
        $str = '';
        if($days > 0) $str .= declension($days,array('день','дня','дней')).' ';
        if($hours > 0) $str .= declension($hours,array('час','часа','часов')).' ';
        if($minutes > 0) $str .= declension($minutes,array('минута','минуты','минут')).' ';
        if($seconds > 0) $str .= declension($seconds,array('секунда','секунды','секунд'));
        return $str;
    }
    function declension($digit,$expr,$onlyword=false){
        if(!is_array($expr)) $expr = array_filter(explode(' ', $expr));
        if(empty($expr[2])) $expr[2]=$expr[1];
        $i=preg_replace('/[^0-9]+/s','',$digit)%100;
        if($onlyword) $digit='';
        if($i>=5 && $i<=20) $res=$digit.' '.$expr[2];
        else
        {
            $i%=10;
            if($i==1) $res=$digit.' '.$expr[0];
            elseif($i>=2 && $i<=4) $res=$digit.' '.$expr[1];
            else $res=$digit.' '.$expr[2];
        }
        return trim($res);
    }
defined('ACCESS') or die();
if ($login) {
	if ($_GET['action'] == 'sendpin') {
		$pass_1 = as_md5($key2, $_POST['password']);
		$email	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['email'], ENT_QUOTES, '')));
		if($pass_1==$user_pass AND $email==$user_mail){
			$sql=mysql_query("SELECT * FROM users WHERE login='$login'");
			$lp=mysql_result($sql,0,'last_mail');
			$lp=$lp+(60*60*24);
			if(downcounter($lp)!=false){
			$strlp=downcounter($lp);
		echo '<center>Менять пин можно 1 раз в сутки.<br>
		Осталось ждать:'.$strlp.'</center>';
			}else{
	mysql_query("INSERT INTO activation (uid, code) VALUES ('$user_id', '$code')");
	$pin=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
	$time=time();
	mysql_query("UPDATE users SET pin='$pin', last_mail='$time' WHERE login='$login'");
			$subject = "Восстановление пин-кода";

			$headers = "From:ib@it.cash\n";
            $headers .= "Reply-to:" . DOMAIN . "\n";
			$headers .= "X-Sender: <".BASE_PATH.">\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\n";

			$text = "";
			echo "Ваш пин код:<b>".$pin."</b>";
			mail($user_mail, $subject, $text, $headers);
			?><script><!--showatt(10);-></script><?
			}
			}else{
			?><script>document.location.href = '/profile/?ok=3';</script><?
			}

		?>

	<?}
	
	if ($_GET['action'] == 'save') {
		$cpass = as_md5($key2, $_POST['cpass']);
		$sql= mysql_query('SELECT * FROM users WHERE login = "'.$login.'" LIMIT 1');
		if($cpass == $user_pass)
		{
		$pass_1 = mysql_real_escape_string($_POST['pass_1']);
		$pass_2 = mysql_real_escape_string($_POST['pass_2']);
		$email	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['email'], ENT_QUOTES, '')));
		$skype	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['skype'], ENT_QUOTES, '')));
		$fio	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['fio'], ENT_QUOTES, '')));
		$phone	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['phone'], ENT_QUOTES, '')));
		$country	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['country'], ENT_QUOTES, '')));
		$town	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['town'], ENT_QUOTES, '')));
		$site	= mysql_real_escape_string(addslashes(htmlspecialchars($_POST['site'], ENT_QUOTES, '')));
		$sql = "UPDATE users SET user_fio = '$fio', user_skype='$skype', user_phone='$phone', user_town='$town', user_country='$country', user_site='$site' WHERE login='$login' LIMIT 1";
		mysql_query($sql);
		if($upm) { $pm = $upm; } 

		if (!$email) {
			echo '<p class="er">Следует ввести E-mail!</p>';
		} else {
			if ($pass_1 != $pass_2 AND $pass_1!='') {
				echo '<p class="er">Пароль и подтверждение не совпадают!</p>';
			} else {
				if (!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is", $email)) {
					print '<p class="er">Введите правильно e-mail!</p>';
				} elseif (strlen($pm) != 8 && $pm) {
					print '<p class="er">Введите корректный PM кошелёк!</p>';
				} elseif ($pm[0] != 'U' && $pm) {
					print '<p class="er">Введите корректный PM кошелёк!</p>';
				} elseif(mysql_num_rows(mysql_query("SELECT pm FROM users WHERE pm = '".$pm."' AND id != ".$user_id)) && $pm) {
					print "<p class=\"er\">Такой PM уже есть в базе!</p>";
				} elseif(mysql_num_rows(mysql_query("SELECT mail FROM users WHERE mail = '".$email."' AND id != ".$user_id))) {
					print "<p class=\"er\">Такой e-mail уже есть в базе!</p>";
				} else {
					$sql = 'UPDATE users SET ';
					if($pass_1) { $sql .= 'pass = "'.as_md5($key2, $pass_1).'", '; }

					$sql .= 'mail = "'.$email.'", icq = "'.$icq.'", pm = "'.$pm.'" WHERE id = '.$user_id.' LIMIT 1';
					if (mysql_query($sql)) {
						print '<p class="erok">Данные были успешно обновлены!</p>';
						?><script>document.location.href = '/profile/?ok=1';</script><?
					} else {
						print '<p class="er">Не удаётся изменить данные!</p>';
						?><script>document.location.href = '/profile/';</script><?
					}
			}
		}
	}
		}
	else{
		echo "Неправильный пароль<br>";
	}
	}

$sql	= 'SELECT * FROM users WHERE login = "'.$login.'" LIMIT 1';
$rs		= mysql_query($sql);
$a		= mysql_fetch_array($rs);
?>
<div style="margin-left:10%;margin-right:10%;padding-top:3%;">
		  <div class="left_div">
					  <div>
							<ul class="left-menu">
							<li><a href="/mining/">Майнинг</a></li>
<li><a href="/enter/">Пополнить баланс</a></li>
<li><a href="/withdrawal/">Вывод средств</a></li>
<li><a href="/exchange/">Обмен на мощности</a></li>


<li><a href="/calc/">Калькулятор</a></li>
<li><a href="/history/">История операций</a></li>
<li><a href="/ref/">Реферальная программа</a></li>
<li class="active_l"><a href="/profile/">Профиль</a></li>
							</ul>
							<br><br>
							</div>
					 </div>
					 <div class="right_div">
					 <?if ($_GET['action'] == 'pin') {?>
					 <h1></h1>
					 <br><br>
		<form action="?action=sendpin" method="post">
		<center>
		<p></p>
		<br>
<input type="email" class="profile" name="email" id="email" value="<?echo $user_mail;?>" placeholder="&nbsp;&nbsp;Ваш E-MAIL" >
<input type="password" class="profile" name="password" id="password" placeholder="&nbsp;&nbsp;Ваш ПАРОЛЬ" >
<div align="center" style="padding-top: 10px;"><input class="submit pay" type="submit" name="submit" value=" Отправить " /></div>
</center></div></form><br>
	<?}else{?>
					 <?
					 if($_GET['ok']==1)
					 {
						?><SCRIPT>showatt(9);</SCRIPT><?
					 }
					 if($_GET['ok']==2)
					 {
						 ?><SCRIPT>showatt(10);</SCRIPT><?
					 }
					 if($_GET['ok']==3)
					 {
						?><SCRIPT>showatt(11);</SCRIPT><?
					 }
					 ?>
					 								<p id="prof_h">Личные данные</p>
													<p id="prof_h">* - обязательные поля для ввода</p>
													<p id="prof_h">Что бы сохранить данные - введите их,<br> введите ваш действующий пароль и нажмите "Изменить"</p>
				<form action="?action=save" method=post id="registration">
						<div class="forms_right">
							<input type="text" disabled value=<?echo $login;?> class="profile" placeholder="&nbsp;&nbsp;Имя пользователя" > <input type="email" class="profile" name="email" id="email" value="<?echo $user_mail;?>" placeholder="&nbsp;&nbsp;Ваш E-MAIL" ><br>
							<input type="text" class="profile" name="fio" placeholder="&nbsp;&nbsp;ФИО"  value="<?echo $user_fio;?>"> <input type="text" class="profile"  value="<?echo $user_skype;?>" name="skype" placeholder="&nbsp;&nbsp;Skype" ><br>
							<input type="text" class="profile"  value="<?echo $user_phone;?>" name="phone" placeholder="&nbsp;&nbsp;Телефон" > <input type="text"  value="<?echo $user_country;?>" class="profile" name="country" placeholder="&nbsp;&nbsp;Страна" ><br>
							<input type="text" class="profile"  value="<?echo $user_town;?>" name="town" placeholder="&nbsp;&nbsp;Город" > <input type="text"  value="<?echo $user_site;?>" class="profile" name="site" placeholder="&nbsp;&nbsp;WebSite" ><br>
							<p class="change_pass">Изменения пароля</p>
							<input type="password" class="profile" name="pass_1" placeholder="&nbsp;&nbsp;Новый пароль" > <input type="password" name="pass_2" class="profile" placeholder="&nbsp;&nbsp;Подтвердите новый пароль" ><br>
							<input type="password" class="profile" name="cpass" size="20" maxlength="40"  placeholder="&nbsp;&nbsp;Текущий пароль*" required class="number"> 
						<span id="buttonBlock" style='margin:0;padding:0;'>
										<button class="submit pay" style="width:41%;font-size:0.7em;margin:0;padding:0;margin-top:1em;" id="checkPayments">Изменить</button>
									</span></form>

									</div>
									</div>
<?php
} }else {
		?><script>document.location.href = '<?php echo BASE_PATH;?>login';</script><?
}

?>