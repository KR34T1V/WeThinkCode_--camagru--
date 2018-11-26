<?PHP
// ERROR REPORTING
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include_once "connect.back.php";
session_start();
//SESSION VARIABLES
// var_dump($_SESSION);
$user_id	=	$_SESSION['user_id'];
$user_uid	=	$_SESSION['user_uid'];
$img_name	=	uniqid("IMAGE=", TRUE).".png";
//VARIABLES
$OGimg		=	$_POST['img'];
$ac1		=	$_POST['ac1'];
$ac2		=	$_POST['ac2'];
$ac3		=	$_POST['ac3'];
$submit		=	$_POST['submit'];
$sticker1	=	"../dep/stick1.png";
$sticker2	=	"../dep/stick2.png";
$sticker3	=	"../dep/stick3.png";
//ERROR HANDELING
//check submit
if ($submit != "OK"){
	echo 'No Submit!';
	exit();
}
//if empty
if (empty($OGimg || empty($ac1) || empty($ac2) || empty($ac3))){
	echo 'No data!';
	exit();
}

//if is png
// if (strpos($OGimg, "data:image/png;base64") == FALSE){
// 	echo 'Wrong image format!';
// 	exit();
// }

// EXTRACT IMAGE DATA
$OGimg = str_replace(" ", "+", $OGimg);
$OGimg = str_replace("data:image/png;base64,", "", $OGimg);
$OGimg = base64_decode($OGimg);
$OGimg = imagecreatefromstring($OGimg);
imagepng($OGimg, 'tmp.png');

//OVERLAY IMAGES
if ($ac1 == 1){
	$sticker = imagecreatefrompng($sticker1);
	$OGimg = imagecreatefrompng('tmp.png');
	imagesavealpha($OGimg, true);
	imagealphablending($OGimg, true);
	$sticker = imagescale($sticker, 400, 300);
	imagesavealpha($sticker, true);
	imagecopy($OGimg, $sticker, 0, 0, 0, 0, 400, 300);
	imagepng($OGimg, 'tmp.png');
}
if ($ac2 == 1){
	$sticker = imagecreatefrompng($sticker2);
	$OGimg = imagecreatefrompng('tmp.png');
	imagesavealpha($OGimg, true);
	imagealphablending($OGimg, true);
	$sticker = imagescale($sticker, 400, 300);
	imagesavealpha($sticker, true);
	imagecopy($OGimg, $sticker, 0, 0, 0, 0, 400, 300);
	imagepng($OGimg, 'tmp.png');
}
if ($ac3 == 1){
	$sticker = imagecreatefrompng($sticker3);
	$OGimg = imagecreatefrompng('tmp.png');
	imagesavealpha($OGimg, true);
	imagealphablending($OGimg, true);
	$sticker = imagescale($sticker, 400, 300);
	imagesavealpha($sticker, true);
	imagecopy($OGimg, $sticker, 0, 0, 0, 0, 400, 300);
	imagepng($OGimg, 'tmp.png');
}
//COPY AND ADD TO DATABASE
if (copy("tmp.png", "../uploads/".$img_name)){
	$query = "INSERT INTO images (
				img_user_id,
				img_name,
				img_path			
				) VALUES (
				?,
				?,
				?
				)";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id, $img_name, "uploads/".$img_name]);
	echo "file uploaded\n".$img_name;
}
else {
	echo "Something Went Wrong!\n File failed to upload!";
	exit();
}
