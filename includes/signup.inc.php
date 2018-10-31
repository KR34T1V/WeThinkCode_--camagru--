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
		header("Location: ../signup.php?signup=requiredfields");
		exit();
	}
	else {
	//Check Names
		if(!preg_match("/^[a-zA-Z]*$/", $first) || 
			!preg_match("/^[a-zA-Z]*$/", $last)){
			header("Location: ../signup.php?signup=!names");
			exit();
		}
		else {
	//Check Email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?signup=!email");
			exit();
			}
			else {
	//Check Uid

				//INSERT CODE HERE

				if (/*USER ID IS TAKEN*/$result){
				header("Location: ../signup.php?signup=!usertaken");
				exit();
			}
				else {
	//Check Pwd
					if ($pwd == $repwd){
					header("Location: ../signup.php?signup=success");
					exit();
				}
					else{
						//header("Location: ../signup.php?signup=pwdmismatch");
						echo $pwd."||";
						echo $repwd."||";
						echo hash(md5, $pwd);
						exit();
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