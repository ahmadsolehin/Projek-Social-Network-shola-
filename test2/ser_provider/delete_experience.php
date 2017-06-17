    
<?php


   include_once("../php_includes/check_login_status.php");
   
  if(!isset($_SESSION['username']))
  {
  header("Location: ../index.php");
  }

  
   //Read your session (if it is set)
   if (isset($_SESSION['fname']))
      $fn =  $_SESSION['fname'];
      $ln = $_SESSION['lname'];
      $u = $_SESSION['username'];
      $userid = $_SESSION['userid'];
      $avatar = $_SESSION['avatar'];




$id_number = $_POST['id'];

$qry = "DELETE FROM employment WHERE id ='$id_number' ";

$result=mysqli_query($db_conx , $qry);
if(isset($result)) {

       ?>

    <script language='Javascript'>
      location.href='../user_cv_new.php';

    </script>

    <?php

} else {
          ?>

    <script language='Javascript'>
      alert('Something went wrong');
      location.href='../user_cv_new.php';

    </script>

    <?php
}





?>

