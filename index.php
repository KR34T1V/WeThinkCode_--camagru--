<?php
	include_once 'header.php';
?>
		<SECTION class="main-container">
			<DIV class="main-wrapper">
				<H2>Home</H2>
				<?php
				
					if (isset($_SESSION['user_id'])){
						echo "Welcome ".$_SESSION['user_first']
						." ".$_SESSION['user_last'].
						". You are logged in!";
					}
				?>
			</DIV>
		</SECTION>

<?php
	include_once 'footer.php';
?>