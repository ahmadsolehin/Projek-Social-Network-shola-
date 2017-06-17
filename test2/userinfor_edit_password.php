<?php
include_once("php_includes/db_conx.php");
session_start();
if(!isset($_SESSION['username']))
{
  header("Location: index.php");
}

    //Read your session (if it is set)
    //if (isset($_SESSION['fname']))
$fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$userid = $_SESSION['userid'];
$u = $_SESSION['username'];
$usertype = $_SESSION['user_type'];



$sql="SELECT security_question FROM users WHERE username='$u' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {

  $soalan = $row["security_question"];

}



$position="";
$background="";
$profile="";

$wechat="SELECT position , background , profile FROM useroptions WHERE username='$u' LIMIT 1";
$kuali = mysqli_query($db_conx, $wechat);
while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
  $position = $row["position"];
  $background = $row["background"];
  $profile = $row["profile"];
}


if(isset($_POST["submit"])){


  $password = mysqli_real_escape_string($db_conx, $_POST['password']);

  $pass = md5($password);


    $sql = "UPDATE users SET password = '$pass' WHERE username ='$u' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);

    ?>


    <script language='Javascript'>
      alert('Save successfully');
      location.href='userprofile.php';

    </script>

    <?php






}

?>


<!DOCTYPE html>
<html lang="en">

<?php include_once ("headerlogin.php"); ?>

  <link rel="stylesheet" href="style.css">



  <style media="screen">


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






  <style media="screen">
    @import url('http://fonts.googleapis.com/css?family=Oswald');


    #video-background {


      z-index: -100;
    }

    article {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: 10px;
    }

    #vidh {
      position: absolute;
      top: 60%;
      width: 100%;
      font-size: 2vmax;
      letter-spacing: 3px;
      color: #fff;
      font-family: Oswald, sans-serif;
      text-align: center;
    }

    .bt-login,.bt-login:hover, .bt-login:active, .bt-login:focus {
      background-color: #ff8627;
      color: #ffffff;
      padding-bottom: 10px;
      padding-top: 10px;
      transition: background-color 300ms linear 0s;
    }


    .login-tab {
     margin: 0 auto;
     width: 90%;
   }

   .login-modal-header {
     background: #27ae60;
     color: #fff;
   }

   .login-modal-header .modal-title {
     color: #fff;
   }

   .login-modal-header .close {
     color: #fff;
   }

   .login-modal i {
     color: #000;
   }

   .login-modal form {
     max-width: 340px;
   }

   .tab-pane form {
     margin: 0 auto;
   }
   .login-modal-footer{
     margin-top:15px;
     margin-bottom:15px;
   }

   /*hoover effects*/
   .custom_hoover1:hover {
    border-radius:50%;
    box-shadow: 0 10px 6px -6px grey;
    -webkit-transform:scale(1.1);
    transform:scale(1.1);
  }
  .custom_hoover1 {
    -webkit-transition: all 0.7s ease;
    transition: all 0.7s ease;
  }

  .custom_hoover2:hover {
    -webkit-box-shadow: 0px 0px 15px 15px #fff;
    /*box-shadow: 0px 0px 15px 15px #fff;*/
    box-shadow: 0px 0px 15px 10px #00FF00;
    border-radius:50%;
    opacity: 1;
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);

  }
  .custom_hoover2 {
    opacity: 1;
    -webkit-transition: all 0.7s ease;
    transition: all 0.7s ease;
  }

  /*parallax effect*/
  .parallax_custom{
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
  /* caption of categories*/
  .thumbnail {
    position:relative;
    overflow:hidden;
  }

  .caption {
    position:absolute;
    top:0;
    right:0;
    background:rgba(66, 139, 202, 0.75);
    width:100%;
    height:100%;
    padding:2%;
    display: none;
    text-align:center;
    color:#fff !important;
    z-index:2;
  }



  @media screen and (max-width: 480px) {
    #menulist{
      min-width: 250px;
      padding: 14px 14px 0;
      overflow:hidden;
      background-image: -ms-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: -moz-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: -o-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: -webkit-gradient(radial, center center, 0, center center, 125, color-stop(0, #BDBDBD), color-stop(200, #141413));
      background-image: -webkit-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: radial-gradient(ellipse closest-side at center, #BDBDBD 0, #141413 200%);
      opacity: .9
    }
  }
</style>





<style>
  body {
    background-size: cover;
    font-family: Montserrat;
  }

  .logo {
    width: 213px;
    height: 36px;
    margin: 30px auto;
  }

  .login-block {
    width: 70%;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #F7D83D;
    margin: 0 auto;
    margin-right: 3%;
  }

  .login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
  }

  .login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
  }

  .login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
  }

  .login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
  }

  .login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
  }

  .login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
  }

  .login-block input:active, .login-block input:focus {
    border: 1px solid #F7D83D;
  }

  .login-block button {
    width: 100%;
    height: 40px;
    background: #F7D83D;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #F7D83D;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
  }

  .login-block button:hover {
    background: #DCB90C;
  }

