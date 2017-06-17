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



$summary="";
$city = "";  
$cn = "";
$cw = ""; 
$cm = "";

$sql="SELECT  City FROM cv WHERE username='$u' LIMIT 1";
$query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

  $city = $row["City"];
  
}


$sql="SELECT company_name, company_mission, company_website FROM users WHERE username='$u' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {

  $cn = $row["company_name"];
  $cw = $row["company_website"]; 
  $cm = $row["company_mission"];
  
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



$computer="SELECT * FROM company WHERE username='$u' ORDER BY id LIMIT 1 ";
$comp = mysqli_query($db_conx, $computer);

$imageku ="SELECT product_pic FROM company WHERE username='$u' ";
$product_image = mysqli_query($db_conx, $imageku);






  $company_post="SELECT * FROM company_post WHERE username='$u' ORDER BY RAND() LIMIT 2";
      $post_company = mysqli_query($db_conx, $company_post);
      


?>

<?php


if(isset($_POST['action']) && $_POST['action'] != ''){
  switch ($_POST['action']) {
    case 'post':
    submitWallPost($_POST);
    break;

    case 'comment':
    submitPostComment($_POST);
    break;

    case 'postsaja':
    submitWallPostSaja($_POST);
    break;

    default:
    return false;
    break;
  }
}



$summary="";
$university="";
$company ="";
$certificate="";

$sql="SELECT About_me,University_name,Compnay_name,Certificate_Name FROM cv WHERE username='$u' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
  $summary = $row["About_me"];
  $university = $row["University_name"];
  $company = $row["Compnay_name"];
  $certificate = $row["Certificate_Name"];
  
}


function getWallPost(){
  $db_conx = mysqli_connect("localhost", "grezzejn", "p5f7~1A4h4#c", "grezzejn_social_b");

  $user_id = $_SESSION['userid'];

  $wall_query = mysqli_query($db_conx, "SELECT p.*,u.first_name as username, pl.like_id from fb_post p left join users u on u.id = p.user_id left join fb_post_likes pl on pl.post_id = p.post_id and pl.user_id = '$user_id'  where p.user_id = '$user_id' group by p.post_id order by post_id desc");

  $postInfo = array();

  
  while($row = mysqli_fetch_assoc($wall_query)){
    $postInfo[] = $row;
  }

  return $postInfo;
}


function getPostComments($post_id){
  $db_conx = mysqli_connect("localhost", "grezzejn", "p5f7~1A4h4#c", "grezzejn_social_b");

  $comment_query = mysqli_query($db_conx, "SELECT c.*,u.first_name as username from fb_comment c left join users u on u.id = c.user_id where c.post_id = '$post_id' order by c.comment_id desc");
  $commentInfo = array();
  while($row = mysqli_fetch_assoc($comment_query)){
    $commentInfo[] = $row;
  }
  return $commentInfo;
}


function submitPostComment($Data){

  $db_conx = mysqli_connect("localhost", "grezzejn", "p5f7~1A4h4#c", "grezzejn_social_b");

  $user_id = $Data['userid'];
  $post_id = $Data['post_id'];
  $comment = $Data['comment'];
  $date_created = date("Y-m-d H:i:s");

  $result = mysqli_query($db_conx, "INSERT into fb_comment(post_id,user_id,comment,comment_date) values('$post_id','$user_id','$comment','$date_created')");

  if($result){
    $Return = array();
    $Return['ResponseCode'] = 200;
    $Return['Message'] = "comment submitted successfully.";
  }else{
    $Return = array();
    $Return['ResponseCode'] = 511;
    $Return['Message'] = "Error : Please try again!";
  }

  echo json_encode($Return);
}


function submitWallPostSaja($Data){

  $db_conx = mysqli_connect("localhost", "grezzejn", "p5f7~1A4h4#c", "grezzejn_social_b");

  $user_id = $Data['userid'];
  $content = $Data['post_feed'];
  $imageUser = $Data['image'];
  $date_created = date("Y-m-d H:i:s");

  $result = mysqli_query($db_conx, "INSERT into fb_post(user_id,content,total_like,date_created,image,imagePost,videoPost) values('$user_id','$content',0,'$date_created','$imageUser',  '' ,'')");

  if($result){
    $Return = array();
    $Return['ResponseCode'] = 200;
    $Return['Message'] = "post updated successfully.";

  }else{
    $Return = array();
    $Return['ResponseCode'] = 511;
    $Return['Message'] = "Error : Please try again!";
  }

  echo json_encode($Return);

}



