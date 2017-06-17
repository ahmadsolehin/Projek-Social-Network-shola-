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




      $to_user = mysqli_real_escape_string($db_conx, $_POST['username']); 
      $message = mysqli_real_escape_string($db_conx, $_POST['message']);
      $subject = mysqli_real_escape_string($db_conx, $_POST['subject']);

      $sql = "INSERT INTO message ( from_user , to_user , subject , message, status , created_date) VALUES ('' , '','' , '' , 'unread' , now())";
              $query = mysqli_query($db_conx, $sql);
              header("location: ../private_message.php");
      





?>
