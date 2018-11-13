<?PHP
session_start();
if (!$_SESSION['user_id']){
	header("Location: index.php");
	exit;
}
?>
<HTML>
	<HEAD>
		<link rel="css/header.css" href="css/header.css">
		<TITLE>Camagru!</TITLE>
	</HEAD>
	<BODY>
		<HEADER>
			<NAV class=nav-header>
				<DIV>
					<A href="index.php">Home</A>
					<?PHP
					if (!$_SESSION['user_id']){
						echo '
						<DIV class="nav-login">
							<FORM action="back/login.back.php" method="POST">
								<INPUT type="text" name="login" placeholder="E-Mail/Username" required>
								<INPUT type="password" name="pwd" placeholder="Password" required>
								<BUTTON type="submit" name="submit" value="OK">Login</BUTTON>
								<A href="signup.php">Sign Up<A>
							</FORM>
						</DIV>';
					}
					else{
						echo '
						<DIV class="nav-login">
							<FORM action="back/logout.back.php" method="POST">
								<BUTTON type="submit" name="submit" value="OK">Logout</BUTTON>
							</FORM>
						</DIV>';
					}
					?>
				</DIV>
			</NAV>
		</HEADER>
		<?PHP
			$status	= $_GET['verify'];
			if ($status == "email_sent") {
				echo '
					<p>Verification e-mail has been sent to: '.$_SESSION['user_email'].'</p>';
			}
			else {
				echo '
				<p>Your Current Email is set to:<br />'.$_SESSION['user_email'].'</p>';
			}
		?>
		<p>In order to keep the website secure we require you to verify your email account using the link below:</p>
		<FORM action="back/req.verify.back.php" method="POST">
			<BUTTON type="submit" name="submit" value="OK">Verify E-Mail</BUTTON>
		</FORM>
		<p>In the rare and unlikely case that you lied about your email please use the form below to change your E-Mail:</p>
		<FORM action="back/acc.email_change.back.php" method="POST">
			<INPUT type="text" name="email" placeholder="New Email">
			<INPUT type="password" name="pwd" placeholder="Current Password">
			<BUTTON type="submit" name="submit" value="OK">Change E-Mail</BUTTON>
		</FORM>