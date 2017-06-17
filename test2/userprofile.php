<?php

session_start();


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




// Check to see if the viewer is the account owner
$isOwner = "no";
if($u == $log_username && $user_ok == true){
  $isOwner = "yes";
}

$isFriend = false;
$ownerBlockViewer = false;
$viewerBlockOwner = false;
if($u != $log_username && $user_ok == true){
  $friend_check = "SELECT id FROM friends WHERE user1='$log_username' AND user2='$u' AND accepted='1' OR user1='$u' AND user2='$log_username' AND accepted='1' LIMIT 1";
  if(mysqli_num_rows(mysqli_query($db_conx, $friend_check)) > 0){
    $isFriend = true;
  }
  $block_check1 = "SELECT id FROM blockedusers WHERE blocker='$u' AND blockee='$log_username' LIMIT 1";
  if(mysqli_num_rows(mysqli_query($db_conx, $block_check1)) > 0){
    $ownerBlockViewer = true;
  }
  $block_check2 = "SELECT id FROM blockedusers WHERE blocker='$log_username' AND blockee='$u' LIMIT 1";
  if(mysqli_num_rows(mysqli_query($db_conx, $block_check2)) > 0){
    $viewerBlockOwner = true;
  }
} 


$friend_button = '<button disabled>Request As Friend</button>';
$block_button = '<button disabled>Block User</button>';
// LOGIC FOR FRIEND BUTTON
if($isFriend == true){
  $friend_button = '<button onclick="friendToggle(\'unfriend\',\''.$u.'\',\'friendBtn\')">Unfriend</button>';
} else if($user_ok == true && $u != $log_username && $ownerBlockViewer == false){
  $friend_button = '<button onclick="friendToggle(\'friend\',\''.$u.'\',\'friendBtn\')">Request As Friend</button>';
}
// LOGIC FOR BLOCK BUTTON
if($viewerBlockOwner == true){
  $block_button = '<button onclick="blockToggle(\'unblock\',\''.$u.'\',\'blockBtn\')">Unblock User</button>';
} else if($user_ok == true && $u != $log_username){
  $block_button = '<button onclick="blockToggle(\'block\',\''.$u.'\',\'blockBtn\')">Block User</button>';
}


$services="SELECT Service_name, Service_category, Price, Service_description, Service_pic FROM service WHERE Username='$u' ";
$service = mysqli_query($db_conx, $services);





