<?PHP
/*********************HEADER********************/
include_once "header.php";
include_once "back/connect.back.php";
/*********************END********************/

/*********************BODY********************/
if (!$_SESSION['user_id']){
	header("Location: index.php?login=required");
	exit();
}
//VARIABLES
$img		= $_GET['img'];
$user_id	= $_SESSION['user_id'];
// GET LIKE INFO
$query = "SELECT *
			FROM likes
			WHERE like_img_id=?
			";
$stmt = $pdo->prepare($query);
$stmt->execute([$img]);
$result = $stmt->fetchAll();
$likes = count($result);
$query = "SELECT *
			FROM likes
			WHERE like_img_id=?
			AND like_user_id=?
			";
$stmt = $pdo->prepare($query);
$stmt->execute([$img, $user_id]);
$result = $stmt->fetch();
//MORE VARIABLES
if ($result['like_user_id'] == $user_id){
	$liked = 1;
}
else {
	$liked = 0;
}
//VIEW IMAGE
$query = "SELECT *
			FROM images
			WHERE img_id=?
			";
$stmt = $pdo->prepare($query);
$stmt->execute([$img]);
$result = $stmt->fetch();
if ($view = $result['img_path']){
	//SHOW IMAGE
	echo '<DIV class="img center">
		<img class="center" src="'.$view.'">';
	//SHOW LIKE BUTTON
	if ($liked == 1) {
		echo '<FORM action="back/like.back.php" method="POST">
				<BUTTON name="img" value="'.$img.'">Unlike! '.$likes.'</BUTTON>
			</FORM>
			';
	}
	//SHOW UNLIKE BUTTON
	else {
	echo 	'<FORM action="back/like.back.php" method="POST">
				<BUTTON name="img" value="'.$img.'">Like! '.$likes.'</BUTTON>
			</FORM>';
	}
	echo	'<FORM action="back/comment.back.php" method="POST">
	<INPUT type="text" name="comment" placeholder="Comment Here">
	<BUTTON name="img" value="'.$img.'">Leave Comment</BUTTON>
	</FORM>';
	//SHOW DELETE BUTTON
	if ($result['img_user_id'] == $user_id){
		echo '<FORM action="back/del_img.back.php" method="POST">
				<BUTTON name="img" value="'.$img.'">Delete This Image</BUTTON>
				</FORM>';
	}
	echo '</DIV>';
	//GET COMMENTS
	$query = "SELECT *
				FROM comments
				WHERE cmt_img_id=?
				ORDER BY date_created
				DESC";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$img]);
	$result = $stmt->fetchAll();
	foreach ($result as $cmt){
		//COMMNET VARIABLES
		$cmt_user_id	= $cmt['cmt_user_id'];
		$cmt_img_id		= $cmt['cmt_img_id'];
		$comment		= $cmt['comment'];
		$cmt_date_created	= $cmt['date_created'];

		$query = "SELECT *
					FROM users
					WHERE user_id=?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$cmt_user_id]);
		$cmt_res = $stmt->fetch();
		//DISPLAY COMMENT
		$cmt_username = $cmt_res['user_uid'];
		echo'<DIV class="comments">
				<H4>'.$cmt_username.':</H4>
				<H4>'.$cmt_date_created.'</H4>
				<DIV>
					<P>'.$comment.'</P>
				</DIV>
			</DIV>';
	}
}
else{
	echo 'Error 404. Image not found!';
}
/*********************END********************/

/*********************FOOTER********************/
include_once "footer.php";
/*********************END********************/
