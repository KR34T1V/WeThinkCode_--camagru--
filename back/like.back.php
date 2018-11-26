<?PHP
session_start();
include_once "connect.back.php";

//VARIABLES
$img_id		= $_POST['img'];
$user_id	= $_SESSION['user_id'];
//CHECK IF LOGGED IN
if (!$user_id || !$img_id){
	header("Location: ../view.php?img=".$img_id);
	exit();
}
//GET IMAGE DATA
$query = "SELECT *
			FROM likes
			WHERE like_img_id=?
			AND like_user_id=?
		";
$stmt = $pdo->prepare($query);
$stmt->execute([$img_id, $user_id]);
$result = $stmt->fetch();
//DELETE IF ALREADY LIKED
if ($result['like_user_id'] == $user_id){
	$query = "DELETE FROM likes
				WHERE like_user_id=?
				";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id]);
	header("Location: ../view.php?img=".$img_id);
	exit();
}
//UPDATE IF NOT LIKED
else if (!$result['like_user_id']) {
	$query = 'INSERT INTO likes
			(
				like_img_id,
				like_user_id,
				liked
			)
			VALUES
			(
				?,
				?,
				?
			)';
$stmt = $pdo->prepare($query);
$stmt->execute([$img_id, $user_id, 1]);
header("Location: ../view.php?img=".$img_id);
exit();
}
else {
	echo 'An error occured!';
}