  
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


       $user_avatar = "SELECT * FROM users WHERE username = '$to_user' ";
      $user_ava = mysqli_query($db_conx, $user_avatar);
      
      while ($row = mysqli_fetch_array($user_ava, MYSQLI_ASSOC)) {
      $to_avatar = $row["avatar"];
}



      $sql = "INSERT INTO message ( from_user , from_image , to_user, to_image , subject , message, status , created_date) VALUES ('$u', '$avatar' , '$to_user', '$to_avatar' , '$subject' , '$message' , 'unread' , now())";
              $query = mysqli_query($db_conx, $sql);
              header("location: private_message.php");
      

}
     

?>


    <form id="contact-form" method="post" action="message_page.php" role="form">

      <div class="messages"></div>


      <div class="controls">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label for="form_email">To *</label>

              <select class="form-control" id="" name="username">

<option>Choose user</option>
              <?php  
      while ($row = mysqli_fetch_array($user_array, MYSQLI_ASSOC)) {
      $nama_pertama = $row["first_name"];
      $nama_akhir = $row["last_name"];
      $id_pengguna = $row["id"];
      $username = $row["username"];
      ?>

                <option value="<?php echo $username;?>"><?php echo $nama_pertama; ?> <?php echo $nama_akhir; ?></option>

                                           <?php } ?>

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