$postdata = getWallPost();
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

           <!-- <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt=""> -->
              <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
              <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
            </a>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-4">
            <a href="#" class="" data-toggle="">

              <!--<img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt="">-->
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
              <input type = "hidden" name = "name" value = "<?php echo $c; ?>">
              <input type = "hidden" name = "usertype" value = "<?php echo $usertype; ?>">
            </div>
          </div>
        </form>

        <p style="text-align:center"><?php echo $c; ?></p>

      </div>
      
       <div class="col-md-2 col-sm-2 col-xs-2">
        
                        <div class="dropdown" >
    <button class=" btn btn-primary"  type="button" id="menu1" data-toggle="dropdown">Settings
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="z-index:258">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="company_edit_info.php">Edit Info</a></li>
       <li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="company_edith_pass.php">Change Password</a></li>
      <li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="company_insert_post.php">Add Post</a></li>
    </ul>
  </div>
        
        </div> 



        <div class="col-md-2 col-sm-2 col-xs-2">
          <a href="feedback.php">
          <button   class="btn btn-primary btn-block">Feedback</button></a> 
          </div></br>


        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-4 "></div>
          <div class="col-md-3 col-sm-4 col-xs-4 ">
            <!--<h4>Jari Peter</h4>-->
          </div>

        </div></br>

        <div class="row">
          <!--  service container-->


          <?php
          while ($row = mysqli_fetch_array($comp, MYSQLI_ASSOC)) {
            $about = $row["about"];
            $loc = $row["location"];
            $web = $row["website"];
            $facebook= $row["facebook"];
          }
          ?>



          <div class="col-md-12 col-sm-12 col-xs-12">








                <!-- content -->
                <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-8">



                    <div class="panel panel-default">
                      <div class="panel-body">



                       <h4 class="sub"><a  style="text-decoration:none;" href="#">About us</a> </h4> 
                       <p><?php echo nl2br($about); ?></p>
                       <hr>

                                              <h4 class="sub"><a  style="text-decoration:none;" href="#">Website</a> </h4> 
                                              <a href="<?php echo $web; ?>" target = "_blank" class = "<?php echo $web; ?>" style="color: black;"><?php echo nl2br($web); ?></a>
                       <hr>

                       <h4 class="sub"><a  style="text-decoration:none;" href="#">Company Location</a> </h4>
                       <div class="row">
                        <div class="col-md-9">
                          <p><?php echo  nl2br($loc); ?></p>
                        </div>
                      </div>



                      <hr>
                      <h4 class="sub"><a  style="text-decoration:none;" href="#"> Company Product </a></h4>

                      <div class="rslides_container">
                        <ul class="rslides">

                          <?php  
                          while ($row = mysqli_fetch_array($product_image, MYSQLI_ASSOC)) {
                            $prod_pic = $row["product_pic"];
                            ?>

                            <?php

                            if ( $prod_pic != '') {
                              ?>

                                  <li><img src="<?php echo $prod_pic; ?>" alt=""></li>

                              <?php
                            }

                            ?>


                            <?php } ?>
                          </ul>
                        </div>  


















                      </div>
                    </div>
                  </div>

                  <!-- /col-9 --> 










  
  
                  <!--  advertisement and top services section-->
      <div class="col-md-4 col-sm-4 col-xs-4">


        <div class="row">


