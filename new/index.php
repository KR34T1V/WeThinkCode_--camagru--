<?PHP
//Include Header
include_once "header.php";
include_once "back/connect.back.php";
if ($_SESSION['user_id']){
	echo'
		<p>Welcome '.$_SESSION['user_first'].' '.$_SESSION['user_last'].'. You are logged in!</p>
	';
}
else if ($_GET['signup']=="success"){
	echo '
	<p>You have successfully signed up! Please login above</p>
	';
}
else if ($_GET['pwd_reset'] == "failed"){
	echo '
	<p>Password reset failed please try again later.</p>
	';
}
else if ($_GET['pwd_reset'] == "success"){
	echo '
	<p>Password successfully reset please login</p>
	';
}
//GET IMAGES
$query = "SELECT *
			FROM images
			ORDER BY img_created
			DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
//DISPLAY IMAGES
foreach ($result as $img){

	echo '<a href="view.php?img='.$img['img_id'].'"><img src="'.$img['img_path'].'"></a>';
}
?>

<?PHP
//Include Footer
include_once "footer.php";
?>