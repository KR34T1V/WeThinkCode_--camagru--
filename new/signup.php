<?PHP
/*********************HEADER********************/
include_once "header.php";
/*********************END********************/

/*********************BODY********************/

?>
<NAV>
	<DIV>
		<FORM action="back/signup.back.php" method="POST">
			<INPUT type="text" name="first" placeholder="Firstname" required>
			<INPUT type="text" name="last" placeholder="Lastname" required>
			<INPUT type="text" name="uid" placeholder="Username" required>
			<INPUT type="text" name="email" placeholder="E-mail" required>
			<p>The password must be at least 6 characters long.<br />
			It must contain 'Alphabet Characters' and 'Digits':</p>
			<INPUT type="password" name="pwd" placeholder="Password" required>
			<INPUT type="password" name="repwd" placeholder="Retype Password" required>
			<BUTTON type="submit" name="submit" value="OK">Sign Up</BUTTON>
		</FORM>
	</DIV>
</NAV>
<?PHP
/*********************END********************/


/*********************FOOTER********************/
include_once "footer.php";
/*********************END********************/

?>