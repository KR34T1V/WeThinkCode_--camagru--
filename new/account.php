<?PHP
session_start();
if (!$_SESSION['user_id']){
	header("Location: index.php");
	exit;
}
include_once "header.php";
?>
<DIV>
	<h2>Account</h2>
	<h3>
	<?PHP
	echo '
	<p>Firstname: '.$_SESSION['user_first'].'<br />
	Lastname: '.$_SESSION['user_last'].'<br />
	Username: '.$_SESSION['user_uid'].'<br />
	E-Mail:   '.$_SESSION['user_email'].'<br />
	';
	?>
	</h3>
</DIV>
<DIV>
	<h3>Change Username</h3>
	<FORM action="back/acc.uid_change.back.php" method="POST">
		<INPUT type="text" name="newuid" placeholder="New Username" required>
		<BUTTON type="submit" name="submit" value="OK">Change Username</BUTTON>
	</FORM>
</DIV>
<DIV>
	<h3>Change Email</h3>
	<FORM action="back/acc.email_change.back.php" method="POST">
		<p>Changing your email will require you to verify your account!</p>
		<INPUT type="text" name="email" placeholder="New E-Mail" required>
		<INPUT type="password" name="pwd" placeholder="Password" required>
		<BUTTON type="submit" name="submit">Change Email</BUTTON>
	</FORM>
</DIV>
<DIV>
	<h3>Change Password</h3>
	<FORM action="back/acc.pwd_change.back.php" method="POST">
	<INPUT type="password" name="oldpwd" placeholder="Old Password" required>
	<INPUT type="password" name="newpwd" placeholder="New Password" required>
	<INPUT type="password" name="repwd" placeholder="Repeat Password" required>
	<BUTTON type="submit" name="submit">Change Password</BUTTON>
	</FORM>
</DIV>
	<h3>Notifications</h3>
	<INPUT type="checkbox" checked>
<DIV>
<?PHP
include_once "footer.php";
?>