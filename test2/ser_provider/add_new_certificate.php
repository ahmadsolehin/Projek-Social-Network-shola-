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



  $a = mysqli_real_escape_string($db_conx, $_POST['certificate_name']); 
  $b = mysqli_real_escape_string($db_conx, $_POST['issue_authority']); 
  $c = mysqli_real_escape_string($db_conx, $_POST['brief_description']); 
  $d = mysqli_real_escape_string($db_conx, $_POST['cert_start_date']); 
  $e = mysqli_real_escape_string($db_conx, $_POST['cert_end_date']); 



// Perform queries 
mysqli_query($db_conx,"INSERT INTO certification (username , certificate_Name , certificate_Authority , certificate_desc , certificate_start_date , certificate_end_date , created_date ) 
  VALUES ('$u' , '$a' , '$b' , '$c' , '$d' , '$e'  , 'now()'  )");

mysqli_close($db_conx);
header("Location: ../user_cv_new.php");
die();


?>