</style>
</head>
<body id="page-top" class="index">

  <!--navigation bar-->
    <!--row for cover photo  -->
    <div class="full-background">


    </div>
  </br>

  <div class="container">



    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4">

        <div class="row">

          <div class="col-md-4 col-sm-4 col-xs-4">
            <a href="#" class="" data-toggle="">

              <img src="img/user_rating.png" class="img-responsive" alt="">
                        <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
                        <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <a href="#" class="" data-toggle="">

                        <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt="">
              <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
              <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
            </a>
          </div>


        </div>

      </div>

      <div class="col-md-3 col-sm-3 col-xs-3" >


        <form enctype="multipart/form-data" action="image_upload_demo_submit.php" method="post" name="image_upload_form" id="image_upload_form">
          <div id="imgArea">        
            <img id="profile-photo" style="display: block; margin-left: auto; margin-right: auto;margin-top:-5vmax"  src="<?php echo $profile; ?>" class="img-responsive img-circle" alt="">

            <div class="progressBar">
              <div class="bar"></div>
              <div class="percent">0%</div>
            </div>
            <div id="imgChange"><span>Change Photo</span>
              <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">
              <input type = "hidden" name = "name" value = "<?php echo $fn.''.$ln; ?>">
              <input type = "hidden" name = "usertype" value = "<?php echo $usertype; ?>">
            </div>
          </div>
        </form>

        <p style="text-align:center"><?php echo $fn.' '.$ln; ?></p>


      </div>
      <div class="col-md-2 col-sm-2 col-xs-2">

        <a href="userinfor_edit_password.php" class="btn btn-primary">Edit Password</a>



        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div>
                  <iframe width="100%" height="350" src=""></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-2 col-sm-2 col-xs-2">
        <a  class="page-scroll"  href="#post">
          <button id="post_show" style="font-size:1vmax" class="btn btn-primary" type="submit">See Posts</button>
        </a>
        <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
        <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->

      </div>
<!--       <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-envelope"></i> </button>
        </a>
        
      </div> -->

    </div></br>



  </br>
  <div class="row">

    <div class="col-md-4 col-sm-4 col-xs-4 "></div>
    <div class="col-md-3 col-sm-4 col-xs-4 ">
      <a href="userprofile.php">
        <button  style="width:80%" class="btn btn-primary btn-block"> Show Services</button></a>
      </div>
      <div class="col-md-2">
       <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#videoModal" data-theVideo="http://www.youtube.com/embed/loFtozxZG0s">VIDEO CV</a> -->


        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div>
                  <iframe width="100%" height="350" src=""></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div></br>

    <div class="row">



      <div class="col-md-9 col-sm-9 col-xs-9">


        <div class="row">

          <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-1">
            </div>
            <div class="col-md-8 col-sm-8 col-xs-10">
              <br>
              <!-- form collapse goes here -->




              <div class="login-block">
                <h1>Edit password</h1>
                <form method="post" action="userinfor_edit_password.php" id="reset" name="loginform">


                  <input type="text" value="<?php echo $soalan; ?>" class = "classname" readonly>



                  <br>

                  <input type="text" value="" placeholder="enter security answer" id="answer">
                  <br>

                  <span id="result"></span>
                                    <br>
                  <span id="jawapan"></span>


                  <button id = "rooster" type="submit" name="submit">Submit</button>

                </form>
              </div>


<style type="text/css">

  input[readonly].classname{
    background-color:transparent;
    font-size: 1em;
  }

