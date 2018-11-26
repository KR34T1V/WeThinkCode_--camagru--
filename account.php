<?PHP
/*********************HEADER********************/
session_start();
include_once "header.php";

if (!$_SESSION['user_id']){
	header("Location: index.php");
	exit;
}
/*********************END********************/

/*********************BODY********************/

?>
<DIV>
	<h2>Account</h2>
	<h3>
	<?PHP
	//ERROR CHECKS
		if ($_GET['change_email'] == "success"){
			echo 'Email successfully changed!';
		}
		if ($_GET['change_email'] == "pwd_error"){
			echo 'An error occured: Please check your password!';
		}
		if ($_GET['change_email'] == "email_error"){
			echo 'An error occured: Please check your email!';
		}
		if ($_GET['change_email'] == "empty"){
			echo 'An error occured please fill in all fields!';
		}
		if ($_GET['pwd_change'] == "success"){
			echo 'Password successfully changed!';
		}
		if ($_GET['pwd_change'] == "pwd_incorrect"){
			echo 'Password incorrect please try again!';
		}
		if ($_GET['pwd_change'] == "pwd_mismatch"){
			echo 'Passwords do not match please try again!';
		}
		if ($_GET['pwd_change'] == "fields_empty"){
			echo 'An error occured please fill in all fields!';
		}
		if ($_GET['uid_change'] == "success"){
			echo 'Username successfully changed';
		}
		if ($_GET['uid_change'] == "error"){
			echo 'An error occurred please try again!';
		}
	//SHOW CURRENT USER
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
	<?PHP
	if ($_SESSION['user_notify'] == 0){
		echo '<FORM action="back/acc.notify.back.php" method="POST">
			<BUTTON name="notify" value="1">Notify: OFF</BUTTON>
			</FORM>';
	}
	else {
		echo '<FORM action="back/acc.notify.back.php" method="POST">
			<BUTTON name="img" value="0">Notify: ON</BUTTON>
			</FORM>';
	}
	?>
<DIV>
<?PHP
/*********************END********************/

/*********************FOOTER********************/
include_once "footer.php";
/*********************END********************/

?>