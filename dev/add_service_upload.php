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

$location = "./user_provider/".$data."/";

    $x = uniqid(rand(10,100));


  $sn = mysqli_real_escape_string($db_conx, $_POST['service_name']); 
  $sc = mysqli_real_escape_string($db_conx, $_POST['service_category']);
  $p = mysqli_real_escape_string($db_conx, $_POST['price']);
  $sd = mysqli_real_escape_string($db_conx, $_POST['service_description']);
  $sfd = mysqli_real_escape_string($db_conx, $_POST['service_full_description']);
  $ayam = $_POST['sub_category'];

  $pic = rand(1000,100000)."-".$_FILES['service_img']['name'];
  $pic_loc = $_FILES['service_img']['tmp_name'];
  $folder="user_provider/".$data."/";
  if(move_uploaded_file($pic_loc,$folder.$pic))
  {
    foreach ( $ayam as $value) 
    {
      $fresh = "INSERT INTO service( Username, Service_name, Service_category, Price, Service_description, Service_pic ,Created_date , sub_category , service_full_description , id) VALUES ('$u','$sn','$sc','$p','$sd', '$folder$pic' , now() , '$value' , '$sfd' , '$x' )";
      $query = mysqli_query($db_conx, $fresh);
    }
    header("location: userprofile.php");
  }


?>