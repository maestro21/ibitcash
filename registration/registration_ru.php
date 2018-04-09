<center><?php
print $body;

if($_GET['action'] == "save") {
		$ulogin	= htmlspecialchars($_POST['ulogin'], ENT_QUOTES);
		$pass	= $_POST['pass'];
		$repass	= $_POST['repass'];
		$email	= htmlspecialchars($_POST['email'], ENT_QUOTES);
		$code	= htmlspecialchars($_POST["code"], ENT_QUOTES);
		$lr		= htmlspecialchars($_POST["lr"], ENT_QUOTES);
		$pm		= htmlspecialchars($_POST["pm"], ENT_QUOTES);

		if(!$ulogin || !$pass || !$repass || !$email) {
			$error = "<p class=\"er\">Заполните все поля</p>";
		} elseif(strlen($ulogin) > 20 || strlen($ulogin) < 3) {
			$error = "<p class=\"er\">Логин должен быть от 3 до 20 символов</p>";
		} elseif($pass != $repass) {
			$error = "<p class=\"er\">Пароли не совпадают</p>";
		}elseif($_POST['chbx']!=5){
			print "<p class=\"er\">Вы должны ознакомиться и согласиться с правилами проекта!</p>";
		} elseif(strlen($email) > 30) {
			$error = "<p class=\"er\">E-mail должен быть от 3 до 30 символов</p>";
		} elseif(!mysql_num_rows(mysql_query("SELECT * FROM captcha WHERE sid = '".$sid."' AND code = '".$code."'"))) {
			$error = "<p class=\"er\">Введен неправильный код с рисунка!</p>";
		} elseif(!preg_match("/^[a-z0-9_.-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|edu|gov|arpa|info|biz|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/is", $email)) {
			$error = "<p class=\"er\">Введите правильный e-mail</p>";
		} elseif(mysql_num_rows(mysql_query("SELECT login FROM users WHERE login = '".$ulogin."'"))) {
			$error = "<p class=\"er\">Такой логин уже есть в базе! Выберите другой!</p>";
		} elseif(mysql_num_rows(mysql_query("SELECT mail FROM users WHERE mail = '".$email."'"))) {
			$error = "<p class=\"er\">Такой E-mail уже есть в базе!</p>";
		} else {
			$time	 = time();
			$ip		 = getip();
			$pass	 = as_md5($key, $pass);
			if($referal) { $ref_id = intval($referal); } else { $ref_id = 0; }
			$code=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
			$sql = "INSERT INTO users (login, pass, mail, go_time, ip, reg_time, ref, cloud) VALUES ('".$ulogin."', '".$pass."', '".$email."', ".$time.", '".$ip."', ".$time.", ".$ref_id.", '10')";
			mysql_query($sql);
			$subject = "Поздравляем с успешной регистрацией";
mysql_query("INSERT INTO activation (uid, code) VALUES ('$ulogin', '$code')");

			mail($email, $subject, $text, $headers);

			$ulogin	= "";
			$pass	= "";
			$repass	= "";
			$email	= "";
			$lr		= "";
			$pm		= "";

			$error = 1;
		}
}

if($error == 1) {

	print "<p class=\"erok\">Поздравляем! Вы успешно зарегистрировались. Войдите в аккаунт!</p>";

} else {
	print $error;
?>
<?php

	if($referal) {
		$get_user_info	= mysql_query("SELECT * FROM users WHERE id = ".intval($referal)." LIMIT 1");
		$row			= mysql_fetch_array($get_user_info);
		$refname		= $row['login'];

	}

} 
?>

        <div class="content">
            <div class="cont_desc">
				<form action="?action=save" method="post" id="registration">
						<div class="forms_block">
						<div class="forms_right">
						<center><h1>Регистрация</h1></center><br><br>
						<p>Вы были приглашены <?echo $refname;?></p>
							<input type="text" name="ulogin" class="inp" placeholder="&nbsp;&nbsp;ЛОГИН" required> <input type="email" class="inp"  name="email" id="email" placeholder="&nbsp;&nbsp;E-MAIL" required><br>
							<input type="password"  name="pass" class="inp" placeholder="&nbsp;&nbsp;ПАРОЛЬ" required> <input type="password" name="repass" class="inp" placeholder="&nbsp;&nbsp;ПОДТВЕРДИТЕ ПАРОЛЬ" required><br>
							
							<table><tr><td style="padding-top:5px;padding-left:10px;paddint-right:10px;"><img src="/captcha.php" width="100%;" border="2" alt="Enter the code depicted in figure" /></td><td><input style="width: 130px; height: 31px; font-size: 16px; font-weight: bold;" type="text" name="code" size="20" maxlength="5" /></td></tr></table>
							<br><p>После регистрации на вашу почту прийдет письмо с подтверждением регистрации.<p>
							<p><input type="checkbox" name="chbx"  value=5  class="check"> Я прочел <a href="/law" target="_blank">правила</a> и соглашаюсь с ними.<br></p>
							<center><input class="exchange_button" style='width:12em;height:2em;margin-bottom:1%;' type=submit value='Зарегистрироваться'></center>
						</div>
						
						</div>
					</div>
					
				</form>
			</div>
</center>












	




