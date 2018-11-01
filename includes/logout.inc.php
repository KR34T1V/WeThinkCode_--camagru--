<?PHP
session_start();
$submit = $_POST['submit'];
	if (isset($submit)){
		session_unset();
		session_destroy();
		header("Location: ../index.php");
	}