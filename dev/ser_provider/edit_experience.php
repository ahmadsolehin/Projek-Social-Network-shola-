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



  $id = mysqli_real_escape_string($db_conx, $_POST['id']); 
  $c = mysqli_real_escape_string($db_conx, $_POST['edit_company_name']); 
  $p = mysqli_real_escape_string($db_conx, $_POST['edit_company_position']); 
  $j = mysqli_real_escape_string($db_conx, $_POST['edit_work_details']); 
  $ws = mysqli_real_escape_string($db_conx, $_POST['edit_work_start_date']); 
  $we = mysqli_real_escape_string($db_conx, $_POST['edit_work_end_date']); 




  $sql = "UPDATE employment SET compnay_name='$c', company_position='$p', work_details='$j', work_start_date='$ws', work_end_date='$we', created_date = now() WHERE id ='$id' LIMIT 1";
  $query = mysqli_query($db_conx, $sql);


mysqli_close($db_conx);


header("Location: ../user_cv_new.php");
die();
?>