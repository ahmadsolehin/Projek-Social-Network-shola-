<?php
   //Start your session
session_start();

include_once("php_includes/check_login_status.php");
   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$c = $_SESSION['comapny_name'];
$u = $_SESSION['username'];
$usertype = $_SESSION['user_type'];
$userid = $_SESSION['userid'];
$avatar = $_SESSION['avatar'];



$music_number = $_POST['del_id'];

$qry = "DELETE FROM company WHERE product_pic ='$music_number'";

$result=mysqli_query($db_conx , $qry);
if(isset($result)) {
   echo "YES";
} else {
   echo "NO";
}

?>