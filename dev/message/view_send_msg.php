                            
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





$id_number = $_GET['id'];

  $msg_listing = "SELECT * FROM message WHERE id = '$id_number' ";
      $msg_array = mysqli_query($db_conx, $msg_listing);
      
while ($row = mysqli_fetch_array($msg_array, MYSQLI_ASSOC)) {
$id = $row["id"];
      $from = $row["from_user"];
      $to = $row["to_user"];
      $sbj = $row["subject"];
      $msg = $row["message"];
      $cd = $row["created_date"];
  }



?>

                    <div class="col-xs-12 mail_view_title">

                   
                   

                    </div>

                    <div class="col-xs-12 mail_view_info">

                        <div class="pull-left">
                            <span class=""><strong>To : <?php echo $to; ?></strong></span>
                        </div>

                        <div class='pull-right'>
                            <span class='msg_ts text-muted'><?php echo $cd; ?></span>
                        </div>

                    </div>



                    <div class="col-xs-12 mail_view">
                        <p>Hello <?php echo $from; ?>,</p>
                        <h4>Subject : <?php echo $sbj; ?></h4>
                        <p><?php echo $msg; ?></p>
                        <br>
               
                    
                    </div>


  


                  