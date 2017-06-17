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

    <!-- Signup form -->
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4">
   <p><h4>Account Validation</h4></p>
    <p> For quick validation of your accounnt, it is advisable to provide the below information. </p> <br>
    <!-- Multiple Radios -->
           

    </div>
    </div>
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4">
    <p><h4> Do you have an account from ?</h4></p>

    <form name="signup_individual_part_2" action="/bank_detail" id="signup_form_individual_part_2" role="form" method="post" >
    <!-- Error Message goes here if the email/username exist -->
   


      <div class="form-group">

        <div class="col-md-6">
        <div class="radio">
          <label for="eezy">
            <input type="radio" name="radios" id="eezy" value="1" >
            <a href="#" class="btn btn-block btn-primary" style="border:0px;background-color:white">
              <img  src="img/eezy-logo.jpg" class="img-responsive" alt="">
            </a>

          </label>
        </div>
        <div class="radio">
          <label for="ukko">
            <input type="radio" name="radios" id="ukko" value="2" >
            <a href="#" class="btn btn-block btn-primary" style="border:0px;background-color:white">
              <img  src="img/ukko-logo.png" class="img-responsive" alt="">
            </a>

          </label>
        </div>
        <div class="radio">
          <label for="No">
            <input type="radio" name="radios" id="No" value="2" checked="checked">

              <p>No


          </label>
        </div>
        </div>
      </div>


    </form>

    </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4">
      </div>


      <div class="col-md-4 col-sm-4 col-xs-4">
      <div class="form-group">
        <a id ="directpages" href="" >
        <button type="button" id="submitbut"  class="btn btn-primary btn-block" aria-label="Left Button">Submit</button>
      </a>
      </div>

    </div>

    </div>




    <!-- <% if(true){ %>
   <h1>foo</h1>
 <% } else{ %>
   <h1>bar</h1>
<% } %> -->
  </div>







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





 
  <script>
  $(document).ready(function(){
    $('#submitbut').click(function() {
      if(document.getElementById("eezy").checked) {
        $('#directpages').attr('href',"eezy2.php");
        // document.getElementById("signup_form_individual_part_2").submit();
      }else if(document.getElementById('ukko').checked) {
        $('#directpages').attr('href',"ukkodetails2.php");
        // document.getElementById("signup_form_individual_part_2").submit();
      }else{
        $('#directpages').attr('href',"bankdetails2.php");
        // document.getElementById("signup_form_individual_part_2").submit();
      }
    });
  });

  </script>


</body>

</html>

















