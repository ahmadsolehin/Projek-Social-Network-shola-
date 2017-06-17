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
       $usertype = $_SESSION['user_type'];
      $userid = $_SESSION['userid'];

      
      $about = "";
      $summary="";
      $city = "";  
    $cn = "";
    $cw = ""; 
    $cm = "";

    $sql="SELECT Address , About_me FROM cv WHERE username='$u' LIMIT 1";
      $query = mysqli_query($db_conx, $sql);
      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    
    $city = $row["Address"];
    $about = $row["About_me"];
  
  }

     
      $sql="SELECT  company_name, company_mission, company_website FROM users WHERE username='$u' LIMIT 1";
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
$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");

     $user_id = $_SESSION['userid'];

    $wall_query = mysqli_query($db_conx, "SELECT p.*,u.first_name as username, pl.like_id from fb_post p left join users u on u.id = p.user_id left join fb_post_likes pl on pl.post_id = p.post_id and pl.user_id = '$user_id'  where p.user_id = '$user_id' group by p.post_id order by post_id desc");

        $postInfo = array();

  
        while($row = mysqli_fetch_assoc($wall_query)){
            $postInfo[] = $row;
        }

    return $postInfo;
}




function getPostComments($post_id){
$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");

    $comment_query = mysqli_query($db_conx, "SELECT c.*,u.first_name as username from fb_comment c left join users u on u.id = c.user_id where c.post_id = '$post_id' order by c.comment_id desc");
    $commentInfo = array();
    while($row = mysqli_fetch_assoc($comment_query)){
        $commentInfo[] = $row;
    }
    return $commentInfo;
}


function submitPostComment($Data){

$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");

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

$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");

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

<?php include_once ("headerlogin.php"); ?>

  <link rel="stylesheet" href="style.css">


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



</head>

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
      
      <div class="dropdown" >
    <button class=" btn btn-primary"  type="button" id="menu1" data-toggle="dropdown">Settings
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="z-index:258">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="userinfor_edit_password.php">Change Password</a></li>
       <li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="val.php">Validate Account</a></li>
       
      
    </ul>
  </div>
      
      
        <a href="#" class="" data-toggle="">

          <img src="img/user_rating.png" class="img-responsive" alt="">
          <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
          <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
        </a>
      </div>

     <!--  <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-envelope"></i> </button>
        </a>

      </div>
      <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-plus"></i><i style="color:green" class="glyphicon glyphicon-user"></i></button>
        </a>
        
      </div> -->


    </div></br>
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4 "></div>
      <div class="col-md-3 col-sm-4 col-xs-4 ">
        <!--<h4>Jari Peter</h4>-->
      </div>

    </div></br>

    <div class="row">
      <!--  service container-->
      <!-- Info about  user  -->
    <div class="col-md-3 col-sm-3 col-xs-3">
    
         <div class="col-md-6 col-sm-8 col-xs-8  ">
          <a href="service_seeker_edith.php">
        <button   class="btn btn-primary btn-block"> Edit</button></a> 
        </div> <br><br><br>

      <ul class="list-unstyled">
    <li><B>About Me</B> <br>
        
        <?php echo  $about; ?> </li><br>
    
  
    

    <li><b>Location</b>
<ul class="list-unstyled">
    <ul>
<li><?php echo $city; ?></li>
        </ul>

</ul>
    </li>
    

    </ul>
    </div>




    <style type="text/css">
  
  hr.style-five {
    height: 12px;
    border: 0;
    box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
}

</style>




      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class "row">
             <!-- Post Section -->

        <!--  <section id="post"> -->
            <!--  post 1-->
            <div class="row">
                <!--  put photo box  and status summary here-->
                    <div class="wrapper">
          <div class="middle_box">

           <hr class="style-five">
<br>

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


          <!--</section>-->

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
              $('#postbox_'+post_id).load('service_seeker_profile.php #postbox_'+post_id+' >*');
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
            $('#postbox_'+post_id).load('service_seeker_profile.php #postbox_'+post_id+' >*');
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
            $('#postbox_'+post_id).load('service_seeker_profile.php #postbox_'+post_id+' >*');
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

                         $('#feed_div').load('service_seeker_profile.php #feed_div');
          }else{
            alert(response.Message);
          }
        }
      }); 
    });




  });
</script>