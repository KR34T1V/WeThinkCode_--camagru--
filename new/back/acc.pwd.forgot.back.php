<?PHP

include_once "connect.back.php";

//VARIABLES
$email		= $_POST['email'];
$pwd		= $_POST['pwd'];
$repwd		= $_POST['repwd'];
$submit		= $_POST['submit'];



//CHECK SUBMIT
if ($submit == "OK"){
	//CHECK PASSWORDS MATCH
	if ($pwd == $repwd){
		//CHECK IF NEW PASSWORDS ARE COMPLEX
		if (strlen($pwd) < 6 || !preg_match("#[0-9]+#", $pwd) ||
			!preg_match("#[a-zA-Z]+#", $pwd)) {
				header("Location: ../forgot.pwd.php?pwd_reset=pwd_weak");
				exit();
		}
		$query = "SELECT *
					FROM users
					WHERE user_email=?
					OR user_uid=?
					";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$email, $email]);
		$result = $stmt->fetch();
		//CHECK IF EMAIL EXISTS ON SYSTEM
		if ($result){
			//MAIL VARIABLES
			$mail_email			= $result['user_email'];
			$mail_id				= $result['user_id'];
			$mail_first			= $result['user_first'];
			$mail_last			= $result['user_last'];
			//HASHED VARIABLES
			$email_hashed	= password_hash($mail_email, PASSWORD_DEFAULT);
			$pwd_hashed		= password_hash($pwd, PASSWORD_DEFAULT);
			//MAIL VARIABLES
			$mail_path			= $_SERVER['HTTP_HOST'];
			$mail_path			.= $_SERVER['REQUEST_URI'];
			$mail_path			= str_replace("acc.pwd.forgot.back.php", "acc.pwd_reset.back.php", $mail_path);
			$mail_header_cont	= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$mail_header_mailer	= 'X-Mailer: PHP/' . PHP_VERSION;
			$mail_header_from	= 'From: <noreply@camagru.cterblan>'."\r\n";
			$mail_header_reply	= 'Reply-To: <support@camagru.cterblan>' ."\r\n";
			$mail_header		= $mail_header_from . $mail_header_reply . $mail_header_mailer . $mail_header_cont;
			$mail_to 			= $mail_email;
			$mail_subject		= "Camagru! | Account Verification";
			$mail_message		='<HTML>
									<h3>Dear '.$mail_first.' '.$mail_last.',</h3>
									<P>We are sorry to hear the you forgot your password to access Camagru!<br />
									Please use the link below to reset your account\'s password.</P><br />
									<a href="http://'.$mail_path.'?user='.$mail_id.'&key='.$email_hashed.'&rdm='.$pwd_hashed.'">Click Me!<A><br />
									<h3>Not '.$mail_first.' ?</h3>
									<P>Please delete and ignore this email.</P>
									</HTML>';
			//SEND MAIL
			mail($mail_to,$mail_subject, $mail_message, $mail_header);
			header("Location: ../forgot.pwd.php?mail=".$mail_email);
			exit();
		}
		else {
			header("Location: ../forgot.pwd.php?mail=pwd_invalid");
			exit();
		}
	}
	else {
		header("Location: ../forgot.pwd.php?mail=invalid_user");
		exit();
	}
}
else {
	header("Location: ../forgot.pwd.php?mail=error");
	exit();
}