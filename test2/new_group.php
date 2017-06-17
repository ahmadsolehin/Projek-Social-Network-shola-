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


$nama_kumpulan = $_GET["id"];

$user_listing = "SELECT * FROM users WHERE username != '$u' ";
$user_array = mysqli_query($db_conx, $user_listing);



$skill_listing = "SELECT DISTINCT skill_service_provider FROM skills ";
$skill_array = mysqli_query($db_conx, $skill_listing);


$data1="SELECT * FROM new_group ";
$query1 = mysqli_query($db_conx, $data1);



$reader = "SELECT * FROM group_member";
$spl = mysqli_query($db_conx, $reader);
$num_of_row = mysqli_num_rows($spl);



$data2="SELECT * FROM special_group GROUP BY group_name ";
$query2 = mysqli_query($db_conx, $data2);
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

        <!--row for cover photo  -->
  <div class="full-background">

  </div>

    </br>





  <div class="container">
    <div class="row" style="padding-top:50px;">

        <div class="col-md-4 col-sm-4 col-xs-4">

        <div id = "cursor" class="list-group list-group-horizontal">
          <a id="btn-discuss" class="list-group-item">Discussion</a>
          <a id="btn-member" class="list-group-item">Members</a>
          <a id="btn-request" class="list-group-item">Request</a>
        </div>

      </div>


    </div>










    <div class="col-md-10 col-sm-10 col-xs-10">



      <div class="panel panel-default">
        <div class="panel-body" id = "messagebox">


        </div>
      </div>
    </div>






  </div>



     <input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">


            <!-- Footer -->
            <!-- Footer -->
            <div>
             <?php include_once("footer.php"); ?>
           </div>
           <!-- JS Files here -->



</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">

           <script src="coverphoto/jquery.js"></script>
           <script src="coverphoto/jquery-ui.custom.min.js"></script>

           <script src="coverphoto/coverphoto.js"></script>

           <script src="js/jquery.form.js"></script> 

    <script type="text/javascript">


      path = 'user_company/49013-gre.png';

    





    $(function() {
      $(".full-background").CoverPhoto({
        currentImage: path,
        editable: true
      });

      $(".full-background").bind('coverPhotoUpdated', function(evt, dataUrl) {

   var pos =  $(".coverphoto-photo-container").children().position(); // returns an object with the attribute top and left
   
   $.ajax({
    type:'post',
    url: 'juju.php',
    data: {
          'name':dataUrl, //dataurl nie basecode64 img
          'position':pos.top //nie position when user move image
        },
        success: function(data){
     //      alert(data);
   }
 });


 });

    });

    




  </script>






<script type="text/javascript">

  $(document).ready(function(){

    $('#btn-request').click(function(){
      var hehe = '<?php echo $nama_kumpulan; ?>';
$( "#messagebox" ).load( "request_new_group.php?id="+hehe );

    })

  })

</script>




</body>

</html>

<script type="text/javascript">

  $(document).ready(function(){

    var itik = $('#positionimage').val();

    $(".coverphoto-photo-container").children().css({"position":"relative", "top":itik});

  })

</script>

















<script type='text/javascript'>
$(document).ready(function(){

  $('#messagebox').load("group_discuss.php");




  $('#btn-discuss').click(function(){

    $('#messagebox').load("group_discuss.php");
  })


  $('#btn-member').click(function(){

    $('#messagebox').load("group_member.php");
  })



});
</script>





