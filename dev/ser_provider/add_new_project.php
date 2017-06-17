<?php

include_once("../php_includes/check_login_status.php");
     //Start your session
if(!isset($_SESSION['username']))
{
  header("Location: ../index.php");
}


   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$userid = $_SESSION['userid'];
$usertype = $_SESSION['user_type'];
$u = $_SESSION['username'];



  $project_name = mysqli_real_escape_string($db_conx, $_POST['project_name']); 
  $project_description = mysqli_real_escape_string($db_conx, $_POST['project_description']); 
  $project_start_date = mysqli_real_escape_string($db_conx, $_POST['project_start_date']); 
  $project_end_date = mysqli_real_escape_string($db_conx, $_POST['project_end_date']); 



// Perform queries 
mysqli_query($db_conx,"INSERT INTO projects (username , project_name , project_desc , project_sd , project_ed , created_date ) 
  VALUES ('$u' , '$project_name' , '$project_description' , '$project_start_date' , '$project_end_date' , 'now()'  )");

mysqli_close($db_conx);
header("Location: ../user_cv_new.php");
die();


?>