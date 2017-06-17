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




function getWallPost(){
  $db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");

  $user_id = $_SESSION['userid'];
  $wall_query = mysqli_query($db_conx, "SELECT p.*,u.first_name as username, pl.like_id from fb_post p left join users u on u.id = p.user_id left join fb_post_likes pl on pl.post_id = p.post_id and pl.user_id = '$user_id' group by p.post_id order by post_id desc");

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
<!DOCTYPE html>
<html lang="en">



<!-- Include jQuery library -->

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

  


  <div id = "container">
    <div class = "row">




      <div class="col-md-2 col-sm-2 col-xs-2">
      </div>



      <div class="col-md-6 col-sm-6 col-xs-6">


        <!--  updat status section-->
        <div class="row">

          <div class="col-md-2">
            <img alt="image" src="<?php echo $profile; ?>" class="img-responsive ">
            <!--  photo section-->
          </div>

          <div class="col-md-9">

            <form action="" method="post" role="form" enctype="multipart/form-data" id = "frmpost" class="facebook-share-box">
             
             <input name = "userImage" type="hidden" id="image" value="<?php echo $profile; ?>"/>
             <input type="hidden" id="useridlagi" value="<?php echo $userid; ?>"/>

             <div class="share">

              <div class="panel panel-default">
                <div class="panel-heading">

                  <ul class="post-types">
<!--                         <li class="post-type">
                          <a id = "upload_video" class="video" title="" href="#"><i  class="glyphicon glyphicon-facetime-video"></i> Add Video</a>
                        </li>
                        <li class="post-type">
                          <a id = "upload_link" class="photos" href="#"><i  class="glyphicon glyphicon-picture"></i> Add photos</a>
                        </li> -->
                      </ul>
                    </div>


                    <div class="panel-body">

                      <div class="">
                        <textarea name="post_feed" cols="40" rows="6" id="post_feed" class="form-control message" style="height: 62px;max-width:100%;" placeholder="What's on your mind ?"></textarea>
                      </div>
                      <br>

                    </div>

                    <div class="panel-footer">

                      <div class="row">

                        <div class="col-md-7">
                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <input style="height:35px;margin-left:70px"  id="btnpost" type="button" value="Post" class="btn btn-primary">
                          </div>
                        </div>

                      </div>

                    </div> <!-- panel footer-->

                  </div>  <!-- panel default-->

                </div>  <!-- share-->
              </form>

            </div>   <!-- col 10 -->
          </div>



        </br>



        <div class="wrapper">
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
                      <p><img class="" width = "230px" height = "230px" src="http://localhost/testtestCopy/img/<?php echo $post['imagePost']; ?>"/></p>
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
                            <input style="margin-left:20px" class="submitbtn btn btn-primary" postid="<?php echo $post['post_id']; ?>" type="button" name="sendbtn" value="Reply"/>
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

          <div class="clear"></div>

        </div>


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



      </div>
    </div>



    <footer class="footer-distributed">

      <div class="footer-left">

        <h3>
          <img width="180" height="60" class="img-responsive" src="img/logo.png" alt="">
        </a>
      </h3>

      <p class="footer-links">
        <a href="#">Home</a> &middot;
        <a href="#">Blog</a> &middot;
        <a href="#">About</a> &middot;
        <a href="#">Faq</a> &middot;
        <a href="contact_Form.php">Contact</a>
      </p>

      <p class="footer-company-name">Grezzli &copy; 2017</p>
    </div>

    <div class="footer-center">

      <div>
        <i class="fa fa-map-marker"></i>
        <p>
          <span>Skinnarilankatu</span> 53850 Lappeenranta, Finland</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+358417289202</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:contactus@grezzli.com">grezzli.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span></span>
          
        </p>

        <div class="footer-icons">

          <a href="https://www.facebook.com/grezzli.online/?fref=ts"><i class="fa fa-facebook"></i></a>
          <a href="https://www.instagram.com/grezzli_official/"><i class="fa fa fa-instagram"></i></a>
          

        </div>

      </div>

    </footer>



    </html>





    <script src="coverphoto/jquery.js"></script>
    <script src="coverphoto/jquery-ui.custom.min.js"></script>



    <!--   <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script> -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/agency.js"></script>


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
                  $('#postbox_'+post_id).load('newsfeed_version1.php #postbox_'+post_id+' >*');
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
                $('#postbox_'+post_id).load('newsfeed_version1.php #postbox_'+post_id+' >*');
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
                $('#postbox_'+post_id).load('newsfeed_version1.php #postbox_'+post_id+' >*');
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


          if(post == ''){
            alert("can't be empty!");
            return false;
          }else{
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

                 $('#feed_div').load('newsfeed_version1.php #feed_div');
               }else{
                alert(response.Message);
              }
            }
          }); 
          }


        });




      });
    </script>

