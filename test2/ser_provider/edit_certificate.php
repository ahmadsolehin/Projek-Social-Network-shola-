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


  $id = mysqli_real_escape_string($db_conx, $_POST['id_cert']); 

  $a = mysqli_real_escape_string($db_conx, $_POST['edit_certificate_name']); 
  $b = mysqli_real_escape_string($db_conx, $_POST['edit_issue_authority']); 
  $c = mysqli_real_escape_string($db_conx, $_POST['edit_brief_description']); 
  $d = mysqli_real_escape_string($db_conx, $_POST['edit_cert_start_date']); 
  $e = mysqli_real_escape_string($db_conx, $_POST['edit_cert_end_date']); 


  $sql = "UPDATE certification SET certificate_Name ='$a', certificate_Authority ='$b', certificate_desc ='$c', certificate_start_date ='$d', certificate_end_date ='$e' , created_date = now() WHERE id ='$id' LIMIT 1";
  $query = mysqli_query($db_conx, $sql);


mysqli_close($db_conx);


header("Location: ../user_cv_new.php");
die();
?>