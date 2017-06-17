  
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
      $to_image = mysqli_real_escape_string($db_conx, $_POST['to_image']); 
      $message = mysqli_real_escape_string($db_conx, $_POST['message']);
      $msg_id = mysqli_real_escape_string($db_conx, $_POST['message_id']);



      $sql = "INSERT INTO conversation ( msg_id , msg , from_user , from_image , to_user , to_image , created_date) VALUES ('$msg_id' , '$message' , '$u', '$avatar' , '$to_user' , '$to_image' , now())";
              $query = mysqli_query($db_conx, $sql);
      




     

?>
