<?php


if(isset($_POST['action']) && $_POST['action'] != ''){
    switch ($_POST['action']) {
        case 'post':
            submitWallPost($_POST);
            break;

        case 'like':
            submitPostLike($_POST);
            break;

        case 'dislike':
            submitPostDisLike($_POST);
            break;

        case 'comment':
            submitPostComment($_POST);
            break;

        case 'videoOnly':
            submitWallVideoOnlyPost($_POST);
            break;
        
        case 'photoOnly':
            submitWallPhotoOnlyPost($_POST);
            break;

        case 'postlah':
            submitWallPostSaja($_POST);
            break;

        default:
            return false;
            break;
    }
}

function submitPostLike($Data){

$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");

    $user_id = $Data['user_id'];
    $post_id = $Data['post_id'];
    $date_created = date("Y-m-d H:i:s");

    $result = mysqli_query($db_conx, "INSERT into fb_post_likes(post_id,user_id,like_date) values('$post_id','$user_id','$date_created')");

    if($result){
        mysqli_query($db_conx, "UPDATE fb_post set total_like = total_like + 1 where post_id = '$post_id'");
        $Return = array();
        $Return['ResponseCode'] = 200;
        $Return['Message'] = "like successfully.";
    }else{
        $Return = array();
        $Return['ResponseCode'] = 511;
        $Return['Message'] = "Error : Please try again!";
    }

    echo json_encode($Return);
}

function submitPostDisLike($Data){

$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");

    $user_id = $Data['user_id'];
    $post_id = $Data['post_id'];

    $result = mysqli_query($db_conx, "DELETE from fb_post_likes where user_id = '$user_id' and post_id = '$post_id'");

    if($result){
        mysqli_query($db_conx, "UPDATE fb_post set total_like = total_like - 1 where post_id = '$post_id'");
        $Return = array();
        $Return['ResponseCode'] = 200;
        $Return['Message'] = "dislike successfully.";
    }else{
        $Return = array();
        $Return['ResponseCode'] = 511;
        $Return['Message'] = "Error : Please try again!";
    }

    echo json_encode($Return);
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
function submitWallPost($Data){


    $user_id = $_SESSION['userid'];
    $content = $Data['post_feed'];
    $imageUser = $Data['imageUser'];
    $date_created = date("Y-m-d H:i:s");


            $dirname = $_FILES['photo']['name'];    //ni utk amek name img
            $ext = pathinfo($dirname, PATHINFO_EXTENSION); //amek .png, .jpg

            $uniqid = uniqid();
            $random = rand();
$path = $uniqid. '' .$random. '.'.$ext;  //ni utk letak path dlm db
move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/'.$uniqid.''.$random. '.'.$ext);

            $dirnameVideo = $_FILES['photo']['name'];    //ni utk amek name img
            $extVideo = pathinfo($dirnameVideo, PATHINFO_EXTENSION); //amek .png, .jpg

            $uniqidVideo = uniqid();
            $randomVideo = rand();
$pathVideo = $uniqidVideo. '' .$randomVideo. '.'.$extVideo;  //ni utk letak path dlm db
move_uploaded_file($_FILES['video']['tmp_name'], 'upload/'.$uniqidVideo.''.$randomVideo. '.'.$extVideo);

$result = mysql_query("INSERT into fb_post(user_id,content,total_like,date_created,image,imagePost,videoPost) values('$user_id','$content',0,'$date_created','$imageUser',  '$path' ,'$pathVideo')");

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


function submitWallVideoOnlyPost($Data){

    if($_FILES['video']['size'] > 0){

        $user_id = $_SESSION['userid'];
        $content = $Data['post_feed'];
        $imageUser = $Data['imageUser'];
        $date_created = date("Y-m-d H:i:s");


            $dirname = $_FILES['video']['name'];    //ni utk amek name img
            $ext = pathinfo($dirname, PATHINFO_EXTENSION); //amek .png, .jpg

            $uniqid = uniqid();
            $random = rand();
$path = $uniqid. '' .$random. '.'.$ext;  //ni utk letak path dlm db
move_uploaded_file($_FILES['video']['tmp_name'], 'upload/'.$uniqid.''.$random. '.'.$ext);

$result = mysql_query("INSERT into fb_post(user_id,content,total_like,date_created,image,imagePost,videoPost) values('$user_id','$content',0,'$date_created','$imageUser',  '' ,'$path')");

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



}


function submitWallPhotoOnlyPost($Data){

    if($_FILES['photo']['size'] > 0){

        $user_id = $_SESSION['userid'];
        $content = $Data['post_feed'];
        $imageUser = $Data['imageUser'];
        $date_created = date("Y-m-d H:i:s");


            $dirname = $_FILES['photo']['name'];    //ni utk amek name img
            $ext = pathinfo($dirname, PATHINFO_EXTENSION); //amek .png, .jpg

            $uniqid = uniqid();
            $random = rand();
$path = $uniqid. '' .$random. '.'.$ext;  //ni utk letak path dlm db
move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/'.$uniqid.''.$random. '.'.$ext);

$result = mysql_query("INSERT into fb_post(user_id,content,total_like,date_created,image,imagePost,videoPost) values('$user_id','$content',0,'$date_created','$imageUser',  '$path' , '')");

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



}


function submitWallPostSaja($Data){

$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");
      $string = $Data['post_feed'];

      $content = nl2br($string);
      
            $userid = $Data['userid'];
            $x = $Data['image'];
    $date_created = date("Y-m-d H:i:s");


$result = mysqli_query($db_conx, "INSERT into fb_post(post_id,user_id,content,total_like,date_created,avatar,imagePost,videoPost) values('','$userid','$content',0,'$date_created','$x',  '' ,'')");

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


function getUserDetails($user_id){
    $user_query = mysql_query("select * from fb_users where user_id = '".$user_id."'");
    $userInfo = mysql_fetch_assoc($user_query);

    return $userInfo;
}

?>