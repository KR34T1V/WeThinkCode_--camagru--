<?PHP
/*********************HEADER********************/
include_once "header.php";
include_once "back/connect.back.php";
/*********************END********************/

/*********************BODY********************/

/********************DISPLAY ERROR/SUCCESS MESSAGES TO FRONT PAGE**************************/
//IF USER IS LOGGED IN
if ($_SESSION['user_id']){
	echo'
		<p>Welcome '.$_SESSION['user_first'].' '.$_SESSION['user_last'].'. You are logged in!</p>
	';
}
//IF SUCCESSFULL SIGNUP
else if ($_GET['signup']=="success"){
	echo '
	<p>You have successfully signed up! Please login above</p>
	';
}
//IF FAILED PASSWORD RESET
else if ($_GET['pwd_reset'] == "failed"){
	echo '
	<p>Password reset failed please try again later.</p>
	';
}
//IF SUCCESSFULL PASSWORD RESET
else if ($_GET['pwd_reset'] == "success"){
	echo '
	<p>Password successfully reset please login</p>
	';
}
//IF LOGIN IS REQUIRED 
else if ($_GET['login']=="required"){
	echo '
	<p>Login Required! Please login above</p>
	';
}
/********************DISPLAY ERROR/SUCCESS MESSAGES TO FRONT PAGE END**************************/

/********************DISPLAY IMAGES TO FRONT PAGE**************************/
//GET IMAGES
try {
	$query = "SELECT COUNT(*) FROM images";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
}
catch(PDOException $err){
	echo $err;
}

$img_count = $stmt->fetchColumn();
$img_num_page = 5;
$page_count = ceil($img_count / $img_num_page);
//GET CURRENT PAGE
if (is_numeric($_GET['page_num'])) {
	$page_num = (int)$_GET['page_num'];
}
else {
	$page_num = 1;
}
//CHECK IF PAGE NUMBER IS LARGER THAN PAGE AMMOUNT
if ($page_num > $page_count) {
	$page_num = $page_count;
}
else if ($page_num < 1) {
	$page_num = 1;
}
//SET STARTING POINT FOR IMAGES
$offset = ($page_num - 1) * $img_num_page;

//GET IMAGE DATA FROM DATABASE
try {
	$query = "SELECT *
				FROM images
				ORDER BY date_created
				DESC
				LIMIT $offset, $img_num_page";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
}
catch(PDOException $err){
	echo $err;
}
//DISPLAY IMAGES
foreach ($result as $img){

	echo '<DIV class="center img">
			<A href="view.php?img='.$img['img_id'].'" alt="'.$img['img_path'].'"><img class="center" src="'.$img['img_path'].'"></A>
			</DIV>';
}
	echo	'<DIV class="center page-num">';
/********************DISPLAY IMAGES TO FRONT PAGE END**************************/

/********************PAGINATION**************************/
//NUMBER OF PAGE LINKS TO SHOW
$page_links = 3;
//PREVIOUS PAGE
$prev_page_num = $page_num - 1;
//QUICK LINK TO PAGE 1
if ($page_num > 1) {
	if ($prev_page_num > 1) {
		echo "<A href='{$_SERVER['PHP_SELF']}?page_num=1'>1..</A>";
	}
//QUICK LINK TO PREV PAGE
	echo "<A href='{$_SERVER['PHP_SELF']}?page_num=".$prev_page_num."'>$prev_page_num</A>";
}
//SHOW LINKS TO PAGE NUMBERS
for ($x = ($page_num - $page_links); $x < (($page_num + $page_links) + 1); $x++) {
	//CHECK VALID NUMBER
	if ($x > 0 && $x <= $page_count){
		//BOLD CURRENT PAGE
		if ($x == $page_num){
			echo "<B>$x</B>";
		}
		else if ($x > 1 && $x <= $page_count){
			echo "<A href='{$_SERVER['PHP_SELF']}?page_num=$x'>$x</A>";
		}
	}
}
//SHOW FORWARD LINKS
if ($x < $page_count) {
	//NEXT PAGE
	$next_page_num = $page_num + 1;
	if ($next_page_num < $page_count){
		echo "<A href='{$_SERVER['PHP_SELF']}?page_num=".$next_page_num."'>$next_page_num</A>";
	}
	echo "<A href='{$_SERVER['PHP_SELF']}?page_num=".$page_count."'>..".$page_count."</A>";
}
echo '</DIV>';
/********************PAGINATION END**************************/
/*********************END********************/

/*********************FOOTER********************/
include_once "footer.php";
/*********************END********************/