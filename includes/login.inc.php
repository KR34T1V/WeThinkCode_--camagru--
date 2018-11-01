<?php

session_start();

$uid = $_POST['uid'];
$pwd = hash(md5, $_POST['pwd']);
$submit = $_POST['submit'];

if (isset($submit)){
	include_once 'dbh.inc.php';
//Check empty
	if (empty($uid) || empty($pwd)){
		header("Location: ../index.php?login=empty");
		exit();
	}
	else {
// Check Username or Email
		$query = "SELECT * FROM users WHERE user_uid=:username OR
			user_email=:username";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(':username', $uid);
		$stmt->execute();
		$result = $stmt->fetch();
		if (!$result){
			header("Location: ../index.php?login=unknown_user");
			exit();
		}
		else if (!$result ||!$pwd == $result['user_pwd']){
// Check Password
			header("Location: ../index.php?login=error_credentials");
			exit();
		}
		else if ($result && $pwd == $result['user_pwd']){
//Login User
			$_SESSION['user_id'] = $result['user_id'];
			$_SESSION['user_first'] = $result['user_first'];
			$_SESSION['user_last'] = $result['user_last'];
			$_SESSION['user_uid'] = $result['user_uid'];
			$_SESSION['user_email'] = $result['user_email'];
			header("Location: ../index.php?login=success");
			exit();
		}
	}
}
else{
	header("Location: ../index.php?login=error");
}