<?php

session_start();


include_once("php_includes/check_login_status.php");
     //Start your session
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
$usertype = $_SESSION['user_type'];


$position="";
$background="";
$profile="";

$wechat="SELECT position , background , profile FROM useroptions WHERE id='$userid' LIMIT 1";
$kuali = mysqli_query($db_conx, $wechat);
while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
  $position = $row["position"];
  $background = $row["background"];
  $profile = $row["profile"];
}






$data1="SELECT * FROM employment WHERE username='$u' ";
$query1 = mysqli_query($db_conx, $data1);


$data2="SELECT * FROM education WHERE username='$u' ";
$query2 = mysqli_query($db_conx, $data2);



$data3="SELECT * FROM projects WHERE username='$u' LIMIT 1";
$query3 = mysqli_query($db_conx, $data3);
while ($row = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {

  $project_name = $row["project_name"];
  $project_desc = $row["project_desc"];
  $project_sdate = $row["project_sd"];
  $project_edate = $row["project_ed"];

}


$data4 = "SELECT * FROM certification WHERE username='$u' ";
$query4 = mysqli_query($db_conx, $data4);




$summary="";

$sql="SELECT About_me FROM cv WHERE username='$u' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
  $summary = $row["About_me"];
  
}


$ServiceID = $_GET['ServiceID'];
$id_service = $_GET['id'];

$services="SELECT Service_id, Service_name, Service_category, Price, Service_description, Service_pic , sub_category , service_full_description FROM service WHERE Service_id = '$ServiceID' ";
$service = mysqli_query($db_conx, $services);

while ($row = mysqli_fetch_array($service, MYSQLI_ASSOC) ) {

  $sid= $row["Service_id"];
  $old_sn= $row["Service_name"];
  $old_sc= $row["Service_category"];
  $old_p= $row["Price"];
  $old_sd= $row["Service_description"];
  $old_Service_pic = $row["Service_pic"];
  $old_sub_category = $row["sub_category"];
  $old_sfd = $row["service_full_description"];
}



$ser="SELECT sub_category FROM service WHERE id = '$id_service' ";
$serv = mysqli_query($db_conx, $ser);



?>

<!DOCTYPE html>
<html lang="en">

<?php include_once ("headerlogin.php"); ?>

<link rel="stylesheet" href="style.css">


<style type="text/css">

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


<body id="page-top" class="index">

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

            <!--<img src="img/user_rating.png" class="img-responsive" alt=""> -->
                        <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
                        <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <a href="#" class="" data-toggle="">

                        <!--  <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt="">-->
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




        <div class="dropdown" >
          <button class=" btn btn-primary"  type="button" id="menu1" data-toggle="dropdown">Settings
            <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="z-index:258">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="userinfor_edit_password.php">Change Password</a></li>
              <li role="presentation" class="divider"></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="val.php">Validate Account</a></li>

              <li role="presentation" class="divider"></li>
              <li role="presentation" class="divider"></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" id="delete-service" href="javascript: void(0)" href="userprofile_delete_service.php?ServiceID=<?php echo $sid; ?>">Delete Service</a></li>

            </ul>
          </div>





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
         <a href="feedback.php">
          <button id="post_show" style="font-size:1vmax" class="btn btn-primary" type="submit">Feedback</button>
        </a>
        <a  class="page-scroll"  href="#post">
          <!-- <button id="post_show" style="font-size:1vmax" class="btn btn-primary" type="submit">See Posts</button> -->
        </a>
        <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
        <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->

      </div>










      
    </div>

















    <div class="row">

      <div class="col-md-4 col-sm-4 col-xs-4 "></div>
      <div class="col-md-3 col-sm-4 col-xs-4 ">
        <a href="userprofile.php">
          <button  style="width:80%" class="btn btn-primary btn-block"> Show Services</button></a>
        </div>
        <div class="col-md-2">
        </div>
      </div></br>





    </div>





