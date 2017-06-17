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

  $group_id = strip_tags($_POST['id']);

  $query = "SELECT status FROM group_member WHERE member_username = '$u' && group_id = '$group_id' && status = 'member' LIMIT 1";

  $result = mysqli_query($db_conx, $query);

  if (mysqli_num_rows($result) != 0)
  {
//results found
    echo "ada";

  } else {
// results not found


$qry = "DELETE FROM group_member  WHERE member_username = '$u' && group_id = '$group_id' LIMIT 1";

$result=mysqli_query($db_conx , $qry);


// Perform queries 
mysqli_query($db_conx,"INSERT INTO group_member ( group_id , group_name , member_username , status) 
  VALUES ( '$group_id' , '$group_name' , '$u' , 'request'   )");


    echo "not";

  }


}
?>