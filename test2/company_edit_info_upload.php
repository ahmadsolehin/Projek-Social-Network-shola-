<?php

include_once("php_includes/db_conx.php");
session_start();
if(!isset($_SESSION['username']))
{
	header("Location: index.php");
}

$fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$u = $_SESSION['username'];

$data = $fn.$ln;

if(isset($_FILES['files'])){

	$a = mysqli_real_escape_string($db_conx, $_POST['about']); 
	$l = mysqli_real_escape_string($db_conx, $_POST['location']);
  $web = mysqli_real_escape_string($db_conx, $_POST['website']);



$string = str_replace(' ', '', $web);

if(substr($string, 0, 4) == "http") {
    $w = $string;
}else if(substr($string, 0, 5) == "https") {
    $w = $string;
}else{
  $w = 'https://'.$string;
}

	$name_array = $_FILES['files']['name'];

	$ui = uniqid();

	$tmp_name_array = $_FILES['files']['tmp_name'];
	$type_array = $_FILES['files']['type'];
	$size_array = $_FILES['files']['size'];
	$error_array = $_FILES['files']['error'];

	$location = "./user_company/".$data."/";

	for($i = 0; $i < count($tmp_name_array); $i++){

		$x = uniqid().$name_array[$i].".jpg";

		$loc = $location.$x;


		move_uploaded_file($tmp_name_array[$i], $loc);

		$oppo = "INSERT INTO company(about , website, location , product_pic , username , timedate) VALUES ( '$a', '$w', '$l' , '$loc' , '$u' , now() ) ";
		$query = mysqli_query($db_conx, $oppo);





      $xray= "UPDATE company SET about ='$a', location ='$l' , website = '$w' WHERE username = '$u' ";
              $p = mysqli_query($db_conx, $xray);

	}


}

?>