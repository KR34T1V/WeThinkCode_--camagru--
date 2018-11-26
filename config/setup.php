<?PHP

include_once "database.php";

//Create DataBas
$query	= "CREATE DATABASE ". $db_name;
$stmt = $pdo->prepare($query)->execute();

//Create Users Table
$query = "CREATE TABLE users(
			user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			user_first VARCHAR(30) NOT NULL,
			user_last VARCHAR(30) NOT NULL,
			user_uid VARCHAR(30) NOT NULL,
			user_email VARCHAR(80) NOT NULL,
			user_pwd VARCHAR(256) NOT NULL,
			date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
			user_verified TINYINT(1),
			user_notify TINYINT(1)
)";
if ($pdo->prepare($query)->execute() === TRUE)
	echo "users TABLE created\n";
else
	echo "users TABLE failed\n";

//MAKE IMAGE TABLE
$query = "CREATE TABLE images(
			img_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			img_user_id INT(11) NOT NULL,
			img_name VARCHAR(256) NOT NULL,
			img_path VARCHAR(256) NOT NULL,
			date_created DATETIME DEFAULT CURRENT_TIMESTAMP
			)";
if ($pdo->prepare($query)->execute() === TRUE)
echo "images TABLE created\n";
else
echo "images TABLE failed\n";

//MAKE COMMENT TABLE
$query = "CREATE TABLE comments(
			cmt_img_id INT(11) NOT NULL,
			cmt_user_id INT(11) NOT NULL,
			comment VARCHAR(256) NOT NULL,
			date_created DATETIME DEFAULT CURRENT_TIMESTAMP
			)";
if ($pdo->prepare($query)->execute() === TRUE)
echo "comments TABLE created\n";
else
echo "comments TABLE failed\n";
//MAKE Likes TABLE
$query = "CREATE TABLE likes(
	like_img_id INT(11) NOT NULL,
	like_user_id INT(11) NOT NULL,
	liked TINYINT(1),
	user_created DATETIME DEFAULT CURRENT_TIMESTAMP
	)";
if ($pdo->prepare($query)->execute() === TRUE)
echo "likes TABLE created\n";
else
echo "likes TABLE failed\n";