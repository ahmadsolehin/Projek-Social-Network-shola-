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



  $a = mysqli_real_escape_string($db_conx, $_POST['university_name']); 
  $b = mysqli_real_escape_string($db_conx, $_POST['university_level']); 
  $c = mysqli_real_escape_string($db_conx, $_POST['area_study']); 
  $d = mysqli_real_escape_string($db_conx, $_POST['major_course']); 
  $e = mysqli_real_escape_string($db_conx, $_POST['edu_start_date']); 
  $f = mysqli_real_escape_string($db_conx, $_POST['edu_end_date']); 



// Perform queries 
mysqli_query($db_conx,"INSERT INTO education (username , university_name , university_level , university_study_field , university_major_course , university_start_date , university_end_date , created_date ) 
  VALUES ('$u' , '$a' , '$b' , '$c' , '$d' , '$e' , '$f' , 'now()'  )");

mysqli_close($db_conx);
header("Location: ../user_cv_new.php");
die();


?>