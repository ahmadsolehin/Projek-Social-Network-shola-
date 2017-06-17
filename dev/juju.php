<?php

include_once("php_includes/db_conx.php");
session_start();

if(!isset($_SESSION['username']))
{
  header("Location: index.php");
}


$username = $_SESSION['username'];
$usertype = $_SESSION['user_type'];
$fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];

$nameUserPath = $fn.$ln;

$data = $_POST['name'];
$pos = $_POST['position'];

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);


$jpg = 'jpg';
$uniqid = uniqid();
$random = rand();
$path = $uniqid. '' .$random. '.'.$jpg;  //ni utk letak path dlm db

if ($usertype == "Service Provider") {
	
	file_put_contents('user_provider/'.$nameUserPath.'/'.$path , $data);  //path simpan ,, name tu generate n letak ke db

}else if ($usertype == "Service Seeker") {

  file_put_contents('user_seeker/'.$nameUserPath.'/'.$path , $data);  //path simpan ,, name tu generate n letak ke db

}else if ($usertype == "Company") {

  file_put_contents('user_company/'.$nameUserPath.'/'.$path , $data);  //path simpan ,, name tu generate n letak ke db

}


//this is where we need to delete the old image in db


$sql = "UPDATE useroptions SET background ='$path', position='$pos'  WHERE username ='$username' LIMIT 1";
$query = mysqli_query($db_conx, $sql);


?>