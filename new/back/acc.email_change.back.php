<?PHP
session_start();
include_once "connect.back.php";
//VARIABLES 
$id			= $_SESSION['user_id'];
$email		= $_POST['email'];
$pwd		= $_POST['pwd'];

//CHECK EMPTY
if (!empty($email) && !empty($pwd)){
//CHECK EMAIL
	$query = "SELECT *
				FROM users
				WHERE user_email=?
			";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$email]);
	$result =$stmt->fetch();
	if ($result['user_email']==$email){
		header("Location: ../account.php?change_email=taken");
		exit();
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL)){
//CHECK PASSWORD
		$query = "SELECT *
		FROM users
		WHERE user_id=?
		";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$id]);
		$result =$stmt->fetch();
		if (password_verify($pwd, $result['user_pwd'])){
			$query = "UPDATE users
						SET user_email=?, user_verified='0'
						WHERE user_id=?";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$email, $id]);
			$_SESSION['user_email']=$email;
			$_SESSION['user_verified']=0;
			header("Location: ../account.php?change_email=success");
			exit();
		}
		else {
			header("Location: ../account.php?change_email=pwd_error");
			exit();
		}
	}
	else {
		header("Location: ../account.php?change_email=email_error");
			exit();
	}
}
else {
	header("Location: ../account.php?change_email=empty");
		exit();
}