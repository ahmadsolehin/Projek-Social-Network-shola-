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
            <li id = "followerpage" class="list-group-item">Follower List<span class="badge"><i class="fa fa-users" aria-hidden="true"></i>
            </span> </li>

            <li id = "blockpage" class="list-group-item">Block Follower<span class="badge"><i class="fa fa-user-plus" aria-hidden="true"></i></span></li>
          </ul>

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

    $('#messagebox').load("follower_list.php");


    $('#followerpage').click(function(){

      $('#messagebox').load("follower_list.php");
    })


    $('#blockpage').click(function(){

      $('#messagebox').load("follower_block.php");
    })


  });
</script>