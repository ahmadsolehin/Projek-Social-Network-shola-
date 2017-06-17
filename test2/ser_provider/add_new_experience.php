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



  $company_name = mysqli_real_escape_string($db_conx, $_POST['company_name']); 
  $company_position = mysqli_real_escape_string($db_conx, $_POST['company_position']); 
  $work_details = mysqli_real_escape_string($db_conx, $_POST['work_details']); 
  $work_start_date = mysqli_real_escape_string($db_conx, $_POST['work_start_date']); 
  $work_end_date = mysqli_real_escape_string($db_conx, $_POST['work_end_date']); 



// Perform queries 
mysqli_query($db_conx,"INSERT INTO employment (username , compnay_name , company_position , work_details , work_start_date , work_end_date , created_date ) 
  VALUES ('$u' , '$company_name' , '$company_position' , '$work_details' , '$work_start_date' , '$work_end_date' , 'now()'  )");

mysqli_close($db_conx);
header("Location: ../user_cv_new.php");
die();


?>