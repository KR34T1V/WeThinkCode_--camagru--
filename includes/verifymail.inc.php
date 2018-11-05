<?PHP
session_start();
$path	 = $_SERVER['HTTP_HOST'];
$path	 .= $_SERVER['REQUEST_URI'];
$path	 = str_replace("verifymail.inc.php", "verify.inc.php", $path);
$user	 = $_SESSION['user_uid'];
$email	 = $_SESSION['user_email'];
$hash	 = hash(md5, $email).hash(md5,$user);
$to		 = $email;
$subject = 'Camagru! | Account Verification'; // email subject
$message = '
<HTML>
<p>
Thank you '.$_SESSION['user_first'].' '.$_SESSION['user_last']
.' for signing up with Camagru!
</p>
<p>
Your Account has been successfully created using the following credentials:
</p>
<p>
---------------------------------------------------<br />
Username: <a>'.$user.'</a><br />
E-Mail: <a>'.$email.'</a><br />
--------------------------------------------------- <br />
</p>

Please click the link below to verify your account: <br />
<a href="http://'.$path.'?email='
.$email.'&hash='.$hash.'">Verify Here</a>
</HTML>
';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <noreply@camagru.co.za>'."\r\n";
$headers .= 'Reply-To: <noreply@camagru.co.za>' ."\r\n";
$headers .= 'X-Mailer: PHP/' . PHP_VERSION;

mail($to, $subject, $message, $headers); //send the email
header("Location: ../account.php?verify=sent");
