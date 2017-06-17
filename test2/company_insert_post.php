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
$c = $_SESSION['comapny_name'];

$u = $_SESSION['username'];
$usertype = $_SESSION['user_type'];

$data = $fn.$ln;



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

  $location = "./user_company/".$data."/";


if(isset($_POST['submit']))
{


  $title = mysqli_real_escape_string($db_conx, $_POST['title']); 
  $desc = mysqli_real_escape_string($db_conx, $_POST['desc']);


     $pic = rand(1000,100000)."-".$_FILES['image']['name'];
    $pic_loc = $_FILES['image']['tmp_name'];
     $folder="user_company/".$data."/";
     if(move_uploaded_file($pic_loc,$folder.$pic))
     {


    $oppo = "INSERT INTO company_post ( title , image , description , username ) VALUES ( '$title','$folder$pic' , '$desc' , '$u' ) ";
    $query = mysqli_query($db_conx, $oppo);

  header("location: companyprofile.php");



     }
     
}



?>


<!DOCTYPE html>
<html lang="en">


<!-- Include jQuery library -->

<?php include_once ("headerlogin.php"); ?>

<link rel="stylesheet" href="style.css">
<link href="css/styles-5.css" rel="stylesheet">





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

            <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt="">
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

      <div class="col-md-3 col-sm-3 col-xs-3">


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
        <a href="#" class="" data-toggle="">

          <img src="img/user_rating.png" class="img-responsive" alt="">
          <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
          <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
        </a>
      </div>

  <!--     <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-envelope"></i> </button>
        </a>
        <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
          <i class="fa fa-2x fa-info-circle"></i></a></p></div>

      </div>
      <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-plus"></i><i style="color:green" class="glyphicon glyphicon-user"></i></button>
        </a>
        
      </div> -->


    </div><!-- end of badge/photos section  -->
  </br>
  <div class="row">

    <div class="col-md-4 col-sm-4 col-xs-4 "></div>
    <div class="col-md-3 col-sm-4 col-xs-4 ">
      <a href="companyprofile.php">
        <button  style="width:80%" class="btn btn-primary btn-block"> Show Profile</button></a>
      </div>
      <div class="col-md-2">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#videoModal" data-theVideo="http://www.youtube.com/embed/loFtozxZG0s">VIDEO CV</a>


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

          <!--form container  -->
          <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-1">
            </div>
            <div class="col-md-8 col-sm-8 col-xs-10">
              <p>Please fill following fields</p>
              <!-- form collapse goes here -->
              <form enctype="multipart/form-data" action="company_insert_post.php" role="form" method="post">



                <div class="form-group">
                        <input type="text" class="form-control" id="" name="title" placeholder="Enter title" required>
                    </div>
                    <div class="form-group">
                    <input type="file" name="image" class="form-control" id="">
                    </div>
                    
                    <div class="form-group">
                        <textarea class="form-control" type="textarea" id="message" placeholder="Enter description" name="desc" maxlength="2000" rows="7"></textarea>
                    </div>




                    <div class="form-group">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>




              </form>

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
  <?php include_once("footer.php"); ?>



  <input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">


  <script src="coverphoto/jquery.js"></script>
  <script src="coverphoto/jquery-ui.custom.min.js"></script>

  <!-- JS Files here -->
  <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
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



<script>
  $(document).on('change', '#image_upload_file', function () {
    var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

    $('#image_upload_form').ajaxForm({
      beforeSend: function() {
        progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
      },
      uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
      },
      success: function(html, statusText, xhr, $form) {   
        obj = $.parseJSON(html);  
        if(obj.status){   
          var percentVal = '100%';
          bar.width(percentVal)
          percent.html(percentVal);
          $("#imgArea>img").prop('src',obj.image_medium);     
        }else{
          alert(obj.error);
        }
      },
      complete: function(xhr) {
        progressBar.fadeOut();      
      } 
    }).submit();    

  });
</script>








</body>

</html>

