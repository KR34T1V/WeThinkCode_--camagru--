<?PHP
include_once "connect.back.php";


//VARIABLES
$user_id		= $_GET['user'];
$key			= $_GET['key'];
$pwd			=$_GET['rdm'];
//CHECK EMPTY
if (!empty($user_id) && !empty($key)){
	$query = "SELECT *
				FROM users
				WHERE user_id=?
				";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id]);
	$result = $stmt->fetch();
	//CHECK KEY
	if (password_verify($result['user_email'], $key)){
		$query = "UPDATE users
					SET user_pwd=?
					WHERE user_id=?
					";
		//CHANGE PASSWORD
		$stmt = $pdo->prepare($query);
		$stmt->execute([$pwd, $user_id]);
		header("Location: ../index.php?pwd_reset=success");
		exit();
	}
	else{
		header("Location: ../index.php?pwd_reset=failed");
		exit();
	}
}
else{
	header("Location: ../index.php?pwd_reset=failed");
	exit();
}