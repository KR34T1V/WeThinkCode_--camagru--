<?PHP

//CONNECT WITH SERVER
include_once "connect.back.php";

//VARIABLES

$user_login		= htmlentities($_POST['login']);
$user_pwd		= $_POST['pwd'];
$submit			= $_POST['submit'];

//CHECK SUBMIT
if ($submit == 'OK') {
//CHECK USER
	$query = "SELECT * FROM users WHERE user_uid=? OR user_email=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_login, $user_login]);
	$result = $stmt->fetch();
	if (!$result){
		header("Location: ../index.php?login=user_error");
		exit();
	}
//CHECK PASSWORD
	else if (password_verify($user_pwd, $result['user_pwd'])){
		session_start();
		$_SESSION['user_id'] = $result['user_id'];
		$_SESSION['user_first'] = $result['user_first'];
		$_SESSION['user_last'] = $result['user_last'];
		$_SESSION['user_uid'] = $result['user_uid'];
		$_SESSION['user_email'] = $result['user_email'];
		$_SESSION['user_verified'] = $result['user_verified'];
		$_SESSION['user_notify'] = $result['user_notify'];
		header("Location: ../index.php?login=success");
		exit();
	}
	else {
		header("Location: ../index.php?login=pwd_mismatch");
		exit();
	}
}
else {
	header("Location: ../index.php?login=submit_error");
	exit();
}