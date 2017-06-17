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



$qry = "DELETE FROM skills WHERE id ='$id' ";
  $query = mysqli_query($db_conx, $qry);


mysqli_close($db_conx);


header("Location: ../user_cv_new.php");
die();
?>