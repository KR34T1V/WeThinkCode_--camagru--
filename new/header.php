<?PHP
session_start();
?>
<HTML>
	<HEAD>
		<link rel="stylesheet" href="stylesheet.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
		<TITLE>Camagru!</TITLE>
	</HEAD>
	<BODY>
		<HEADER>
			<NAV class=nav-header>
				<DIV class=header-content>
					<A href="index.php">Home</A>
					<?PHP
					if (!$_SESSION['user_id']){
						echo '
						<DIV class="nav-login">
						<FORM action="back/login.back.php" method="POST">
						<INPUT type="text" name="login" placeholder="E-Mail/Username" required>
						<INPUT type="password" name="pwd" placeholder="Password" required>
						<BUTTON type="submit" name="submit" value="OK">Login</BUTTON>
						<A href="forgot.pwd.php">Forgot Password</A>
						<A href="signup.php">Sign Up</A>
						</FORM>
						</DIV>';
					}
					else if ($_SESSION['user_id'] && $_SESSION['user_verified'] == 0){
						header("Location: req.verify.php");
					}
					else{
						echo '
						<A href="camera.php">Upload/Camera</A>
						<DIV class="nav-login">
							<FORM action="back/logout.back.php" method="POST">
								<BUTTON type="submit" name="submit" value="OK">Logout</BUTTON>
								<A href="account.php">My Account</A>
							</FORM>
						</DIV>';
					}
					?>
				</DIV>
				<DIV class=clear>
				</DIV>
			</NAV>
		</HEADER>
		<DIV class="content-wrapper">