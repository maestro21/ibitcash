<?php
if(!$login) {
?>
	<table align="center" cellpadding="1" cellspacing="0">
	<form action="/login/" method="post">
	<tr>
		<td style="padding-left: 2px;">Login</td>
		<td style="padding-left: 2px;">Password</td>
	</tr>
	<tr>
		<td><input type="text" name="user" size="13"></td>
		<td><input type="password" name="pass" size="13"></td>
	</tr>
	<tr>
		<td style="padding-left: 2px;"><a href="/registration/">Sign Up</a><br /><a href="/reminder/">Forgot password?</a></td>
		<td align="right"><input style="border: none;" type="image" src="/images/enter.gif" title="Sig in" /></td>
	</tr>
	</form>
	</table>
	<hr />
<?php
} else {
    print "<p align=\"center\"><b>Welcome <b style=\"color: green\">".$login."</b>!</b><br /> Your balance: $<b>".$balance."</b></p>";
	print '<ul>';
	if($status == 1) {
		print '<li><a href="/adminpanel/"><b>Admin Panel</b></a></li>';
	}
	print '<li><a href="/enter/">Add money</a></li>';
	print '<li><a href="/deposit/">Make a deposit</a></li>';
	print '<li><a href="/deposits/">Active deposits</a></li>';
	print '<li><a href="/withdrawal/">Withdraw</a></li>';
	print '<li><a href="/ref/">Your referrals</a></li>';
	print '<li><a href="/stat/">History</a></li>';
	print '<li><a href="/profile/">Your account</a></li>';
	print '<li><a href="/exit.php">Logout</a></li>';
	print '</ul>';
}
?>