<?php
	include_once 'header.php';
?>
		<SECTION class="main-container">
			<DIV class="main-wrapper">
				<H2>Signup</H2>
				<FORM class="signup-form" action="includes/signup.inc.php" method="POST">
					<INPUT type="text" name="first" placeholder="Firstname" required>
					<INPUT type="text" name="last" placeholder="Lastname" required>
					<INPUT type="text" name="uid" placeholder="Username" required>
					<INPUT type="text" name="email" placeholder="E-Mail" required>
					<INPUT type="password" name="pwd" placeholder="Password" required>
					<INPUT type="password" name="repwd" placeholder="Confirm Password" required>
					<BUTTON type="submit" name="submit" value="submit">Sign up</BUTTON>
				</FORM>
			</DIV>
		</SECTION>

<?php
	include_once 'footer.php';
?>