<!-- 



    <div class="container">
      <div class="col-md-8 col-md-offset-2">
        <h2></h2>
        <p></p>
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">Service Name</div>
            <div class="panel-body"><?php echo nl2br($old_sn); ?></div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">Service Category</div>
            <div class="panel-body"><?php echo nl2br($old_sc); ?></div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">Sub Category</div>
            <div class="panel-body"><?php echo nl2br($old_sub_category); ?></div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">Price</div>
            <div class="panel-body"><?php echo nl2br($old_p); ?></div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">Description</div>
            <div class="panel-body"><?php echo nl2br($old_sd); ?></div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">Photo</div>
            <div class="panel-body"><img  class="img-responsive" src="<?php echo $old_Service_pic; ?>" alt=""></div>
          </div>
        </div>
      </div>
    </div>

 -->






    <div class="container">
      <div class="col-md-8 col-md-offset-2">
        <h2></h2>
        <p></p>
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">Service Details</div>
            <div class="panel-body">

              <p><?php echo nl2br($old_sd); ?></p>

              <hr>

              <ul class="nav nav-tabs">
                <li><a href="" style="color: black;"><?php echo nl2br($old_sn); ?></a></li>
                <li><a href="#" style="color: black;"><?php echo nl2br($old_sc); ?></a></li>
              </ul>

              <hr>

              <img  class="img-responsive center-block" src="<?php echo $old_Service_pic; ?>" alt="">

              <br>
              <br>

                            <p>Price : <?php echo $old_p; ?></p> 


              <hr>

              <p align="center"><?php echo nl2br($old_sfd); ?></p>

              <hr>

              <p>Sub category / skill</p>

              <ul>
                <?php 
                while ($row = mysqli_fetch_array($serv, MYSQLI_ASSOC) ) {
                  $xray = $row["sub_category"];
                  ?>
                  <li><?php echo $xray; ?></li>
                  <?php 
                }
                ?>
              </ul> 

              <button class="pull-right btn btn-primary">Proceed to checkout</button> 

      
            </div>
          </div>

        </div>
      </div>
    </div>












<!-- 

    <div class="container">
      <div class="col-md-8 col-md-offset-2">

        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-6" for="email"><?php echo nl2br($old_sd); ?></label>
            <div class="col-sm-6">
            </div>
          </div>

          <hr>

          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-10">          
              <ul class="nav nav-tabs">
                <li><a href=""><?php echo nl2br($old_sn); ?></a></li>
                <li><a href="#"><?php echo nl2br($old_sc); ?></a></li>
              </ul>
            </div>
          </div>

          <hr>

          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-6">          
             <img  class="img-responsive" src="<?php echo $old_Service_pic; ?>" alt="">
           </div>
         </div>

         <div class="form-group">
          <label class="control-label col-sm-6" for="email"><?php echo nl2br($old_sfd); ?></label>
          <div class="col-sm-6">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-4" for="email">Sub category / skill</label>
          <br>
          <div class="col-sm-10">
            <br>

            <ul>

              <?php 


              while ($row = mysqli_fetch_array($serv, MYSQLI_ASSOC) ) {
                $xray = $row["sub_category"];
                ?>
                <li><?php echo $xray; ?></li>
                <?php 
              }
              ?>
            </ul>  

          </div>
        </div>

        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label><input type="checkbox"> Remember me</label>
            </div>
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
 -->





  <input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">


  <!-- Footer -->
  <!-- Footer -->
  <div>
   <?php include_once("footer.php"); ?>
 </div>
 <!-- JS Files here -->


 <script src="coverphoto/jquery.js"></script>
 <script src="coverphoto/jquery-ui.custom.min.js"></script>

 <!--   <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script> -->
 <!-- Latest compiled and minified JavaScript -->
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
        path+=background;
      }else if (usertype == "Company") {

        var path = 'user_company/';
        path+=simple;
        path+=background;
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







<script>
  $("#delete-service").click(function(){
    if(confirm("Are you sure you want to delete this?")){
      $("#delete-service").attr("href", "userprofile_delete_service.php?ServiceID=<?php echo $sid; ?>");
    }
    else{
      return false;
    }
  });
</script>
