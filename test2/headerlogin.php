<?php



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

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

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
          url: "search.php",
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
  <link rel="stylesheet" href="css/kopi.css">


  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/header.css">
  <link href="css/agency.css" rel="stylesheet">
  <link href="chatbox/chatbox.css" rel="stylesheet">

  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <!-- Custom Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
  
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  

  <link rel="stylesheet" href="coverphoto/coverphoto.css">

  <style type="text/css">
    .coverphoto, .output {
      width: 1024px;
      height: 200px;
      border: 1px solid black;
      margin: 10px auto;
    }


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
  </style>



  <style media="screen">
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

    body,
    html {
      height: 100%;
    }

    body {
      padding-top: 62px;
    }

    .full-background {
      width: 100%;
      height: 100%;
      height: calc(100% - 60%);
      background-size: cover;
    }

    .full-background img {
      width: 100%;
    }

    #profile-photo {
      width: 75%;
      height: 80%;
    }

    #badge-icon {
      width: 75%;
      height: 80%;
    }
  </style>

</head>


  <!--navigation bar-->

  <nav class="navbar navbar-default  navbar-fixed-top" role="navigation" id="navbar-main">
    <div class="container" >
      <div class="navbar-header page-scroll" style="z-index:100000">
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
          <li class=""><a href="group_page.php"><i class="fa fa-users" aria-hidden="true"></i></a></li>

         <?php 

             if( $num_of_row == 0){

              ?>

            <li class=""><a href="private_message.php"><i class="glyphicon glyphicon-envelope"></i></a>
            </li>

            <?php }else{

              ?>

            <li class=""><a href="private_message.php"><i class="glyphicon glyphicon-envelope"></i><span class="badge"><?php echo $num_of_row; ?></span></a>
            </li>

            <?php

          }

          ?>

          <?php

          if ( $num_of_friend == 0) {
            
            ?>

                        <li class=""><a href="friends_page.php"><i class="glyphicon glyphicon-user"></i></a></li>


            <?php
          }else{

            ?>

                        <li class=""><a href="friends_page.php"><i class="glyphicon glyphicon-user"></i><span class="badge"><?php echo $num_of_friend; ?></a></li>


            <?php
          }

          ?>


            <li class=""><a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i></a></li> 
            <li class=""><a href="../service_seeker_profile.php"><i class="glyphicon glyphicon-user"></i> <?php echo $fn ; ?></a></li>

            <?php
    }else if ($usertype == "Service Provider") {
      ?>

             <li class=""><a href="../newsfeed_version1.php"><i class="glyphicon glyphicon-home"></i></a></li>
              <li class=""><a href="group_page.php"><i class="fa fa-users" aria-hidden="true"></i></a></li>

                      <?php 

             if( $num_of_row == 0){

              ?>

          <li class=""><a href="private_message.php"><i class="glyphicon glyphicon-envelope"></i></a></li>

                      <?php }else{

              ?>

            <li class=""><a href="private_message.php"><i class="glyphicon glyphicon-envelope"></i><span class="badge"><?php echo $num_of_row; ?></span></a>
            </li>

            <?php

          }

          ?>

                    <?php

          if ( $num_of_friend == 0) {
            
            ?>

                        <li class=""><a href="friends_page.php"><i class="glyphicon glyphicon-user"></i></a></li>


            <?php
          }else{

            ?>

                        <li class=""><a href="friends_page.php"><i class="glyphicon glyphicon-user"></i><span class="badge"><?php echo $num_of_friend; ?></a></li>


            <?php
          }

          ?>


          <li class=""><a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i></a></li>  
          <li class=""><a href="../userprofile.php?"><i class="glyphicon glyphicon-user"></i><B><?php echo $fn; ?></B></a></li> 
          
                    
                    
                    

      <?php
    }else if ($usertype == "Company") {
      ?>

      <li class=""><a href="../company_newsfeed.php"><i class="glyphicon glyphicon-home"></i></a></li>
      <li class=""><a href="group_page.php"><i class="fa fa-users" aria-hidden="true"></i>
</a></li>

<?php 

             if( $num_of_row == 0){

              ?>

          <li class=""><a href="private_message.php"><i class="glyphicon glyphicon-envelope"></i></a></li>

                      <?php }else{

              ?>

            <li class=""><a href="private_message.php"><i class="glyphicon glyphicon-envelope"></i><span class="badge"><?php echo $num_of_row; ?></span></a>
            </li>

            <?php

          }

          ?>

                    <?php

          if ( $num_of_friend == 0) {
            
            ?>

                        <li class=""><a href="friends_page_com.php"><i class="glyphicon glyphicon-user"></i></a></li>


            <?php
          }else{

            ?>

                        <li class=""><a href="friends_page_com.php"><i class="glyphicon glyphicon-user"></i><span class="badge"><?php echo $num_of_friend; ?></a></li>


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


  <!--row for cover photo  -->

</html>
