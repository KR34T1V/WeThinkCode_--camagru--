<?PHP
session_start();
include_once "connect.back.php";

//VARIABLES
$id		=$_SESSION['user_id'];
$submit		=$_POST['submit'];
$uid		=$_POST['newuid'];
//CHECK SUBMIT
if ($submit == "OK"){
	$query ='SELECT *
				FROM users
				WHERE user_uid=?';
	$stmt = $pdo->prepare($query);
	$stmt->execute([$uid]);
	$result = $stmt->fetch();
	//CHECK IF UID EXISTS
	if ($result){
		header("Location: ../account.php?uid_change=taken");
		exit();
	}
	//CHECK IF UID IS VALID
	else if (preg_match("/^[a-zA-Z ]*$/",$first) || !preg_match("admin", $uid)
		|| preg_match("/^[a-zA-Z ]*$/",$last) || !preg_match("admin", $last)){
			$query = 'UPDATE users
						SET user_uid=?
						WHERE user_id=?';
			$stmt = $pdo->prepare($query);
			$stmt->execute([$uid, $id]);
			$_SESSION['user_uid']=$uid;
			header("Location: ../account.php?uid_change=success");
			exit();
	}
}
else {
	header("Location: ../account.php?uid_change=error");
			exit();
}