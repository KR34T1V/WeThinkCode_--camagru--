<?PHP

//CONNECT WITH SERVER
include_once "connect.back.php";
//MAIN VARIABLES
$user_first		= $_POST['first'];
$user_last		= $_POST['last'];
$user_uid		= $_POST['uid'];
$user_email		= $_POST['email'];
$user_pwd		= $_POST['pwd'];
$user_repwd		= $_POST['repwd'];
$user_notify	= 1;
$submit			= $_POST['submit'];
//HASHED VARIABLES
$user_pwd_hashed = password_hash($user_pwd, PASSWORD_DEFAULT);
$mail_key_hashed = password_hash($user_email, PASSWORD_DEFAULT);

//MAIL VARIABLES
$mail_path			= $_SERVER['HTTP_HOST'];
$mail_path			.= $_SERVER['REQUEST_URI'];
$mail_path			= str_replace("signup.back.php", "req.verify.back.php", $mail_path);
$mail_header_cont	= "Content-type:text/html;charset=UTF-8" . "\r\n";
$mail_header_mailer	= 'X-Mailer: PHP/' . PHP_VERSION;
$mail_header_from	= 'From: <noreply@camagru.cterblan>'."\r\n";
$mail_header_reply	= 'Reply-To: <support@camagru.cterblan>' ."\r\n";
$mail_header		= $mail_header_cont .','. $mail_header_mailer .','. $mail_header_from .','. $mail_header_reply;
$mail_to 			= $user_email;
$mail_subject		= "Camagru! | Account Verification";
$mail_message		='<HTML>
						<p>Thank you '.$user_first.' '.$user_last.' for signing up with Camagru.cterblan!</p><br />
						<DIV>
						<p>--------------------------------------------------------------------------------</p><br />
						<p>Username: '.$user_uid.'</p><br />
						<p>E-mail: '.$user_email.'</p><br />
						<p>--------------------------------------------------------------------------------</p><br />
						</DIV>
						<p>We are just a small step from getting you verified and started with Camagru</p><br />
						<p>Please click the link below to be redirected to our verification page</p><br />
						<a href="http://'.$mail_path.'?key='.$mail_key_hashed.'">The Link To Click</a>
					</HTML';

//Check Submit Button
if ($submit =="OK"){
	if (!empty($user_first) || !empty($user_last) || !empty($user_uid) || !empty($user_email)
	|| !empty($user_pwd) || !empty($user_repwd)){
		//Check Names
		if (preg_match("/^[a-zA-Z ]*$/",$first) || !preg_match("admin", $uid)
		|| preg_match("/^[a-zA-Z ]*$/",$last) || !preg_match("admin", $last)){
			$query = 'SELECT * FROM users WHERE user_uid=?';
			$stmt = $pdo->prepare($query);
			$stmt->execute([$user_uid]);
			$result = $stmt->fetch();
			if ($result){
				header("Location: ../signup.php?signup=username_taken");
				exit();
			}
			//Check Email
			else if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
				$query = 'SELECT * FROM users WHERE user_email=?';
				$stmt = $pdo->prepare($query);
				$stmt->execute([$user_email]);
				$result = $stmt->fetch();
				if ($result){
					header("Location: ../signup.php?signup=email_taken");
					exit();
				}
				//Check Passwords Matching
				if ($user_pwd = $user_repwd){
					//Check Password Complexity
					if (strlen($user_pwd) < 6 || !preg_match("#[0-9]+#", $user_pwd) ||
						!preg_match("#[a-zA-Z]+#", $user_pwd)) {
							header("Location: ../signup.php?signup=pwd_weak");
							exit();
					}
					else {
					//Populate Database With User Info
					echo "here";
						$query = "INSERT INTO users
										(
											user_first,
											user_last,
											user_uid,
											user_email,
											user_pwd,
											user_verified,
											user_notify
										)
										VALUES
										(
											?,
											?,
											?,
											?,
											?,
											?,
											?
										)";
						$stmt	= $pdo->prepare($query);
						$stmt->execute([$user_first, $user_last, $user_uid, $user_email, $user_pwd_hashed, 0, $user_notify]);
						mail($mail_to, $mail_subject, $mail_message, $mail_header);
						header("Location: ../index.php?signup=success");
						exit();
					}
				}
				else {
					header("Location: ../signup.php?signup=pwd_mismatch");
					exit();
				}
			}
			else {
				header("Location: ../signup.php?signup=email_invalid");
				exit();
			}
		}
		else {
			header("Location: ../signup.php?signup=username_invalid");
			exit();
		}
	}
	header("Location: ../signup.php?signup=fields_empty");
	exit();
}
else {
	header("Location: ../signup.php?signup=error");
	exit();
}