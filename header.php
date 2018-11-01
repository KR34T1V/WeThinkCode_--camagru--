<?PHP
	session_start();
?>

<HTML>
	<HEAD>
		<link rel="stylesheet" href="style.css">
		<TITLE>Camagru!</TITLE>
	</HEAD>
	<BODY>
		<HEADER>
			<NAV>
				<DIV class="main-nav">
					<A href="index.php">Home</A>
					<DIV class="nav-login">
					<?PHP
						if (isset($_SESSION['user_id'])){
							echo '<FORM action="includes/logout.inc.php" method="POST">
							<BUTTON type="submit" name="submit">Logout</BUTTON>
							</FORM>';
						}
						else {
							echo '<FORM action="includes/login.inc.php" method="POST">
							<input type="text" name="uid" placeholder="E-mail" required>
							<input type="password" name="pwd" placeholder="Password" required>
							<button type="submit" name="submit" value="submit">Login</button>
							<A href="signup.php">Sign up</A>
							</FORM>';
						}
					?>
					</DIV>
				</DIV>
			</NAV>
		</HEADER>