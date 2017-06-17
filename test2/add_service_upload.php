<?php
   
   include_once("php_includes/db_conx.php");
   	session_start();
	if(!isset($_SESSION['username']))
	{
	header("Location: index.php");
	}

	include('js/functions.php');


  	//Read your session (if it is set)
   	//if (isset($_SESSION['fname']))
      $fn =  $_SESSION['fname'];
      $ln = $_SESSION['lname'];
      $u = $_SESSION['username'];
      $usertype = $_SESSION['user_type'];

      $data = $fn.$ln;


      /*defined settings - start*/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);

if ($usertype == "Service Provider") {
	
	define('IMAGE_MEDIUM_DIR', './user_provider/'.$data.'/');
    define('IMAGE_MEDIUM_SIZE', 250);

}else if ($usertype == "Service Seeker") {
	
	define('IMAGE_MEDIUM_DIR', './user_seeker/'.$data.'/');
    define('IMAGE_MEDIUM_SIZE', 250);

}else if ($usertype == "Company") {
	
	define('IMAGE_MEDIUM_DIR', './user_company/'.$data.'/');
    define('IMAGE_MEDIUM_SIZE', 250);
}




if(isset($_FILES['service_img'])){

      $sn = mysqli_real_escape_string($db_conx, $_POST['service_name']); 
      $sc = mysqli_real_escape_string($db_conx, $_POST['service_category']);
      $p = mysqli_real_escape_string($db_conx, $_POST['price']);
      $sd = mysqli_real_escape_string($db_conx, $_POST['service_description']);


	$output['status']=FALSE;
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['service_img']["error"] > 0) {
		$output['error']= "Error in File";
	}
	elseif (!in_array($_FILES['service_img']["type"], $allowedImageType)) {
		$output['error']= "You can only upload JPG, PNG and GIF file";
	}
	elseif (round($_FILES['service_img']["size"] / 1024) > 4096) {
		$output['error']= "You can upload file size up to 4 MB";
	} else {
		/*create directory with 777 permission if not exist - start*/
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES['service_img']['tmp_name'];
		$file = pathinfo($_FILES['service_img']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		
		if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {
			
				$output['status']=TRUE;
				$output['image_medium']= $path[1];
			
		}
	}

      $sql = "INSERT INTO service(Username, Service_name, Service_category, Price, Service_description, Service_pic ,Created_date) VALUES ('$u','$sn','$sc','$p','$sd', '$path[1]' , now())";
            	$query = mysqli_query($db_conx, $sql);

            	            	header("location: userprofile.php");


}
      
?>