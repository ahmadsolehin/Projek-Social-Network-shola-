<?php

   include_once("php_includes/check_login_status.php");

      $fn =  $_SESSION['fname'];
      $ln = $_SESSION['lname'];
      $u = $_SESSION['username'];
      $userid = $_SESSION['userid'];
      $usertype = $_SESSION['user_type'];

$position="";
$background="";

            $wechat="SELECT position , background FROM useroptions WHERE id='$userid' LIMIT 1";
      $kuali = mysqli_query($db_conx, $wechat);
      while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
  $position = $row["position"];
  $background = $row["background"];
  }

?>

  <link rel="stylesheet" href="coverphoto/coverphoto.css">

  <style type="text/css">
    .coverphoto, .output {
      width: 1024px;
      height: 200px;
      border: 1px solid black;
      margin: 10px auto;
    }
  </style>