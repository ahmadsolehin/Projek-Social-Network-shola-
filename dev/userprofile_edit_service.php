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
$data = $fn.$ln;

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



$ServiceID = $_GET['ServiceID'];

$services="SELECT Service_id, Service_name, Service_category, Price, Service_description, Service_pic , sub_category , service_full_description , id FROM service WHERE Service_id = '$ServiceID' ";
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
  $service_id = $row["id"];
}



$service_user = "SELECT * FROM service_skill GROUP BY main_category ";
$array_skill = mysqli_query($db_conx, $service_user);


$sub_category_array = "SELECT * FROM service_skill GROUP BY sub_category ";
$array_sub_category = mysqli_query($db_conx, $sub_category_array);


$location = "./user_provider/".$data."/";


if(isset($_POST['submit']))
{

  $sn = mysqli_real_escape_string($db_conx, $_POST['service_name']); 
  $sc = mysqli_real_escape_string($db_conx, $_POST['service_category']);
  $p = mysqli_real_escape_string($db_conx, $_POST['price']);
  $sd = mysqli_real_escape_string($db_conx, $_POST['service_description']);
  $sfd = mysqli_real_escape_string($db_conx, $_POST['service_full_description']);
  $ayam = $_POST['sub_category'];

  $id_photo = mysqli_real_escape_string($db_conx, $_POST['id_photo']);
  $id = mysqli_real_escape_string($db_conx, $_POST['id']);

  $x = uniqid(rand(10,100));


  if ($_FILES['image']['tmp_name']!='') {

   $pic = rand(1000,100000)."-".$_FILES['image']['name'];
   $pic_loc = $_FILES['image']['tmp_name'];
   $folder="user_provider/".$data."/";
   if(move_uploaded_file($pic_loc,$folder.$pic))
   {

    $xoxo = "DELETE FROM service WHERE id = '$id' ";
    $query = mysqli_query($db_conx, $xoxo);


    foreach ( $ayam as $value) 
    {
      $fresh = "INSERT INTO service( Username, Service_name, Service_category, Price, Service_description, Service_pic ,Created_date , sub_category , service_full_description , id) VALUES ('$u','$sn','$sc','$p','$sd', '$folder$pic' , now() , '$value' , '$sfd' , '$x' )";
      $query = mysqli_query($db_conx, $fresh);
    }

    header("location: userprofile.php");

  }

}else{

  $xoxo = "DELETE FROM service WHERE id = '$id' ";
  $query = mysqli_query($db_conx, $xoxo);

  foreach ( $ayam as $value) 
  {
    $fresh = "INSERT INTO service( Username, Service_name, Service_category, Price, Service_description, Service_pic ,Created_date , sub_category , service_full_description , id) VALUES ('$u','$sn','$sc','$p','$sd', '$id_photo' , now() , '$value' , '$sfd' , '$x' )";
    $query = mysqli_query($db_conx, $fresh);
  }

  header("location: userprofile.php");

} 


}




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


<script type="text/javascript">
  $(document).ready(function() {

    $(".js").select2({
      placeholder: "  Add friend",
      allowClear: true
    });

    $(".js2").select2({
      placeholder: "  Add skill",
      allowClear: true
    });

  });


</script>


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
              <li role="presentation"><a role="menuitem" tabindex="-1" href="userprofile_edit_service.php?ServiceID=<?php echo $sid; ?>">Edit Service</a></li>

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
      
    </div></br>









    <div class="row">

      <div class="col-md-4 col-sm-4 col-xs-4 "></div>
      <div class="col-md-3 col-sm-4 col-xs-4 ">
        <a href="userprofile.php">
          <button  style="width:80%" class="btn btn-primary btn-block"> Show Services</button></a>
        </div>
        <div class="col-md-2">
        </div>
      </div></br>
















      <div class="col-md-12 col-sm-12 col-xs-12">








        <!-- content -->
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
                  <form enctype="multipart/form-data" action="userprofile_edit_service.php" role="form" method="post">



                    <div class="form-group">
                      <input type="text" class="form-control" id="" name="service_name" placeholder="Enter service name" value="<?php echo $old_sn; ?>" required>
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" id="" name="price" placeholder="Enter service price" value="<?php echo $old_p; ?>" required>
                    </div>

                    <div class="form-group">

                      <select class="form-control" id="service_category" name="service_category" style="width: 100%;">
                        <?php  
                        while ($row = mysqli_fetch_array($array_skill, MYSQLI_ASSOC)) {
                          $skill_id = $row["id"];
                          $m_cate = $row["main_category"];
                          $s_cate = $row["sub_category"];
                          ?>
                          <?php
                          if ( $old_sc == $m_cate) {
                            ?>
                            <option selected="selected" value="<?php echo $m_cate;?>"><?php echo $m_cate; ?></option>
                            <?php
                          }else{
                           ?>
                           <option value="<?php echo $m_cate;?>"><?php echo $m_cate; ?></option>
                           <?php
                         }
                         ?>
                         <?php } ?>
                       </select>

                     </div>




                     <div class="form-group">

                      <select class="js2 form-control" id="sub_category" multiple="multiple" name="sub_category[]" style="width: 100%;">
                        <?php  
                        while ($row = mysqli_fetch_array($array_sub_category, MYSQLI_ASSOC)) {
                          $skill_id = $row["id"];
                          $m_cate = $row["main_category"];
                          $s_cate = $row["sub_category"];
                          ?>
                          <?php
                          if ( $old_sub_category == $s_cate) {
                            ?>
                            <option selected="selected" value="<?php echo $s_cate;?>"><?php echo $s_cate; ?></option>
                            <?php
                          }else{
                           ?>
                           <option value="<?php echo $s_cate;?>"><?php echo $s_cate; ?></option>
                           <?php
                         }
                         ?>
                         <?php } ?>
                       </select>

                     </div>

                     <div class="form-group">
                      <textarea class="form-control" type="textarea" id="message" placeholder="Enter description" name="service_description" maxlength="350" rows="7"> <?php echo $old_sd; ?> </textarea>
                    </div>

                    <div class="form-group">
                      <textarea class="form-control" type="textarea" id="message" placeholder="Enter full description" name="service_full_description" maxlength="350" rows="7"> <?php echo $old_sfd; ?> </textarea>
                    </div>

                    <div class="form-group">
                     <img src="<?php echo $old_Service_pic; ?>" id = "blah" class="img-rounded" width="230" height="223">

                     <input type="hidden" name="id_photo" value="<?php echo $old_Service_pic; ?>">
                     <input type="hidden" name="id" value="<?php echo $service_id; ?>">
                   </div>



                   <div class="form-group">
                    <input type="file" name="image" class="form-control" id="imgInp">
                  </div>






                  <div class="form-group">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
                  </div>

                  <br>
                  <br>




                </form>

              </div>

            </div>


          </div>



        </div>



      </div>















      <input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">

    </div>

  </div>


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


 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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







