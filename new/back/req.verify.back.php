<?PHP
session_start();
include_once "connect.back.php";
//VARIABLES
$user_first			= $_SESSION['user_first'];
$user_last			= $_SESSION['user_last'];
$user_uid			= $_SESSION['user_uid'];
$user_email			= $_SESSION['user_email'];

//HASHED VARIABLES
$mail_key_hashed = password_hash($user_email, PASSWORD_DEFAULT);

//MAIL VARIABLES
$mail_path			= $_SERVER['HTTP_HOST'];
$mail_path			.= $_SERVER['REQUEST_URI'];
$mail_path			= str_replace("signup.back.php", "req.verify.back.php", $mail_path);
$mail_header_cont	= "Content-type:text/html;charset=UTF-8" . "\r\n";
$mail_header_mailer	= 'X-Mailer: PHP/' . PHP_VERSION;
$mail_header_from	= 'From: <noreply@camagru.cterblan>'."\r\n";
$mail_header_reply	= 'Reply-To: <support@camagru.cterblan>' ."\r\n";
$mail_header		= $mail_header_from . $mail_header_reply . $mail_header_mailer . $mail_header_cont;
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
						<a href="http://'.$mail_path.'?key='.$mail_key_hashed.'">The Link To Click</a><br />
						<p> Kind Regards <br />
						CAMAGRU Team!</p>
					</HTML>';
if (!$_GET['key']) {
	mail($mail_to, $mail_subject, $mail_message, $mail_header);
	header("Location: ../req.verify.php?verify=email_sent");
	exit();
}
else if (password_verify($user_email, $_GET['key'])) {
	$query = "UPDATE users 
				SET user_verified='1' 
				WHERE user_email=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_email]);
	$_SESSION['user_verified'] = 1;
	header("Location: ../index.php");
	exit();
}
else {
	header("Location: ../req.verify.php");
	exit();
}