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
       $usertype = $_SESSION['user_type'];


$test = "unread";

       $reader = "SELECT * FROM message WHERE to_user = '$u' AND status = '$test' ORDER BY id";

      $msg_read = mysqli_query($db_conx, $reader);

      $num_of_row = mysqli_num_rows($msg_read);





       $bud = "SELECT * FROM friends WHERE user2 = '$userid' AND status = 'pending' ORDER BY id";

      $real_bud = mysqli_query($db_conx, $bud);

      $num_of_friend = mysqli_num_rows($real_bud);
      




?>


<!DOCTYPE html>
<html lang="en">

<head>



  <!-- Include jQuery library -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <title>Grezzli</title>


  <script type="text/javascript" src="js/cdn/ajax_jquery.3.1.1.min.js"></script>
  <script type="text/javascript">


  $(document).ready(function() {

    $('#mencari').keyup(function() {


      var inputSearch = $(this).val();
      var dataString = 'searchword='+ inputSearch;

      if(inputSearch!='')
      {
        $.ajax({
          type: "POST",
          url: "../search.php",
          data: dataString,
          cache: false,
          success: function(html)
          {
            $("#divResult").html(html).show();
          }
        });
      }

      if(inputSearch == ''){
        $("#divResult").empty();

      } 


    });
  });


  </script>


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- Custom CSS files here -->

  <link rel="stylesheet" href="../style.css">

  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/header.css">
  <link href="../css/agency.css" rel="stylesheet">

  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <!-- Custom Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>



  <style media="screen">

  

  #divResult
  {
    position:fixed;
    width:275px;
    display:none;
    margin-top:-1px;
    border-top:0px;
    overflow:hidden;
    border-bottom-right-radius: 6px;
    border-bottom-left-radius: 6px;
    -moz-border-bottom-right-radius: 6px;
    -moz-border-bottom-left-radius: 6px;
    box-shadow: 0px 0px 5px #999;
    border-width: 3px 1px 1px;
    background-color: white;
  }
  .display_box
  {
    border-top:solid 1px #dedede; 
    font-size:12px; 
    height:50px;
  }
  .display_box:hover
  {
    background:#fed136;
    color:#FFFFFF;
    cursor:pointer;
  }

  #navbar-main {
    min-width: 250px;
    padding: 14px 14px 0;
    overflow: hidden;
    background-image: -ms-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: -moz-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: -o-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: -webkit-gradient(radial, center center, 0, center center, 125, color-stop(0, #BDBDBD), color-stop(200, #141413));
    background-image: -webkit-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: radial-gradient(ellipse closest-side at center, #BDBDBD 0, #141413 200%);
    opacity: .9
  }
  /* rating stars style*/

  .rating {
    float: left;
  }

  .rating span {
    font-size: 20px;
    cursor: pointer;
    float: right;
    color: black;
  }

  .rating span:hover,
  .rating span:hover ~ span {
    color: red;
  }

  body {
    padding-top: 74px;
  }
    /*@media screen and (max-width: 768px) {
    body { padding-top: 0px; }
    }*/
    /* Newsfeed box css*/

    #pointer{
      cursor: pointer;
    }


    </style>


  </head>



  <body id="page-top" class="index">




  <!--navigation bar-->

 <nav class="navbar navbar-default  navbar-fixed-top" role="navigation" id="navbar-main">
    <div class="container">
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navCollapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="fa fa-chevron-down"></span> Menu
        </button>

        <?

          if ($usertype == "Service Seeker") {
      ?>

        <a href="service_seeker_profile.php">
          <img width="180" height="60" class="img-responsive" src="../img/logo.png" alt="">
        </a>

          <?php
    }else if ($usertype == "Service Provider") {
      ?>

       <a href="../userprofile.php">
          <img width="180" height="60" class="img-responsive" src="../img/logo.png" alt="">
        </a>


            <?php
    }else if ($usertype == "Company") {
      ?>

      <a href="../companyprofile.php">
          <img width="180" height="60" class="img-responsive" src="../img/logo.png" alt="">
        </a>

         <?php

        }
        ?>


      </div>
      <div class="collapse navbar-collapse" id="navCollapse">
        <div class="col-sm-4 col-md-4 col-sm-4 col-md-offset-2">
         <form class="navbar-form" role="search" autocomplete = "off">
            <div class="input-group">
              <input type="text" class="form-control" id = "mencari" placeholder="Search" name="q">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
            </div>
          </form>

          <div id="divResult">
          </div>

        </div>
        <ul id="menulist" class="nav navbar-nav navbar-right">


        <?

          if ($usertype == "Service Seeker") {
      ?>


   <li class=""><a href="../service_seeker_newsfeed.php"><i class="glyphicon glyphicon-home"></i></a></li>
     <li class=""><a href="../group_page.php"><i class="fa fa-users" aria-hidden="true"></i></a></li>



         <?php 

             if( $num_of_row == 0){

              ?>

            <li class=""><a href="../message/private_message.php"><i class="glyphicon glyphicon-envelope"></i></a>
            </li>

            <?php }else{

              ?>

            <li class=""><a href="../message/private_message.php"><i class="glyphicon glyphicon-envelope"></i><span class="badge"><?php echo $num_of_row; ?></span></a>
            </li>

            <?php

          }

          ?>

          <?php

          if ( $num_of_friend == 0) {
            
            ?>

                        <li class=""><a href="../friends_page.php"><i class="glyphicon glyphicon-user"></i></a></li>


            <?php
          }else{

            ?>

                        <li class=""><a href="../friends_page.php"><i class="glyphicon glyphicon-user"></i><span class="badge"><?php echo $num_of_friend; ?></a></li>


            <?php
          }

          ?>


            <li class=""><a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i></a></li> 
            <li class=""><a href="../service_seeker_profile.php"><i class="glyphicon glyphicon-user"></i> <?php echo $fn ; ?></a></li>

            <?php
    }else if ($usertype == "Service Provider") {
      ?>

             <li class=""><a href="../newsfeed_version1.php"><i class="glyphicon glyphicon-home"></i></a></li>
     <li class=""><a href="../group_page.php"><i class="fa fa-users" aria-hidden="true"></i></a></li>

                      <?php 

             if( $num_of_row == 0){

              ?>

          <li class=""><a href="../message/private_message.php"><i class="glyphicon glyphicon-envelope"></i></a></li>

                      <?php }else{

              ?>

            <li class=""><a href="../message/private_message.php"><i class="glyphicon glyphicon-envelope"></i><span class="badge"><?php echo $num_of_row; ?></span></a>
            </li>

            <?php

          }

          ?>

                    <?php

          if ( $num_of_friend == 0) {
            
            ?>

                        <li class=""><a href="../friends_page.php"><i class="glyphicon glyphicon-user"></i></a></li>


            <?php
          }else{

            ?>

                        <li class=""><a href="../friends_page.php"><i class="glyphicon glyphicon-user"></i><span class="badge"><?php echo $num_of_friend; ?></a></li>


            <?php
          }

          ?>


          <li class=""><a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i></a></li>  
          <li class=""><a href="../userprofile.php?"><i class="glyphicon glyphicon-user"></i><B><?php echo $fn; ?></B></a></li> 
       

      <?php
    }else if ($usertype == "Company") {
      ?>

      <li class=""><a href="../company_newsfeed.php"><i class="glyphicon glyphicon-home"></i></a></li>
           <li class=""><a href="../group_page.php"><i class="fa fa-users" aria-hidden="true"></i></a></li>


<?php 

             if( $num_of_row == 0){

              ?>

          <li class=""><a href="../message/private_message.php"><i class="glyphicon glyphicon-envelope"></i></a></li>

                      <?php }else{

              ?>

            <li class=""><a href="../message/private_message.php"><i class="glyphicon glyphicon-envelope"></i><span class="badge"><?php echo $num_of_row; ?></span></a>
            </li>

            <?php

          }

          ?>

                    <?php

          if ( $num_of_friend == 0) {
            
            ?>

                        <li class=""><a href="../friends_page_com.php"><i class="glyphicon glyphicon-user"></i></a></li>


            <?php
          }else{

            ?>

                        <li class=""><a href="../friends_page_com.php"><i class="glyphicon glyphicon-user"></i><span class="badge"><?php echo $num_of_friend; ?></a></li>


            <?php
          }

          ?>

      
          <li class=""><a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i></a></li>  
          <li class=""><a href="../companyprofile.php?"><i class="glyphicon glyphicon-user"></i><B><?php echo $fn; ?></B></a></li> 

 <?php

        }
        ?>


            </ul>
      </div>
    </div>
  </nav>




    <br>


    <div id = "container">
      <div class = "row">




        <div class="col-md-1 col-sm-1 col-xs-1">
        </div>



        <div class="col-md-2 col-sm-2 col-xs-2">


          <!--  updat status section-->
          <div class="row">


          <br>




    <ul class="list-group" id="pointer">
    <li id = "newmessage" class="list-group-item">New message <span class="badge"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> </li>


    <?php 

    if( $num_of_row == 0){

      ?>


    <li id = "inboxmessage" class="list-group-item">Inbox <span class="badge"><i class="fa fa-inbox"></i></span></li>
    <li  id = "sendmessage" class="list-group-item">Sent message<span class="badge"><i class="fa fa-envelope-o"></i></span></li>
  </ul>

      <?php

    }else{

      ?>


    <li id = "inboxmessage" class="list-group-item">Inbox <span class="badge"><i class="fa fa-inbox"></i></span><span id="sponge" class="label label-danger"><?php echo $num_of_row; ?></span></li>
    <li  id = "sendmessage" class="list-group-item">Sent message<span class="badge"><i class="fa fa-envelope-o"></i></span></li>
  </ul>

      <?php

    }

    ?>





          
          </div> <!-- ttp row -->
        </br>

      </div>  <!-- ttp col -->




        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class = "row">

          <br>




  <div class="panel panel-default">
    <div class="panel-body" id = "messagebox"></div>
  </div>



        </div>
    </div>




  </div>
</div>

</body>

  </html>








  <script type='text/javascript'>
  $(document).ready(function(){

        $('#messagebox').load("message_page.php");


  $('.ayamas').click(function(){
    var a = this.id;
  //  alert(a);

    $('#messagebox').html(a);
  })


    $('#btnreply').click(function(){

    $('#messagebox').html("haha");
  })



      $('#newmessage').click(function(){

    $('#messagebox').load("message_page.php");
  })


      $('#inboxmessage').click(function(){

    $('#messagebox').load("inbox_message.php");
  })


      $('#sendmessage').click(function(){

    $('#messagebox').load("send_message.php");
  })


  });
</script>