<style type="text/css">

  .rslides {
    position: relative;
    list-style: none;
    overflow: hidden;
    width: 100%;
    padding: 0;
    margin: 0;
  }

  .rslides li {
    -webkit-backface-visibility: hidden;
    position: absolute;
    display: none;
    width: 100%;
    left: 0;
    top: 0;
  }

  .rslides li:first-child {
    position: relative;
    display: block;
    float: left;
  }

  .rslides img {
    display: block;
    height: 350px;
    float: left;
    width: 100%;
    border: 0;
  }










  .rslides {
    margin: 0 auto;
  }

  .rslides_container {
    margin-bottom: 50px;
    position: relative;
    float: left;
    width: 100%;
  }


  .centered-btns_nav {
    z-index: 3;
    position: absolute;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    top: 50%;
    left: 0;
    opacity: 0.7;
    text-indent: -9999px;
    overflow: hidden;
    text-decoration: none;
    height: 61px;
    width: 38px;
    background: transparent url("img/themes.gif") no-repeat left top;
    margin-top: -45px;
  }

  .centered-btns_nav:active {
    opacity: 1.0;
  }

  .centered-btns_nav.next {
    left: auto;
    background-position: right top;
    right: 0;
  }

  .transparent-btns_nav {
    z-index: 3;
    position: absolute;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    top: 0;
    left: 0;
    display: block;
    background: #fff; /* Fix for IE6-9 */
    opacity: 0;
    filter: alpha(opacity=1);
    width: 48%;
    text-indent: -9999px;
    overflow: hidden;
    height: 91%;
  }

  .transparent-btns_nav.next {
    left: auto;
    right: 0;
  }

  .large-btns_nav {
    z-index: 3;
    position: absolute;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    opacity: 0.6;
    text-indent: -9999px;
    overflow: hidden;
    top: 0;
    bottom: 0;
    left: 0;
    background: #000 url("themes.gif") no-repeat left 50%;
    width: 38px;
  }

  .large-btns_nav:active {
    opacity: 1.0;
  }

  .large-btns_nav.next {
    left: auto;
    background-position: right 50%;
    right: 0;
  }

  .centered-btns_nav:focus,
  .transparent-btns_nav:focus,
  .large-btns_nav:focus {
    outline: none;
  }

  .centered-btns_tabs,
  .transparent-btns_tabs,
  .large-btns_tabs {
    margin-top: 10px;
    text-align: center;
  }

  .centered-btns_tabs li,
  .transparent-btns_tabs li,
  .large-btns_tabs li {
    display: inline;
    float: none;
    _float: left;
    *float: left;
    margin-right: 5px;
  }

  .centered-btns_tabs a,
  .transparent-btns_tabs a,
  .large-btns_tabs a {
    text-indent: -9999px;
    overflow: hidden;
    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;
    background: #ccc;
    background: rgba(0,0,0, .2);
    display: inline-block;
    _display: block;
    *display: block;
    -webkit-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);
    -moz-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);
    box-shadow: inset 0 0 2px 0 rgba(0,0,0,.3);
    width: 9px;
    height: 9px;
  }

  .centered-btns_here a,
  .transparent-btns_here a,
  .large-btns_here a {
    background: #222;
    background: rgba(0,0,0, .8);
  }


</style>


<script src="js/responsiveslides.min.js"></script>

<script>
  $(function() {

       // Slideshow 1
       $(".rslides").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
      });


     });
   </script>

   
   <script type="text/javascript">

    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgInp").change(function(){
      readURL(this);
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









  <script type="text/javascript">

    $(document).ready(function(){

      $('#service_category').change(function(){
        var a = $('#service_category').find(":selected").text();

        $.ajax({
          type:'post',
          url: 'ser_provider/select_service_skill.php',
          data: {
          'data':a //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

         $('#sub_category').empty();

         var json = $.parseJSON(data);

         for (var i=0;i<json.length;++i)
         {
          $('#sub_category').append('<option value="'+json[i].sub_category+'">'+json[i].sub_category+'</option>');                      
        }
      }
    }); 

      });

    })

  </script>

