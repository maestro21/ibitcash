<?php
if(!$login) {
?>
	<table align="center" cellpadding="1" cellspacing="0">
	<form action="/login/" method="post">
	<tr>
		<td style="padding-left: 2px;">�����</td>
		<td style="padding-left: 2px;">������</td>
	</tr>
	<tr>
		<td><input type="text" name="user" size="13"></td>
		<td><input type="password" name="pass" size="13"></td>
	</tr>
	<tr>
		<td style="padding-left: 2px;"><a href="/registration/">�����������</a><br /><a href="/reminder/">������ ������?</a></td>
		<td align="right"><input style="border: none;" type="image" src="/images/enter.gif" title="�����" /></td>
	</tr>
	</form>
	</table>
	<hr />
<?php
} else {
    print "<p align=\"center\"><b>����� ���������� <b style=\"color: green\">".$login."</b>!</b><br /> ������: $<b>".$balance."</b></p>";
	print '<ul>';
	if($status == 1) {
		print '<li><a href="/adminpanel/"><b>��������������</b></a></li>';
	}
	print '<li><a href="/enter/">��������� ������</a></li>';
	print '<li><a href="/deposit/">������� �������</a></li>';
	print '<li><a href="/deposits/">���� ��������</a></li>';
	print '<li><a href="/withdrawal/">������� ��������</a></li>';
	print '<li><a href="/ref/">����������� ���������</a></li>';
	print '<li><a href="/stat/">����������</a></li>';
	print '<li><a href="/profile/">��� �������</a></li>';
	print '<li><a href="/exit.php">�����</a></li>';
	print '</ul>';
}
?>