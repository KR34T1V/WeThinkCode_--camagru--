<?php
session_start();
include_once 'header.php';
?>
<SECTION class="main-container">
	<DIV class="main-wrapper">
		<?PHP
		if ($_GET['verify'] == "sent")
			echo 'Link sent to '.$_SESSION['user_email'];
		?>
		<h2>Account</h2>
		<?PHP
		include_once 'includes/dbh.inc.php';
		$sql = 'SELECT *FROM users WHERE user_id= ?';
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$_SESSION['user_id']]);
		$result = $stmt->fetch();
		if ($result['user_verified'] == 0){
		echo '<FORM class="account-verify" action="includes/verifymail.inc.php" method="POST">
			<BUTTON name="verify">Verify Email</BUTTON>
			</FORM>';
		}
		?>
		<h2>Change Password</h2>
		<FORM class="change-pwd">
			<input type="password" name="oldpwd" placeholder="Old Password" required>
			<input type="password" name="newpwd" placeholder="New Password" required>
			<input type="password" name="repwd" placeholder="New Password" required>
			<BUTTON type="submit" name="submit" value="submit">Change Password</BUTTON>
		
		</FORM>
	</DIV>
</SECTION>
<?php
include_once 'footer.php';
?>