function getWallPost(){
  $db_conx = mysqli_connect("localhost", "grezzejn", "p5f7~1A4h4#c", "grezzejn_social_a");

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

        
        
                    
                    <div class="dropdown" >
    <button class=" btn btn-primary"  type="button" id="menu1" data-toggle="dropdown">Settings
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="z-index:258">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="userinfor_edit_password.php">Change Password</a></li>
       <li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="val.php">Validate Account</a></li>
       
      
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
        <a  class="page-scroll"  href="#post">
          <!-- <button id="post_show" style="font-size:1vmax" class="btn btn-primary" type="submit">See Posts</button> -->
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




 <!--<p> <span id="friendBtn"><?php echo $friend_button; ?></span> </p> 
 <p>  <span id="blockBtn"><?php echo $block_button; ?></span> </p> -->
 


 <div class="row">
  <!--  service container-->
  <!-- Info about  user  -->
  <div class="col-md-3 col-sm-3 col-xs-3">

    <div class="row">

      <div class="col-md-6 col-sm-8 col-xs-8 ">
        <a href="user_cv_new.php">
          <button   class="btn btn-primary btn-block"> Show CV</button></a>
        </div>
        <div class="col-md-6 col-sm-4 col-xs-4 ">
          <a href="add_service.php">
          <button   class="btn btn-primary btn-block">Add Service</button></a>
          </div>
        </div></br>
        <ul class="list-unstyled">
          <li><b>About Me</b> <br>
            <?php echo $summary; ?>



          </li><hr>

          <li><b>Education</b>
            <ul >

              <?php
              while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

                $university = $row["university_name"];
                $University_level = $row["university_level"];
                $University_study_field = $row["university_study_field"];
                $University_major_course = $row["university_major_course"];
                $University_start_date = $row["university_start_date"];
                $University_end_date = $row["university_end_date"];
                ?>

                <li><?php echo $university; ?></li>

                <?php    } ?>

              </ul>
            </li><hr>

            <li><b>Companies</b>
              <ul class="list-unstyled">
                <ul>
                  <?php

                  while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

                    $company_name = $row["compnay_name"];
                    $company_position = $row["company_position"];
                    $work_details = $row["work_details"];
                    $work_start_date = $row["work_start_date"];
                    $work_end_date = $row["work_end_date"];

                    ?>
                    <li><?php echo $company_name; ?></li>
                    <?php } ?>
                  </ul>
                </ul>
              </li> <hr>
              <li><b>Certificate</b>
                <ul class="list-unstyled">
                  <ul>
                    <?php 
                    while ($row = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {

                      $certificate_name = $row["certificate_Name"];
                      $certificate_authority = $row["certificate_Authority"];
                      $certificate_des = $row["certificate_desc"];
                      $certificate_start_date = $row["certificate_start_date"];
                      $certificate_end_date = $row["certificate_end_date"];
                      ?>

                      <li><?php echo $certificate_name; ?></li>

                      <?php } ?>
                    </ul>

                  </ul>
                </li>
              </ul>

              <div class="col-md-6 col-sm-8 col-xs-8 ">
               <!--  <a href="userinfor_edit.php">
                  <button   class="btn btn-primary btn-block"> Edit</button></a> -->
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class "row">
                  <p>I provide following services....</p>
                </div>

                <div class="row">



                  <?php  
                  while ($row = mysqli_fetch_array($service, MYSQLI_ASSOC)) {
                    $sn= $row["Service_name"];
                    $sc= $row["Service_category"];
                    $p= $row["Price"];
                    $sd= $row["Service_description"];
                    $Service_pic = $row["Service_pic"];


                    ?>

                    <div class="col-md-6 col-sm-6 col-xs-6">

                      <div class="panel panel-default">          
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                              <img src="img/user_rating.png" class="img-responsive" alt="">
                            </div>

                            <div class = "row">
                              <div class="col-md-6 col-sm-8 col-xs-8 ">
                                <p><?php echo $sn; ?></p>
                              </div>
                            </div>

                          </div>

                        </div>
                        <div class="panel-body">
                          <a href=" ">
                            <img src="<?php echo $Service_pic; ?>" class="img-responsive" alt="">
                          </a>
                        </div>

                        <div class="panel-footer">
                          <a style="color:black" href=" ">
                            <div class="row">
                              <div class="col-md-8 col-sm-8 col-xs-8">
                                <p> <?php echo $sc; ?></p>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                <p><?php echo $p; ?><i class="glyphicon glyphicon-eur"></i></p>
                              </div>
                            </div>
                          </a>

                        </div>
                      </div>
                    </div>
                    <?php } ?>




                  </div>
                  <!-- Add Service Button -->
                  <div class="row">
                    <div class="col-md-8 col-sm-4 col-xs-4"></div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <!-- <a href="add_service.php">
                        <button  class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-plus"></i> Add Service</button>
                      </a> -->
                    </div>
                  </div>



                  <style type="text/css">

                    hr.style-five {
                      height: 12px;
                      border: 0;
                      box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
                    }

                  </style>


                  <br>
                  <br>


                  <div class="row">

                    <section id="post">



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

                    </section>






                  </div>
                  <!--  advertisement and top services section-->
                  <div  class="col-md-3 col-sm-3 col-xs-3">


                    <div class="row">
                      <div class="row">
                        <div class="col-lg-12 text-center">
                         <h4 class="section-heading">Profile Completion <br>20%</h4> <br><br>
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
              $('#postbox_'+post_id).load('userprofile.php #postbox_'+post_id+' >*');
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
            $('#postbox_'+post_id).load('userprofile.php #postbox_'+post_id+' >*');
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
            $('#postbox_'+post_id).load('userprofile.php #postbox_'+post_id+' >*');
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

           $('#feed_div').load('userprofile.php #feed_div');
         }else{
          alert(response.Message);
        }
      }
    }); 
    });




  });
</script>