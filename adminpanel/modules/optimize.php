<form method=post action='?a=optimize&act=1'>
<h1>Оптимизация БД</h1>
<p><input type=radio name='a' value=5>Очистка временных таблиц</p>
<p><input type=radio name='b' value=5>Удаление пустых кошельков</p>
<input type=submit value='GO'>
</form>
<?
if($_GET['act']==1)
{
if($_POST['a']==5){
mysql_query("DELETE FROM captcha");
mysql_query("DELETE FROM logip");
}
if($_POST['b']==5){
mysql_query("DELETE FROM enter WHERE status=10 AND purse=''");
}
}
?>