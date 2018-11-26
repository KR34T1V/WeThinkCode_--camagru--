<?PHP
session_start();
include_once "connect.back.php";
if ($_SESSION['user_notify'] == 1){
	$query = "UPDATE users
				SET user_notify=0
				WHERE user_id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$_SESSION['user_id']]);
	$_SESSION['user_notify'] = 0;
	header("Location: ../account.php");
	exit();
}
else if ($_SESSION['user_notify'] == 0){
	$query = "UPDATE users
				SET user_notify=1
				WHERE user_id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$_SESSION['user_id']]);
	$_SESSION['user_notify'] = 1;
	header("Location: ../account.php");
	exit();
}
else {
	echo "An Error Occurred!";
}