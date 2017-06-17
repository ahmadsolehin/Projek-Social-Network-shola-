<?php

   include_once("php_includes/db_conx.php");
    session_start();

    if(!isset($_SESSION['username']))
  {
  header("Location: index.php");
  }


      $username = $_SESSION['username'];


include('js/functions.php');
/*defined settings - start*/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);

$data = $_POST['name'];
$pos = $_POST['usertype'];

if ($pos == "Service Provider") {
	
	define('IMAGE_MEDIUM_DIR', './user_provider/'.$data.'/');
    define('IMAGE_MEDIUM_SIZE', 250);

}else if ($pos == "Service Seeker") {
	
	define('IMAGE_MEDIUM_DIR', './user_seeker/'.$data.'/');
    define('IMAGE_MEDIUM_SIZE', 250);

}else if ($pos == "Company") {
	
	define('IMAGE_MEDIUM_DIR', './user_company/'.$data.'/');
    define('IMAGE_MEDIUM_SIZE', 250);
}




/*defined settings - end*/

if(isset($_FILES['image_upload_file'])){
	$output['status']=FALSE;
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['image_upload_file']["error"] > 0) {
		$output['error']= "Error in File";
	}
	elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
		$output['error']= "You can only upload JPG, PNG and GIF file";
	}
	elseif (round($_FILES['image_upload_file']["size"] / 1024) > 4096) {
		$output['error']= "You can upload file size up to 4 MB";
	} else {
		/*create directory with 777 permission if not exist - start*/
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES['image_upload_file']['tmp_name'];
		$file = pathinfo($_FILES['image_upload_file']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		
		if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {
			
				$output['status']=TRUE;
				$output['image_medium']= $path[1];
			
		}
	}

		      $sqlite = "UPDATE users SET avatar ='$path[1]' WHERE username ='$username' LIMIT 1";
              $que = mysqli_query($db_conx, $sqlite);

	      $sql = "UPDATE useroptions SET profile ='$path[1]' WHERE username ='$username' LIMIT 1";
              $query = mysqli_query($db_conx, $sql);

	echo json_encode($output);
}
?>	