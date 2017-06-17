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



  $from_username = mysqli_real_escape_string($db_conx, $_POST['username']); 
  $from_avatar = mysqli_real_escape_string($db_conx, $_POST['avatar']); 
  $msg = mysqli_real_escape_string($db_conx, $_POST['message']); 
  $from_first = mysqli_real_escape_string($db_conx, $_POST['first_name']); 
  $group_id = mysqli_real_escape_string($db_conx, $_POST['group_id']); 



// Perform queries 
mysqli_query($db_conx,"INSERT INTO special_group_chat (group_id , from_username , from_avatar , from_name , message ) 
  VALUES ('$group_id' , '$from_username' , '$from_avatar' , '$from_first' , '$msg' )");

mysqli_close($db_conx);
die();


?>