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
$privacy = mysqli_real_escape_string($db_conx, $_POST['privacy']); 
  $cb = strip_tags($_POST['created_by']);


$shopId = $_POST['group_member'];

foreach ( $shopId as $value) 
{
  //echo $value;
  mysqli_query($db_conx,"INSERT INTO group_member ( group_id , group_name , member_username , status , created_by ) 
  VALUES ( '$uid' , '$group_name' , '$value' , 'member' ,  '$cb' )");
}

  mysqli_query($db_conx,"INSERT INTO group_member ( group_id  , group_name , member_username , status , created_by ) 
  VALUES ( '$uid' , '$group_name' , '$u' , 'member' , '$cb' )");


// Perform queries 
mysqli_query($db_conx,"INSERT INTO new_group ( id , group_name , group_type , privacy , created_by ) 
  VALUES ( '$uid' , '$group_name' , 'new' , '$privacy' , '$u'  )");

mysqli_close($db_conx);
header("Location: ../group_page.php");
die();



?>