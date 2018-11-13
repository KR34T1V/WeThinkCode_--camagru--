<?PHP
include_once "header.php";
include_once "back/connect.back.php";

$img		= $_GET['img'];
$query = "SELECT *
			FROM images
			WHERE img_id=?
			";
$stmt = $pdo->prepare($query);
$stmt->execute([$img]);
$result = $stmt->fetch();
if ($view = $result['img_path']){
	echo '<DIV>
			<img src="'.$view.'">
			<FORM>
				<BUTTON>Like!</BUTTON>
			</FORM>
			<FORM>
				<INPUT type="text" name="comment" placeholder="Comment Here">
				<BUTTON>Like!</BUTTON>
			</FORM>
		</DIV>';
}
else{
	echo 'Error 404. Image not found!';
}

include_once "footer.php";