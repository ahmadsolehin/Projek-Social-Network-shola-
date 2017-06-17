<?php

include_once("php_includes/check_login_status.php");
     //Start your session
if(!isset($_SESSION['username']))
{
  header("Location: index.php");
}


   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
       $usertype = $_SESSION['user_type'];



$username = $_GET['u'];



$services="SELECT Service_name, Service_category, Price, Service_description, Service_pic FROM service WHERE Service_name='$username' ";
$service = mysqli_query($db_conx, $services);




?>


<!DOCTYPE html>
<html lang="en">

<?php include_once ("headerlogin.php"); ?>

  <link rel="stylesheet" href="style.css">



  <style media="screen">
    
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

    .facebook-share-box {
      width: 100%;
    }

    .facebook-share-box .share {
      -webkit-transition: 0.1s ease-out height;
      -moz-transition: 0.1s ease-out height;
      -ms-transition: 0.1s ease-out height;
      -o-transition: 0.1s ease-out height;
      transition: 0.1s ease-out height;
      clear: both;
      background: white;
      border: 2px solid #dddddd;
      margin-bottom: 10px;
      position: relative;
    }

    .facebook-share-box .share .arrow {
      background: url(arrow.png) no-repeat #dddddd;
      position: absolute;
      width: 14px;
      height: 10px;
      left: 4px;
      display: inline;
      top: -10px;
      -webkit-transition: 0.3s ease-out all;
      -moz-transition: 0.3s ease-out all;
      -ms-transition: 0.3s ease-out all;
      -o-transition: 0.3s ease-out all;
      transition: 0.3s ease-out all;
    }

    .facebook-share-box .post-types li a {
      color: #085083;
      text-decoration: none;
    }

    .facebook-share-box .post-types li a.active {
      color: #404040;
    }

    .facebook-share-box .post-types {
      padding-left: 5px;
    }

    .facebook-share-box ul {
      list-style: none;
      margin-bottom: 9px;
    }

    .facebook-share-box .post-types li {
      display: inline;
      margin-right: 10px;
    }

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
  </style>



</head>



<body id="page-top" class="index">

  <!--navigation bar-->


</br>

<div class="container">

  <div class="row">


  </div></br>

  

  <!--  service container-->
  <!-- Info about  user  -->
  <div class="col-md-3 col-sm-3 col-xs-3">

    <div class="row">


    </div>

    </br>


  </div>

  <div class="col-md-6 col-sm-6 col-xs-6">
    <div class "row">
    </div>

    <div class="row">


      <?php  
      while ($row = mysqli_fetch_array($service, MYSQLI_ASSOC)) {
        $sn= $row["Service_name"];
        $sc= $row["Service_category"];
        $p= $row["Price"];
        $sd= $row["Service_description"];
        $Service_pic = $row["Service_pic"];


        ?>

        <div class="col-md-6 col-sm-6 col-xs-6">

          <div class="panel panel-default">          
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <img src="img/user_rating.png" class="img-responsive" alt="">
                </div>

                <div class = "row">
                  <div class="col-md-6 col-sm-8 col-xs-8 ">
                    <p><?php echo $sn; ?></p>
                  </div>
                </div>

              </div>

            </div>
            <div class="panel-body">
              <a href=" ">
                <img src="<?php echo $Service_pic; ?>" class="img-responsive" alt="">
              </a>
            </div>

            <div class="panel-footer">
              <a style="color:black" href=" ">
                <div class="row">
                  <div class="col-md-8 col-sm-8 col-xs-8">
                    <p> <?php echo $sc; ?></p>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <p><?php echo $p; ?><i class="glyphicon glyphicon-eur"></i></p>
                  </div>
                </div>
              </a>

            </div>
          </div>
        </div>
        <?php    } ?>



      </div>



    </div>



</div>

</div></br>

<input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">



<!-- Footer -->
<!-- Footer -->
<div>
 <?php include_once("footer.php"); ?>
</div>
<!-- JS Files here -->

<script src="coverphoto/jquery.js"></script>
<script src="coverphoto/jquery-ui.custom.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/agency.js"></script>


<script src="coverphoto/coverphoto.js"></script>

<script src="js/jquery.form.js"></script> 

  </body>

  </html>