</style>






            </div>

          </div>


        </div>



      </div>
      <!--  advertisement and top services section-->
      <div class="col-md-3 col-sm-3 col-xs-3">


        <div class="row">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h5 class="section-heading">Trending Services</h5>
              <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
            </div>
          </div>


          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
              <a href="#" class="" data-toggle="">

                <img src="img/portfolio/roundicons.png" class="img-responsive" alt="">
              </a>
              <div class="">

                <p class="text-muted">Graphic Design</p>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
              <a href="#" class="" data-toggle="">

                <img src="img/portfolio/roundicons.png" class="img-responsive" alt="">
              </a>
              <div class="">

                <p class="text-muted">Graphic Design</p>
              </div>
            </div>

          </div>

        </div>

        <!-- Advertisements  -->
        <div class="row">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h5 class="section-heading">ADS</h5>
              <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
            </div>
          </div>

        </div>

      </div>
    </div>

  </div></br>


  <!-- Footer -->
  <?php include_once ("footer.php"); ?>


  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="js/classie.js"></script>
  <script src="js/agency.js"></script>

  <script src="coverphoto/coverphoto.js"></script>

  <script src="js/jquery.form.js"></script> 



  <script>
    $(document).ready(function() {


      autoPlayYouTubeModal();
        //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
        function autoPlayYouTubeModal() {
          var trigger = $("body").find('[data-toggle="modal"]');
          trigger.click(function() {
            var theModal = $(this).data("target"),
            videoSRC = $(this).attr("data-theVideo"),
            videoSRCauto = videoSRC + "?autoplay=1";
            $(theModal + ' iframe').attr('src', videoSRCauto);
            $(theModal + ' button.close').click(function() {
              $(theModal + ' iframe').attr('src', videoSRC);
            });
          });
        }

      });
    </script>
    <script>
    // $(document).ready(function(){
    //   // $('#popover').popover();
    //
    //   $('#popover').popover();
    //
    //   $('#popover').on('click', function (e) {
    //       $('#popover').not(this).popover('hide');
    //   });
    // });
    $(document).ready(function(){

      $('.btn-popover').popover({
        trigger:'hover',
        animation: false,
        placement: 'auto right'
      });

      $('.btn-popover').on('click', function (e) {
        $('.btn-popover').not(this).popover('hide');
      });

      $('#uni_start_date').datepicker({
        format: "dd/mm/yyyy"
      });

      $('#uni_end_date').datepicker({
        format: "dd/mm/yyyy"
      });

      $('#work_start_date').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#work_end_date').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#work_start_date_2').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#work_end_date_2').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#project_start_date').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#project_end_date').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#certificate_start_date').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#certificate_end_date').datepicker({
        format: "dd/mm/yyyy"
      });



      $('#certficate_start_date').datepicker({
        format: "dd/mm/yyyy"
      });
      $('#certficate_start_date').datepicker({
        format: "dd/mm/yyyy"
      });

    });

  </script>




  <script type="text/javascript">

    var usertype = '<?php echo $usertype; ?>';
    var background = '<?php echo $background; ?>';
    var position = '<?php echo $position; ?>';

    var simple = '<?php echo $fn; ?>';
    simple += '<?php echo $ln; ?>';

    if (background == 'original') {

      path = 'img/plain.jpg';

    }else {

      if (usertype == "Service Provider") 
      {
        var path = 'user_provider/';
        path+=simple;
        path+='/'+background;

      }else if (usertype == "Service Seeker") {

        var path = 'user_seeker/';
        path+=simple;
        path+='/'+background;
      }else if (usertype == "Company") {

        var path = 'user_company/';
        path+=simple;
        path+='/'+background;
      }

    }






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
</body>

</html>

<script type="text/javascript">

  $(document).ready(function(){

    var itik = $('#positionimage').val();

    $(".coverphoto-photo-container").children().css({"position":"relative", "top":itik});

  })

</script>










<script type="text/javascript">

  $(document).ready(function()
  {    
   $("#answer").keyup(function()
   {  
    var name = $(this).val(); 
    var userid = '<?php echo $userid; ?>';

    
    if(name.length > 1)
    {  
     $("#result").html('checking...');
     
     $.ajax({

      type : 'POST',
      url  : 'security_answer-check.php',
      data : {
        userid:userid,
        name : name
      },
      success : function(data)
      {
        if (data == "ok") {

         $("#result").html("<span style='color:green;'>Correct</span>");


         $("#jawapan").html("<input type='password' name='password' placeholder = 'Enter new password' >");

           $('#rooster').prop('disabled', false);
         


       }else if(data == "ko"){
         $("#result").html("<span style='color:brown;'>Wrong answer !!!</span>");
         $("#jawapan").empty();
         $('#rooster').prop('disabled', true);

       }
     }
   });
     return false;
     
   }
   else
   {
     $("#result").html('');
   }
 });
   
 });
</script>





<script>
  $(document).ready(function(){

   $('#rooster').prop('disabled', true);


 });
</script>
