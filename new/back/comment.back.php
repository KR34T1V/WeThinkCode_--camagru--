<?PHP
session_start();
include_once "connect.back.php";
//VARIABLES
$img_id			= $_POST['img'];
$comment	= $_POST['comment'];
$user_id		= $_SESSION['user_id'];
//GET IMAGE DATA
$query = "SELECT *
			FROM images
			WHERE img_id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$img_id]);
$result = $stmt->fetch();
$img_owner = $result['img_user_id'];
//GET OWNER
$query = "SELECT *
			FROM users
			WHERE user_id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$img_owner]);
$result = $stmt->fetch();

$img_owner_first	= $result['user_first'];
$img_owner_last		= $result['user_last'];
$img_owner_email	= $result['user_email'];
$img_owner_notify	= $result['user_notify'];
//MAIL VARIABLES
$mail_header_cont	= "Content-type:text/html;charset=UTF-8" . "\r\n";
$mail_header_mailer	= 'X-Mailer: PHP/' . PHP_VERSION;
$mail_header_from	= 'From: <noreply@camagru.cterblan>'."\r\n";
$mail_header_reply	= 'Reply-To: <support@camagru.cterblan>' ."\r\n";
$mail_header		= $mail_header_from . $mail_header_reply . $mail_header_mailer . $mail_header_cont;
$mail_to 			= $img_owner_email;
$mail_subject		= "Camagru! | Comment on Your Post!";
$mail_message		='<HTML>
						<p>Dear'.$img_owner_first.' '.$img_owner_last.', </p><br />
						<p>We are happy to notify you that you have a new comment on one of yout posts!</p><br />
					</HTML';
//CHECK IF LOGGED IN
if (!$_SESSION['user_id'] || !$img_id || empty($comment)){
	header("Location: ../view.php?img=".$img_id);
	exit();
}
//ADD COMMENT TO TABLE
else if ($user_id && $img_id && $comment){
	$query = 'INSERT INTO comments
			(
				cmt_img_id,
				cmt_user_id,
				comment
			)
			VALUES
			(
				?,
				?,
				?
			)';
	$stmt = $pdo->prepare($query);
	$stmt->execute([$img_id, $user_id, $comment]);
	if ($img_owner_notify == 1) {
		mail($mail_to, $mail_subject, $mail_message, $mail_header);
	}
	header("Location: ../view.php?img=".$img_id);
	exit();
}
else{
	header("Location: ../view.php?img=".$img_id);
	exit();
}