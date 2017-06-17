<?php
   //Start your session
session_start();

include_once("php_includes/check_login_status.php");
   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$c = $_SESSION['comapny_name'];
$u = $_SESSION['username'];
$usertype = $_SESSION['user_type'];
$userid = $_SESSION['userid'];
$avatar = $_SESSION['avatar'];


?>

<!DOCTYPE html>
<html lang="en">


<!-- Include jQuery library -->

<?php include_once ("headerlogin.php"); ?>

<link rel="stylesheet" href="style.css">




<style media="screen">

#cursor{
  cursor: pointer;
}

body {
  padding-top: 74px;
}
    /*@media screen and (max-width: 768px) {
    body { padding-top: 0px; }
    }*/
    /* Newsfeed box css*/

    .feed_box {
      position: relative;
      width: auto;
      height: auto;
      padding: 0px;
      background: #FFFFFF;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      border: #7F7F7F solid 2px;
    }

    .feed_box:after {
      content: '';
      position: absolute;
      border-style: solid;
      border-width: 8px 30px 8px 0;
      border-color: transparent #FFFFFF;
      display: block;
      width: 0;
      z-index: 1;
      left: -27px;
      top: 12px;
    }

    .feed_box:before {
      content: '';
      position: absolute;
      border-style: solid;
      border-width: 8px 30px 8px 0;
      border-color: transparent #7F7F7F;
      display: block;
      width: 0;
      z-index: 0;
      left: -27px;
      top: 9px;
    }
    /*status update bar*/

    .message {
      border-radius: 0;
      border: none;
    }

    .panel {
      border-radius: 0;
      border: none;
      margin-bottom: 0;
    }

    .privacy-dropdown {
      width: 100px;
    }


    .modal {
      text-align: center;
      padding: 0!important;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }
    </style>




    <style media="screen">

    .list-group-horizontal .list-group-item {
      display: inline-block;
    }
    .list-group-horizontal .list-group-item {
      margin-bottom: 0;
      margin-left:-4px;
      margin-right: 0;
    }
    .list-group-horizontal .list-group-item:first-child {
      border-top-right-radius:0;
      border-bottom-left-radius:4px;
    }
    .list-group-horizontal .list-group-item:last-child {
      border-top-right-radius:4px;
      border-bottom-left-radius:0;
    }

    </style>





    <body id="page-top" class="index">

    </br>




  <div class="container">

    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
      <img  style="display: block; margin-left: auto; margin-right: auto " src="img/Eezy-logo.jpg" class="img-responsive" alt="">
    </div>
    </div>
    <!-- ukko form -->
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4">

    <form name="ukkoregister" action="php_includes/ezy.php" role="form" method="post" >
    <!-- Error Message goes here if the email/username exist -->
      <div class="form-group">


      <span> </span>



      </div>
        <div class="form-group">

            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="ukkoid" id="ukkoid" placeholder="Enter Eezy Number(ID)" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div> </br>

    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="ukkoref" id="ukkoref" placeholder="Enter Email" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>

        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-block "></br>

    </form>
    </div>
    </div>




    <!-- <% if(true){ %>
   <h1>foo</h1>
 <% } else{ %>
   <h1>bar</h1>
<% } %> -->
  </div>
  </br>


  <!-- Footer -->
  <div>
   <?php include_once("footer.php"); ?>
 </div>



 <script src="coverphoto/jquery.js"></script>
 <script src="coverphoto/jquery-ui.custom.min.js"></script>




 <!-- JS Files here -->
 <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
 <!-- Latest compiled and minified JavaScript -->

 <script src="js/cdn/datepicker.js"></script>


 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
 <script src="js/classie.js"></script>
 <script src="js/agency.js"></script>






</body>

</html>

















