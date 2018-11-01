<?php
session_start();
include_once 'header.php';
?>
<SECTION class="main-container">
	<DIV class="main-wrapper">
		<FORM action="includes/verify.inc.php" method="POST">
			<BUTTON name="verify">Verify Email</BUTTON>
		</FORM>
		<h3>Change Password</h3>
		<FORM>
			<input type="password" name="oldpwd" placeholder="Old Password" required>
			<input type="password" name="newpwd" placeholder="New Password" required>
			<input type="password" name="repwd" placeholder="New Password" required>
			<BUTTON type="submit" name="submit" value="submit">Change Passwod</BUTTON>
		
		</FORM>
	</DIV>
</SECTION>
<?php
include_once 'footer.php';
?>
