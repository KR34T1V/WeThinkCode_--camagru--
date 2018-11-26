<?PHP
include_once "database.php";
//DELETE USERS
$query = "DROP TABLE users";
if ($pdo->prepare($query)->execute() === TRUE)
	echo "users TABLE deleted\n";
else
	echo "users TABLE failed\n";

//DELETE IMAGES
$query = "DROP TABLE images";
if ($pdo->prepare($query)->execute() === TRUE)
	echo "images TABLE deleted\n";
else
	echo "images TABLE failed\n";
$files = scandir('../uploads');

foreach($files as $file){
	if (unlink("../uploads/".$file))
		echo $file." in uploads deleted\n";
	else
		echo $file." in uploads failed to delete\n";
}

//DELETE LIKES
$query = "DROP TABLE likes";
if ($pdo->prepare($query)->execute() === TRUE)
	echo "likes TABLE deleted\n";
else
	echo "likes TABLE failed\n";

//DELETE COMMENTS
$query = "DROP TABLE comments";
if ($pdo->prepare($query)->execute() === TRUE)
echo "comments TABLE deleted\n";
else
echo "comments TABLE failed\n";