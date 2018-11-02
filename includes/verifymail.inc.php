<?PHP
session_start();
$email	 = $_SESSION['user_email'];
$hash	 = hash(md5, $email);
$to		 = $email;
$subject = 'Camagru! | Account Verification'; // email subject
$message = '

Thank you '.$_SESSION['user_first'].' '.$_SESSION['user_last']
.' for signing up with Camagru!

Your Account has been successfully created using the following credentials:

---------------------------------------------------
Username: '.$_SESSION['user_uid'].'
E-Mail: '.$_SESSION['user_email'].'
---------------------------------------------------

Please click the link below to verify your account:
http://localhost:8100/camagru/includes.verify.inc.php?email='
.$_SESSION['user_email'].'&hash='.$hash.'';

$headers ='From: noreply@camagru.co.za'."\r\n";
mail($to, $subject, $message, $headers); //send the email
header("Location: ../account.php?verify=sent");
