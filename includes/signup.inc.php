<?php

//Variables
$first = $_POST['first'];
$last = $_POST['last'];
$uid = $_POST['uid'];
$email = $_POST['email'];
$pwd = hash(md5, $_POST['pwd']);
$repwd = hash(md5, $_POST['repwd']);
$submit = $_POST['submit'];

if (isset($submit)) {
	include_once 'dbh.inc.php';
//Error Handeling
	//Check empty fields
	if (empty($first) || empty($last) || empty($uid) ||
		empty($email) || empty($pwd) || empty($repwd)){
		header("Location: ../signup.php?signup=fields_required");
		exit();
	}
	else {
	//Check Names
		if(!preg_match("/^[a-zA-Z]*$/", $first) || 
			!preg_match("/^[a-zA-Z]*$/", $last)){
			header("Location: ../signup.php?signup=error_names");
			exit();
		}
		else {
	//Check Email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?signup=error_email");
			exit();
			}
			else{
				$query = "SELECT * FROM users WHERE user_email=?";
				$stmt = $pdo->prepare($query);
				$stmt->execute([$email]);
				$result = $stmt->fetch();
				
				if ($result){
					header("Location: ../signup.php?signup=used_email");
					exit();
				}
				else {
//Check Uid
					$query = "SELECT * FROM users WHERE user_uid=?";
					$stmt = $pdo->prepare($query);
					$stmt->execute([$uid]);
					$result = $stmt->fetch();

					if ($result > 0){
					header("Location: ../signup.php?signup=used_user");
					exit();
					}
					else {
	//Check Pwd
						if ($pwd !== $repwd){
							header("Location: ../signup.php?signup=pwdmismatch");
							exit();
						}
						else if ($pwd == $repwd){
						$query = "INSERT INTO users (user_first, user_last, user_uid,
						user_email, user_pwd) VALUES (?, ?, ?, ?, ?)";
						$stmt = $pdo->prepare($query);
						$stmt->execute([$first, $last, $uid, $email, $pwd]);
						header("Location: ../signup.php?signup=success");
						exit();
						}
					}
				}
			}
		}
	}
}
else {
	header("Location: ../signup.php");
	exit();
}