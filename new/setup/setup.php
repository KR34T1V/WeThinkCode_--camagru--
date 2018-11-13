<?PHP

//Variables
$db_host	= 'localhost';
$db_port	= '3306';
$db_user	= 'root';
$db_pwd		= 'Papenworsmetmelk1';
$db_name	= 'cterblan_camagru';

//Create DataBase
$conn	= mysqli_connect($db_host, $db_user, $db_pwd);
$query	= "CREATE DATABASE ". $db_name;
//Check Success
if ($conn->query($query) === TRUE) {
    echo "Database ".$db_name." created successfully\n";
}
else {
    echo "Error creating Database ".$db_name.": " . $conn->error."\n";
}

//Create Users Table
$conn= mysqli_connect($db_host, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$query = "CREATE TABLE users(
			user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			user_first VARCHAR(30) NOT NULL,
			user_last VARCHAR(30) NOT NULL,
			user_uid VARCHAR(30) NOT NULL,
			user_email VARCHAR(80) NOT NULL,
			user_pwd VARCHAR(256) NOT NULL,
			user_created DATETIME DEFAULT CURRENT_TIMESTAMP,
			user_verified TINYINT(1),
			user_notify TINYINT(1)
)";
//Check Success
if ($conn->query($query) === TRUE) {
    echo "Table: users created successfully\n";
}
else {
    echo "Error creating Table: users: " . $conn->error."\n";
}
//MAKE IMAGE TABLE
$query = "CREATE TABLE images(
			img_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			img_user_id INT(11) NOT NULL,
			img_name VARCHAR(256) NOT NULL,
			img_path VARCHAR(256) NOT NULL,
			img_created DATETIME DEFAULT CURRENT_TIMESTAMP
			)";
//Check Success
if ($conn->query($query) === TRUE) {
    echo "Table: images created successfully\n";
}
else {
    echo "Error creating Table: images: " . $conn->error."\n";
}
//MAKE COMMENT TABLE
$query = "CREATE TABLE comments(
			cmt_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			cmt_img_id INT(11) NOT NULL,
			cmt_user_id INT(11) NOT NULL,
			comment VARCHAR(256) NOT NULL,
			user_created DATETIME DEFAULT CURRENT_TIMESTAMP
			)";
//Check Success
if ($conn->query($query) === TRUE) {
    echo "Table: comments created successfully\n";
}
else {
    echo "Error creating Table: comments: " . $conn->error."\n";
}
//MAKE Likes TABLE
$query = "CREATE TABLE likes(
	like_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	like_img_id INT(11) NOT NULL,
	like_user_id INT(11) NOT NULL,
	liked TINYINT(1),
	user_created DATETIME DEFAULT CURRENT_TIMESTAMP
	)";
//Check Success
if ($conn->query($query) === TRUE) {
echo "Table: likes created successfully\n";
}
else {
echo "Error creating Table: likes: " . $conn->error."\n";
}