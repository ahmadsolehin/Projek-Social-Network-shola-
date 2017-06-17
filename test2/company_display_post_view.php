<?php

   include_once("php_includes/check_login_status.php");
     //Start your session
  if(!isset($_SESSION['username']))
  {
  header("Location: index.php");
  }

  
   //Read your session (if it is set)
   if (isset($_SESSION['fname']))
      $fn =  $_SESSION['fname'];
$userid = $_SESSION['userid'];
       $usertype = $_SESSION['user_type'];




$username = $_GET['u'];
$getid = $_GET['id'];




$sql_res=mysqli_query( $db_conx ,"select user_type , avatar,first_name, last_name ,username from users where username like '$username' order by id LIMIT 50")or die(mysqli_error($db_conx));
while($row=mysqli_fetch_array( $sql_res))
{
$usertype_user=$row['user_type'];
$profile=$row['avatar'];
$fn_other=$row['first_name'];
$ln_other=$row['last_name'];

}

 
$position="";
$background="";
$profile="";

$wechat="SELECT position , background , profile FROM useroptions WHERE username='$username' LIMIT 1";
$kuali = mysqli_query($db_conx, $wechat);
while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
  $position = $row["position"];
  $background = $row["background"];
  $profile = $row["profile"];
}







$post_company = "SELECT * FROM company_post WHERE id = '$getid' AND username='$username' LIMIT 1";
$comp_post = mysqli_query($db_conx, $post_company);
while ($row = mysqli_fetch_array($comp_post, MYSQLI_ASSOC)) {
    $id= $row["id"];
      $title = $row["title"];
      $image = $row["image"];
      $desc = $row["description"];
}




$imageku ="SELECT image FROM company_post WHERE id = '$getid' AND username='$username' ";
$product_image = mysqli_query($db_conx, $imageku);





?>



<!DOCTYPE html>
<html lang="en">


<!-- Include jQuery library -->

<?php include_once ("headerlogin.php"); ?>

<link rel="stylesheet" href="style.css">
<link href="css/styles-5.css" rel="stylesheet">





<style media="screen">


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

           
           
          </div>
        </form>

        <p style="text-align:center"><?php echo $fn_other.' '.$ln_other; ?></p>

      </div>

    

        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4 "></div>
          <div class="col-md-3 col-sm-4 col-xs-4 ">
            <!--<h4>Jari Peter</h4>-->
          </div>

        </div></br>

        <div class="row">
          <!--  service container-->


         


          <div class="col-md-12 col-sm-12 col-xs-12">








                <!-- content -->
                <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-8">



                    <div class="panel panel-default">
                      <div class="panel-body">



                       <h4 class="sub"><a  style="text-decoration:none;" href="#">Title</a> </h4> 
                       <p><strong><?php echo  $title; ?></strong></p>
                       <hr>

                       <h4 class="sub"><a  style="text-decoration:none;" href="#">Description</a> </h4>
                       <div class="row">
                        <div class="col-md-9">
                          <p align="justify"><?php echo  $desc; ?></p>
                        </div>
                      </div>



                      <hr>
                      <h4 class="sub"><a  style="text-decoration:none;" href="#"> PHOTOS</a></h4>

                      <div class="rslides_container">
                        <ul class="rslides">

                          <?php  
                          while ($row = mysqli_fetch_array($product_image, MYSQLI_ASSOC)) {
                            $prod_pic = $row["image"];
                            ?>
                            <li><img src="<?php echo $prod_pic; ?>" alt=""></li>
                            <?php } ?>
                          </ul>
                        </div>  


















                      </div>
                    </div>
                  </div>

                  <!-- /col-9 --> 





  <div class="col-md-3 col-sm-3 col-xs-3">
          <div class = "row">
            <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1769554773319547";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        
        
       <div class="fb-page" data-href="https://www.facebook.com/grezzli.online/" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/grezzli.online/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/grezzli.online/">Grezzli</a></blockquote></div>
          </div>    
        </div>










                </div>  <!-- row dlm 8 col-->



















            </div>  <!-- tutup 12 col -->



















          </div>













        </div></br>

        <input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">


      </div>

      <!-- Footer -->
      <div>
       <?php include_once("footer.php"); ?>
     </div>



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



  <script type="text/javascript">

      var usertype = '<?php echo $usertype_user; ?>';
      var background = '<?php echo $background; ?>';
      var position = '<?php echo $position; ?>';

       var simple = '<?php echo $fn_other; ?>';
           simple += '<?php echo $ln_other; ?>';

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
              editable: false
            })

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