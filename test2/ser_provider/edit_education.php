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


  $id = mysqli_real_escape_string($db_conx, $_POST['id_edu']); 
  $a = mysqli_real_escape_string($db_conx, $_POST['edit_university_name']); 
  $b = mysqli_real_escape_string($db_conx, $_POST['edit_university_level']); 
  $c = mysqli_real_escape_string($db_conx, $_POST['edit_area_study']); 
  $d = mysqli_real_escape_string($db_conx, $_POST['edit_major_course']); 
  $e = mysqli_real_escape_string($db_conx, $_POST['edit_education_start_date']); 
  $f = mysqli_real_escape_string($db_conx, $_POST['edit_education_end_date']); 


  $sql = "UPDATE education SET university_name ='$a', university_level ='$b', university_study_field ='$c', university_major_course ='$d', university_start_date ='$e', university_end_date = '$f' , created_date = now() WHERE id ='$id' LIMIT 1";
  $query = mysqli_query($db_conx, $sql);


mysqli_close($db_conx);


header("Location: ../user_cv_new.php");
die();
?>