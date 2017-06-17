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



  $id = mysqli_real_escape_string($db_conx, $_POST['id_pro']); 
  $project_name = mysqli_real_escape_string($db_conx, $_POST['edit_project_name']); 
  $project_description  = mysqli_real_escape_string($db_conx, $_POST['edit_project_description']); 
  $project_start_date = mysqli_real_escape_string($db_conx, $_POST['edit_project_start_date']); 
  $project_end_date = mysqli_real_escape_string($db_conx, $_POST['edit_project_start_date']); 


  $sql = "UPDATE projects SET project_name='$project_name', project_desc='$project_description', project_sd='$project_start_date', project_ed ='$project_end_date' , created_date = now() WHERE id ='$id' LIMIT 1";
  $query = mysqli_query($db_conx, $sql);


mysqli_close($db_conx);


header("Location: ../user_cv_new.php");
die();
?>