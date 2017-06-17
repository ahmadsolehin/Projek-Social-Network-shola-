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


if($_POST) 
{

  $group_id = strip_tags($_POST['id_kumpulan']);
  $cb = strip_tags($_POST['username']);

// Perform queries 
mysqli_query($db_conx,"INSERT INTO group_special_member ( group_id , group_name , member_username , status , created_by) 
  VALUES ( '$group_id' , '' , '$cb' , 'member' , ''  )");



  }


?>