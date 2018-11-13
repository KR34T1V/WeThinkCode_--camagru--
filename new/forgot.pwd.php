<?PHP
include_once "header.php";
?>

<NAV class="forgot_pwd">
	<DIV>
		<FORM action="back/acc.pwd.forgot.back.php" method="POST">
			<INPUT type="text" name="email" placeholder="Username/E-Mail">
			<INPUT type="password" name="pwd" placeholder="New Password">
			<INPUT type="password" name="repwd" placeholder="Retype Password">
			<BUTTON type="submit" name="submit" value="OK">Reset Password</BUTTON>
		</FORM>
	</DIV>
</NAV>

<?PHP
include_once "footer.php";
?>