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



$group_id = mysqli_real_escape_string($db_conx, $_POST['group_id']); 
$group_name = mysqli_real_escape_string($db_conx, $_POST['group_name']); 
$category_skill = mysqli_real_escape_string($db_conx, $_POST['category_skill']); 
$privacy = mysqli_real_escape_string($db_conx, $_POST['privacy']); 
$created_by = mysqli_real_escape_string($db_conx, $_POST['created_by']); 

$sub_category = $_POST['sub_category'];


$qry = "DELETE FROM special_group WHERE group_id ='$group_id' ";

$result=mysqli_query($db_conx , $qry);



foreach ( $sub_category as $value) 
{
  //echo $value;
  mysqli_query($db_conx,"INSERT INTO special_group ( group_id , group_name , skill , other , privacy , created_by  ) 
    VALUES ( '$group_id' , '$group_name' , '$category_skill' , '$value' , '$privacy' , '$created_by'  )");


}



mysqli_close($db_conx);
header("Location: ../special_group.php?id=$category_skill&ud=$group_id");

die();



?>