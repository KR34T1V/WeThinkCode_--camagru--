<?PHP
session_start();
include_once "connect.back.php";
//VARIABLES
$user_id		= $_SESSION['user_id'];
$file			= $_FILES['img'];
$file_name		= $file['name'];
$file_tmp_name	= $file['tmp_name'];
$file_size		= $file['size'];
$file_error		= $file['error'];
$file_type		= $file['type'];
$submit			= $_POST['submit'];

$allowed_files	= array('jpg', 'jpeg', 'png', 'tif', 'gif', );
//CHECK SUBMIT
if ($submit == "OK"){
	$file_ext 	= strtolower(end(explode('.', $file_name)));

	if (in_array($file_ext, $allowed_files)){
		if ($file_error === 0){
			if ($file_size < 4000000){
				$file_name_new = uniqid('',true).".".$file_ext;
				$file_dest = "../uploads/".$file_name_new;
				$file_root_path = "uploads/".$file_name_new;
				$test = move_uploaded_file($file_tmp_name, $file_dest);
				if ($test == 1){
					$query = "INSERT 
								INTO images(
									img_user_id,
									img_name,
									img_path
								)
								VALUES (
									?,
									?,
									?
								)";
					$stmt = $pdo->prepare($query);
					$stmt->execute([$user_id, $file_name_new, $file_root_path]);
					header("Location: ../index.php?upload=success");
					exit();
				}
				else{
					header("Location: ../upload.php?upload=error");
					exit();
				}
			}
			else{
				header("Location: ../upload.php?upload=large_file");
				exit();
			}
		}
		else {
			header("Location: ../upload.php?upload=error");
				exit();
		}
	}
	else {
		header("Location: ../upload.php?upload=file_type");
				exit();
	}
}