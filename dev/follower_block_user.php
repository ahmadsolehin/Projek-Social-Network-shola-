                            
<?php


   include_once("php_includes/check_login_status.php");
   
  if(!isset($_SESSION['username']))
  {
  header("Location: index.php");
  }

  
   //Read your session (if it is set)
   if (isset($_SESSION['fname']))
      $fn =  $_SESSION['fname'];
      $ln = $_SESSION['lname'];
      $u = $_SESSION['username'];
      $userid = $_SESSION['userid'];
      $avatar = $_SESSION['avatar'];





$id_number = $_GET['id'];



      $nosql = "UPDATE friends SET status = 'block' WHERE id ='$id_number' LIMIT 1";


$result=mysqli_query($db_conx , $nosql);
if(isset($result)) {

       ?>

    <script language='Javascript'>
      location.href='friends_page_com.php';

    </script>

    <?php

} else {
          ?>

    <script language='Javascript'>
      alert('Something went wrong');
      location.href='friends_page_com.php';

    </script>

    <?php
}





?>

