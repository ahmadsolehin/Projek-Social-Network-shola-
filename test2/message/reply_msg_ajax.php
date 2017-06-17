  
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
      $msg_id = mysqli_real_escape_string($db_conx, $_POST['message_id']);



      $sql = "INSERT INTO conversation ( msg_id , msg , from_user , to_user , avatar , created_date) VALUES ('$msg_id' , '$message' , '$u','$to_user' , '$avatar' , now())";
              $query = mysqli_query($db_conx, $sql);
      






$nosql = "UPDATE message SET status = 'unread' WHERE id ='$msg_id' LIMIT 1";
$quey = mysqli_query($db_conx, $nosql);



     

?>
