<?PHP
session_start();

$getemail	= $_GET['email'];
$gethash	= $_GET['hash'];

$email		= $_SESSION['user_email'];
$hash		= hash(md5, $_SESSION['user_email']). hash(md5,$_SESSION['user_uid']);

if ($getemail !== $email || $gethash !== $hash)
	header("Location: ../account.php?verify=error");
else if ($getemail == $email && $gethash == $hash){
	include_once 'dbh.inc.php';
	$query = "UPDATE users SET user_verified = 1 WHERE user_email=:email";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':email', $email);
	$stmt->execute();
	header("Location: ../account.php?verified=success");
}