<div class="row">
            <div class="col-lg-12 text-center">
              <h5 class="section-heading">Company Post</h5> <br>
            <div><?php echo $facebook ; ?></div>
            </div>
          </div>


        <?php  
      while ($row = mysqli_fetch_array($post_company, MYSQLI_ASSOC)) {
      $id= $row["id"];
      $t= $row["title"];
      $i= $row["image"];
      $d = $row["description"];
      
      ?>


          


          <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">

              <div class="">

              <a  style="text-decoration:none;" href="company_display_post.php?id=<?php echo $id; ?> ">
                 <p class="text-muted"> <?php echo $t; ?> </p>
              </a>

              </div>
              <a href="company_display_post.php?id=<?php echo $id; ?>">

                <img src="<?php echo $i; ?>" class="img-responsive img-rounded"  width="304" height="236">
              </a>

            </div>

          </div>



                                 <?php } ?>

          <br>



        </div>



      </div>







                </div>














      <div class="col-md-6 col-sm-6 col-xs-6">


                <h4 class="sub"><a  style="text-decoration:none;" href="#"> Company Post </a></h4>




                <!-- Post Section -->
                <div class="row">
                  <!--  put photo box  and status summary here-->
                  <div class="middle_box">

                    <div class="clear"></div>
                    <div class="feed_div" id="feed_div">
                      <?php
                      if($postdata){
                        foreach($postdata as $post){
                          $comments = getPostComments($post['post_id']);
                          ?>
                          <div class="feed_box" id="postbox_<?php echo $post['post_id']; ?>">
                            <div class="feed_left">
                              <p><img class="userimg" src="<?php echo $post['avatar']; ?>"/></p>

                              <p><?php echo $post['username']; ?></p>
                            </div>
                            <div class="feed_right">
                              <p><?php echo $post['content']; ?></p>

                              <?php if(isset($post['imagePost']) && $post['imagePost'] != ""){ ?>
                              <?php } ?>

                              <?php if(isset($post['videoPost']) && $post['videoPost'] != ""){ ?>
                              <p>
                                <video width="250" height = "230" controls>
                                  <source src="http://localhost/testtestCopy/img/<?php echo $post['videoPost']; ?>">
                                  </video>
                                </p>
                                <?php } ?>

                                <p class="likebox">
                                  Total Like : <?php echo $post['total_like']; ?>&nbsp;|&nbsp;
                                  <?php if(isset($post['like_id']) && $post['like_id'] != ""){ ?>
                                  <a class="link_btn dis_like_btn" postid="<?php echo $post['post_id']; ?>" href="javascript:;">Dislike</a>&nbsp;|&nbsp;
                                  <?php }else{ ?>
                                  <a class="link_btn like_btn" postid="<?php echo $post['post_id']; ?>" href="javascript:;">Like</a>&nbsp;|&nbsp;
                                  <?php } ?>
                                  <a class="link_btn" href="javascript:;">Comment</a>
                                </p>                      
                                <div class="clear"></div>
                                <?php if($comments){ ?>
                                <div class="comment_div">
                                  <?php foreach($comments as $comment){ ?>
                                  <div class="clear"></div>
                                  <div class="comment_ele">
                                    <p><a class="link_btn" href="javascript:;"><?php echo $comment['username']; ?></a></p>
                                    <p><?php echo $comment['comment']; ?></p>
                                  </div>
                                  <?php } ?>
                                </div>
                                <?php } ?>
                                <div class="clear"></div>
                                <p>
                                  <form id="commentform_<?php echo $post['post_id']; ?>" method="post">
                                    <input type="hidden" name="action" value="comment"/>
                                    <input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
                                    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>"/>
                                    <input class="input comment_input" type="text" name="comment" id="comment_<?php echo $post['post_id']; ?>" placeholder="your comment" aria-describedby=""/>
                                    <input style="margin-left:8px" class="submitbtn btn btn-primary" postid="<?php echo $post['post_id']; ?>" type="button" name="sendbtn" value="Reply"/>
                                  </form>
                                </p>
                              </div>
                              <div class="clear"></div>
                            </div>

                            <br><br>
                            <?php
                          }
                        }
                        ?>

                      </div>
                    </div>
                    <div class="clear"></div>
                  </div>

                  </div>
















            </div>














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










  <script type='text/javascript'>
    $(document).ready(function(){

      $(".submitbtn").live("click",function(){

        var post_id = $(this).attr('postid');
        var comment = $("#comment_"+post_id).val();

        if(comment == ''){
          alert("comment can't be empty!");
          return false;
        }else{
          $.ajax({
            type: "POST",
            data: $('#commentform_'+post_id).serialize(),
            url: 'functions.php',
            dataType: 'json',
            success: function(response) {
              if(response.ResponseCode == 200){
                $('#postbox_'+post_id).load('companyprofile.php #postbox_'+post_id+' >*');
              }else{
                alert(response.Message);
              }
            }
          });
        }
      });


      $(".like_btn").live("click",function(){
        var post_id = $(this).attr('postid');        
        $.ajax({
          type: "POST",
          data: {
            'post_id':post_id,
            'user_id':<?php echo $userid; ?>,
            'action':'like'
          },
          url: 'functions.php',
          dataType: 'json',
          success: function(response) {
            if(response.ResponseCode == 200){
              $('#postbox_'+post_id).load('companyprofile.php #postbox_'+post_id+' >*');
            }else{
              alert(response.Message);
            }
          }
        }); 
      });

      $(".dis_like_btn").live("click",function(){
        var post_id = $(this).attr('postid');        
        $.ajax({
          type: "POST",
          data: {
            'post_id':post_id,
            'user_id':<?php echo $userid; ?>,
            'action':'dislike'
          },
          url: 'functions.php',
          dataType: 'json',
          success: function(response) {
            if(response.ResponseCode == 200){
              $('#postbox_'+post_id).load('companyprofile.php #postbox_'+post_id+' >*');
            }else{
              alert(response.Message);
            }
          }
        }); 
      });


      $("#btnpost").click(function(){
        var post = $("#post_feed").val();
        var userid = $("#useridlagi").val();
        var x = $("#image").val();

        $.ajax({
          type: "POST",
          data: {
            'post_feed':post,
            'image':x,
            'userid':userid,
            'action': 'postlah'
          },
          url: 'functions.php',
          dataType: 'json',
          success: function(response) {
            $('#post_feed').val("");

            if(response.ResponseCode == 200){

             $('#feed_div').load('companyprofile.php #feed_div');
           }else{
            alert(response.Message);
          }
        }
      }); 
      });




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

    $('#web_link').click(function(){

       var url = $('#web_link').attr("class");

       alert(url);

var avoid = "http://test2.grezzli.com/";

var abc=url.replace(avoid, '');

alert(abc);

       var redirectWindow = window.open(abc, '_blank');
    redirectWindow.location;
    })
   </script>