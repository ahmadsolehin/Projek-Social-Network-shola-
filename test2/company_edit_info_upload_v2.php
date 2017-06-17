<?php

include_once("php_includes/db_conx.php");
session_start();
if(!isset($_SESSION['username']))
{
  header("Location: index.php");
}

$fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$u = $_SESSION['username'];


$a = mysqli_real_escape_string($db_conx, $_POST['about']); 
$l = mysqli_real_escape_string($db_conx, $_POST['location']);
$w = mysqli_real_escape_string($db_conx, $_POST['website']);

$string = str_replace(' ', '', $w);

if(substr($string, 0, 4) == "http") {
    $web = $string;
}else if(substr($string, 0, 5) == "https") {
    $web = $string;
}else{
  $web = 'https://'.$string;
}







$query = "SELECT * FROM company WHERE username= '$u' LIMIT 1";

$result = mysqli_query($db_conx, $query);

if (mysqli_num_rows($result) != 0)
{
  $nosql = "UPDATE company SET about ='$a', location ='$l' , website = '$web' WHERE username = '$u' ";
  $quey = mysqli_query($db_conx, $nosql);

} else {
// results not found
  $oppo = "INSERT INTO company(about , website, location , product_pic , username , timedate) VALUES ( '$a', '$web', '$l' , '' , '$u' , now() ) ";
  $query = mysqli_query($db_conx, $oppo);
}





?>