<?PHP
session_start();
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
						<A href="forgot.pwd.php">Forgot Password<A>
						<A href="signup.php">Sign Up<A>
						</FORM>
						</DIV>';
					}
					else if ($_SESSION['user_id'] && $_SESSION['user_verified'] == 0){
						header("Location: req.verify.php");
					}
					else{
						echo '
						<A href="upload.php">Upload</A>
						<DIV class="nav-login">
							<FORM action="back/logout.back.php" method="POST">
								<BUTTON type="submit" name="submit" value="OK">Logout</BUTTON>
								<A href="account.php">My Account</A>
							</FORM>
						</DIV>';
					}
					?>
				</DIV>
			</NAV>
		</HEADER>