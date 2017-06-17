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



$group_id = mysqli_real_escape_string($db_conx, $_POST['id']); 
$desc = mysqli_real_escape_string($db_conx, $_POST['group_desc']); 
$interest = mysqli_real_escape_string($db_conx, $_POST['group_int']);


  mysqli_query($db_conx,"UPDATE special_group SET description = '$desc' , interest = '$interest' WHERE group_id = '$group_id' ") ;

mysqli_close($db_conx);
header("Location: ../special_group.php?id=$category_skill&ud=$group_id");

die();



?>