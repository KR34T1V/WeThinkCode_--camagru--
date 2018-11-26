<?PHP
session_start();
$submit = $_POST['submit'];
	if ($submit == "OK"){
		session_unset();
		session_destroy();
	}
	header("Location: ../index.php");
	exit();