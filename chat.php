<?php 
if ($_POST['enter'] and $_POST['text']) {
$_POST['text'] = FormChars($_POST['text']);
mysqli_query($CONNECT, "INSERT INTO `chat`  VALUES ('', '$_POST[text]', '$_SESSION[USER_LOGIN]', NOW())");
exit(header('location: /chat'));
}
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
?>
<div class="Page">


<div class="ChatBox">
<?php
$Query = mysqli_query($CONNECT, 'SELECT * FROM `chat` ORDER By `time` DESC LIMIT 50');
while ($Row = mysqli_fetch_assoc($Query)) echo '<div class="ChatBlock"><span>'.$Row['users'].' | '.$Row['time'].'</span>'.$Row['message'].'</div>';
?>
</div>




<form method="POST" action="/chat">
<textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
<br><input type="submit" name="enter" value="Отправить"> <input type="reset" value="Очистить">
</form>
</div>
</div>