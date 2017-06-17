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


    <style>
    .panel-heading .accordion-toggle:after {
      /* symbol for "opening" panels */
      font-family: 'Glyphicons Halflings';
      /* essential for enabling glyphicon */
      content: "\e114";
      /* adjust as needed, taken from bootstrap.css */
      float: right;
      /* adjust as needed */
      color: grey;
      /* adjust as needed */
    }

    .panel-heading .accordion-toggle.collapsed:after {
      /* symbol for "collapsed" panels */
      content: "\e080";
      /* adjust as needed, taken from bootstrap.css */
    }
    </style>

    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-1">
      </div>
      <div class="col-md-8 col-sm-8 col-xs-10">

        <!--<div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:30%">30% Complete

          </div>
        </div>-->
      </div>

    </div>
    <!--form container  -->
    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-1">
      </div>
      <div class="col-md-8 col-sm-8 col-xs-10">
        <p>Please fill following fields</p>
        <!-- form collapse goes here -->
        <form name="bankform" action="php_includes/bankdetails.php" role="form" method="post">

          <div class="panel-group" id="accordion">
            <!-- This Panel is for Bank Details -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#bank_detail">
                    Bank Detail
                  </a>
                </h4>
              </div>
              <div id="bank_detail" class="panel-collapse collapse in">
                <div class="panel-body">

                  <div class="form-group">

                    <div class="input-group">
                      <div class="input-group-addon"><span class="fa fa-university"></span></div>
                      <input type="text" class="form-control" id="bankid" name="bank_id"  placeholder="Enter Bank ID" required>
                      <div class="input-group-addon">
                        <a id="popover" class="fa fa-info-circle fa-xs  btn-popover " rel="popover" data-content=" " title="Providing this means:"></a>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">

                    <div class="input-group">
                      <div class="input-group-addon"><span class="fa fa-credit-card-alt"></span></div>
                      <input type="text" class="form-control" id="taxcard" name="taxcard" placeholder="Enter Taxcard number" required>
                      <div class="input-group-addon">
                        <a id="popover" class="fa fa-info-circle fa-xs  btn-popover " rel="popover" data-content=" " title="Providing this means:"></a>
                      </div>
                      <!--
                      <div class="input-group-addon"><p><a id="popover" class="btn btn-popover" rel="popover" data-content=" " title="Providing this means:">
                      <span class="fa fa-info-circle"></span></a></p></div> -->

                    </div>

                  </div>
                  <div class="form-group">

                    <div class="input-group">
                      <div class="input-group-addon"><span class="fa fa-user"></span></div>
                      <input type="text" class="form-control" id="ssc_number" name="ssn_number"  placeholder="Enter Social security number" required>
                      <div class="input-group-addon">
                        <a id="popover" class="fa fa-info-circle fa-xs  btn-popover " rel="popover" data-content="That requires because of" title="Choosing This Means:"></a>
                      </div>
                    </div>

                  </div>



                </div>
              </div>
            </div>


                      </br>

                      <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-block ">
                    </br>

                  </div>
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

















