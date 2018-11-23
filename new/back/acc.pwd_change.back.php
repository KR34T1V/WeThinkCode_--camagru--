<?PHP
session_start();
include_once "connect.back.php";
//VARIABLES
$id			= $_SESSION['user_id'];
$oldpwd		= htmlentities($_POST['oldpwd']);
$newpwd		= htmlentities($_POST['newpwd']);
$repwd		= htmlentities($_POST['repwd']);
//HASHED VARIABLES
$newpwd_hashed = password_hash($newpwd, PASSWORD_DEFAULT);
//CHECK IF EMPTY
if (!empty($oldpwd) && !empty($newpwd) && !empty($repwd)){
	//CHECK IF NEW PASSWORDS MATCH
	if ($newpwd == $repwd) {
		//CHECK IF NEW PASSWORDS ARE COMPLEX
		if (strlen($newpwd) < 6 || !preg_match("#[0-9]+#", $newpwd) ||
			!preg_match("#[a-zA-Z]+#", $newpwd)) {
				header("Location: ../account.php?pwd_change=pwd_weak");
				exit();
		}
		$query = "SELECT *
					FROM users
					WHERE user_id=?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$id]);
		$result = $stmt->fetch();
		//CHECK IF PASSWORD IS VALID
		if (password_verify($oldpwd, $result['user_pwd'])){
			$query = "UPDATE users
						SET user_pwd=?
						WHERE user_id=?";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$newpwd_hashed, $id]);
			header("Location: ../account.php?pwd_change=success");
			exit();
		}
		else {
			header("Location: ../account.php?pwd_change=pwd_incorrect");
			exit();
		}
	}
	else {
		header("Location: ../account.php?pwd_change=pwd_mismatch");
		exit();
	}
}
else {
	header("Location: ../account.php?pwd_change=fields_empty");
	exit();
}