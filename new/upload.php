<?PHP
session_start();
include_once "header.php";
if (!$_SESSION['user_id']){
	echo '<P>Please sign in to upload your story</P> 
	';
}
else {
	echo '
		<NAV>
			<DIV>
				<FORM action="back/upload.img.back.php" method="POST" enctype="multipart/form-data">
					<INPUT type="file" name="img">
					<BUTTON type="submit" name="submit" value="OK">Upload</BUTTON>
				</FORM>
			<?DIV>
		</NAV>
	';
}
include_once "footer.php";