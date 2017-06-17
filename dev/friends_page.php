<?php



   include_once("php_includes/check_login_status.php");
   
  if(!isset($_SESSION['username']))
  {
  header("Location: index.php");
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

<?php include_once ("headerlogin.php"); ?>

  <link rel="stylesheet" href="style.css">


  <style media="screen">


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
    <li id = "newmessage" class="list-group-item">Friend List<span class="badge"><i class="fa fa-users" aria-hidden="true"></i>
</span> </li>


    <?php 

    if( $num_of_friend == 0){

      ?>


    <li id = "requestpage" class="list-group-item">Request friend <span class="badge"><i class="fa fa-user-plus" aria-hidden="true"></i></span></li>
  </ul>

      <?php

    }else{

      ?>


    <li id = "requestpage" class="list-group-item">Request friend <span class="badge"><i class="fa fa-user-plus" aria-hidden="true"></i></span><span id="sponge" class="label label-danger"><?php echo $num_of_friend; ?></span></li>
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



        $('#messagebox').load("friends_list.php");


  $('.ayamas').click(function(){
    var a = this.id;
  //  alert(a);

    $('#messagebox').html(a);
  })


    $('#btnreply').click(function(){

    $('#messagebox').html("haha");
  })



      $('#newmessage').click(function(){

    $('#messagebox').load("friends_list.php");
  })


      $('#requestpage').click(function(){

    $('#messagebox').load("request_page.php");
  })


      $('#sendmessage').click(function(){

    $('#messagebox').load("send_message.php");
  })


  });
</script>