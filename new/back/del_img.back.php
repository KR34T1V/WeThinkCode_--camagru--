<?PHP
// ERROR REPORTING
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once "connect.back.php";

//VARIABLES
$user_id	=	$_SESSION['user_id'];
$img_id		=	$_POST['img'];

$query = "SELECT *
			FROM images
			WHERE img_id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$img_id]);
$result = $stmt->fetch();
if ($result['img_user_id'] == $user_id){
	//DELETE IMAGE DATA
	unlink("../".$result['img_path']);
	//REMOVE FROM IMAGES DATABASE
	$query = "DELETE FROM images WHERE img_id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$img_id]);
	//REMOVE ALL LIKES
	$query = "DELETE FROM likes WHERE likes_img_id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$img_id]);
	//REMOVE ALL COMMENTS
	$query = "DELETE FROM comments WHERE cmt_img_id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$img_id]);
	header("Location: ../index.php?delete_img=success");
}