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




       $cage = "SELECT * FROM message WHERE to_user = '$u' OR from_user = '$u' ORDER BY id";

      $msg_array = mysqli_query($db_conx, $cage);

if (mysqli_num_rows($msg_array) != 0)
{
//results found
       // echo "not";


} else {
// results not found

}




       $bud = "SELECT * FROM friends WHERE user2 = '$userid' AND status = 'pending' ORDER BY id";

      $real_bud = mysqli_query($db_conx, $bud);

      $num_of_friend = mysqli_num_rows($real_bud);
      




?>





<!DOCTYPE html>
<html lang="en">

<?php include_once ("headerlogin.php"); ?>

  <link rel="stylesheet" href="style.css">


</head>


  <style media="screen">

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










    .conversation-wrap
    {
        box-shadow: -2px 0 3px #ddd;
        padding:0;
        max-height: 400px;
        overflow: auto;
    }
    .conversation
    {
        padding:5px;
        border-bottom:1px solid #ddd;
        margin:0;

    }

    .message-wrap
    {
        box-shadow: 0 0 3px #ddd;
        padding:0;

    }
    .msg
    {
        padding:5px;
        /*border-bottom:1px solid #ddd;*/
        margin:0;
    }
    .msg-wrap
    {
        padding:10px;
        max-height: 400px;
        overflow: auto;

    }

    .time
    {
        color:#bfbfbf;
    }

    .send-wrap
    {
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding:10px;
        /*background: #f8f8f8;*/
    }

    .send-message
    {
        resize: none;
    }

    .highlight
    {
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
    }

    .msg-wrap .media-heading
    {
        color:#003bb3;
        font-weight: 700;
    }


    .msg-date
    {
        background: none;
        text-align: center;
        color:#aaa;
        border:none;
        box-shadow: none;
        border-bottom: 1px solid #ddd;
    }


    .headbox{
      cursor: pointer;
    }


    </style>


  </head>



  <body id="page-top" class="index">






    <br>


    <div id = "container">



        <div class="col-md-1 col-sm-1 col-xs-1">
        </div>



        <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3">
            <div class="btn-panel btn-panel-conversation">
                <a href="" class="btn btn-primary btn-send send-message-btn" role="button"><i class="fa fa-plus"></i> New Message</a>
            </div>
        </div>

     
    </div>

 

<div class="row">

<br>

        <div class="col-md-1 col-sm-1 col-xs-1">
        </div>



  

        <div id="ministry" class="col-md-3 col-sm-3 col-xs-3">


            <?php  
      while ($row = mysqli_fetch_array($msg_array, MYSQLI_ASSOC)) {
      $id = $row["id"];
      $from = $row["from_user"];
      $from_image = $row["from_image"];
      $to = $row["to_user"];
      $to_image = $row["to_image"];
      $sbj = $row["subject"];
      $msg = $row["message"];
      $status = $row["status"];
      $cd = $row["created_date"];


      ?>

      <?php

      if ( $to == $u) {
        ?>

         <?php

      if ( $status == "unread") {
        
        ?>



            <div class="media conversation headbox" id="<?php echo $id; ?>" >
                <a class="pull-left" href="#" >
                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" src="<?php echo $from_image; ?>">
                </a>
                <div class="media-body">

                    <h5 class="media-heading"><?php echo $from; ?>
                       <span class="label label-danger">new</span>
                    </h5>
                    <small><?php echo $sbj; ?></small>
                </div>
            </div>

        <?php
      }else{
        ?>



            <div class="media conversation headbox" id="<?php echo $id; ?>" >
                <a class="pull-left" href="#" >
                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" src="<?php echo $from_image; ?>">
                </a>
                <div class="media-body">

                    <h5 class="media-heading"><?php echo $from; ?>
                    </h5>
                    <small><?php echo $sbj; ?></small>
                </div>
            </div>

        <?php
      }

      ?>

        <?php
      }else if ( $from == $u) {
        ?>

         <?php

      if ( $status == "unread") {
        
        ?>



            <div class="media conversation headbox" id="<?php echo $id; ?>" >
                <a class="pull-left" href="#" >
                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" src="<?php echo $to_image; ?>">
                </a>
                <div class="media-body">

                    <h5 class="media-heading"><?php echo $to; ?>
                    </h5>
                    <small><?php echo $sbj; ?></small>
                </div>
            </div>

        <?php
      }else{
        ?>



            <div class="media conversation headbox" id="<?php echo $id; ?>" >
                <a class="pull-left" href="#" >
                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" src="<?php echo $to_image; ?>">
                </a>
                <div class="media-body">

                    <h5 class="media-heading"><?php echo $to; ?>
                    </h5>
                    <small><?php echo $sbj; ?></small>
                </div>
            </div>

        <?php
      }

      ?>

        <?php
      }

      ?>

     

    

            <?php
          }
            ?>
       

</div>

    

      <div class = "row">





        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class = "row">





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


  $('.headbox').click(function(){
    var a = this.id;
  //  alert(a);

    //$('#messagebox').html(a);
        $('#messagebox').load("view_message.php?id="+a);

  })


    $('#btnreply').click(function(){

    $('#messagebox').html("haha");
  })



      $('#newmessage').click(function(){

    $('#messagebox').load("message_page.php");
  })


  });
</script>