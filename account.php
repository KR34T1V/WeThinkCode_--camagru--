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
		require_once 'includes/dbh.inc.php';
		$sql = 'SELECT * WHERE user_id='.$_SESSION['user_id'];
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(':username', $uid);
		$stmt->execute();
		$result = $stmt->fetch();
		if ($result['verified'] != 1)
		echo '<FORM class="account-verify" action="includes/verifymail.inc.php" method="POST">
			<BUTTON name="verify">Verify Email</BUTTON>
			</FORM>';
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
