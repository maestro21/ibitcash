<div style="margin-left:10%;margin-right:10%;" align=center>
<br>
<h1>Генератор паролей для юзеров v0.5deepalpha</h1>
<br>
<?
if($_GET['new']==1)
{
$user=$_POST['usr'];
$pass=$_POST['pwd'];
$pass=as_md5($key2,$pass);
if(mysql_query("UPDATE users SET pass='$pass' WHERE login='$user' LIMIT 1"))
{
echo "<b>[</b>Пароль поменялся успешно, вот хэшик:".$pass."<b>]</b>";
}
}
?>
<br>
<form action='?a=genpass&new=1' method=post>
<input type=text name='usr' placeholder='Сюда ник'><br>
<input type=text name='pwd' placeholder='Сюда новый пароль'><br><br>
<input type=submit value='Кнопка'>
</form>
</div>