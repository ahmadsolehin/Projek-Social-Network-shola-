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


$uid = uniqid(rand(10,100));

$group_name = mysqli_real_escape_string($db_conx, $_POST['group_name']); 
$service_category = mysqli_real_escape_string($db_conx, $_POST['service_category']); 
$privacy = mysqli_real_escape_string($db_conx, $_POST['privacy']); 

$sub_category = $_POST['sub_category'];

foreach ( $sub_category as $value) 
{
  //echo $value;
  mysqli_query($db_conx,"INSERT INTO special_group ( group_id , group_name , skill , other , privacy , created_by ) 
    VALUES ( '$uid' , '$group_name' , '$service_category' , '$value' , '$privacy' ,  '$u' )");
}


  mysqli_query($db_conx,"INSERT INTO group_special_member ( group_id  , group_name , member_username , status , created_by ) 
  VALUES ( '$uid' , '$group_name' , '$u' , 'member' , '$u' )");


mysqli_close($db_conx);
header("Location: ../group_page.php");
die();



?>