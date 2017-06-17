  
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



  $user_listing = "SELECT * FROM users WHERE username != '$u' ";
      $user_array = mysqli_query($db_conx, $user_listing);
      
      



 if(isset($_POST["message"])){

      $to_user = mysqli_real_escape_string($db_conx, $_POST['username']); 
      $message = mysqli_real_escape_string($db_conx, $_POST['message']);
      $subject = mysqli_real_escape_string($db_conx, $_POST['subject']);



      $sql = "INSERT INTO message ( from_user , to_user , subject , message, status , created_date) VALUES ('$u' , '$to_user','$subject' , '$message' , 'unread' , now())";
              $query = mysqli_query($db_conx, $sql);
              header("location: private_message.php");
      

}

$name_user = $_GET['id'];

$wechat="SELECT * FROM users WHERE username='$name_user' LIMIT 1";
$kuali = mysqli_query($db_conx, $wechat);
while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
  $first = $row["first_name"];
  $last = $row["last_name"];
}




     

?>


    <form id="contact-form" method="post" action="reply_msg.php" role="form">

      <div class="messages"></div>


      <div class="controls">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label for="form_email">To *</label>

              <select class="form-control" id="" name="username">

<option value="<?php echo $name_user; ?>" ><?php echo $first; ?> <?php echo $last; ?></option>
         

              </select>
              <div class="help-block with-errors"></div>
            </div>
          </div>

              <div class="col-md-6">
            <div class="form-group">
            <label for="form_email">Subject *</label>

            <input class = "form-control" type="text" name="subject" required>
              <div class="help-block with-errors"></div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="form_message">Message *</label>
              <textarea id="form_message" name="message" class="form-control" placeholder="Message for you *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-12">
            <input type="submit" class="btn btn-primary btn-send" value="Send message">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          </div>
        </div>
      </div>

    </form>
