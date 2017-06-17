<?php

$connect = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_b");


if($_POST)
{
$q=$_POST['searchword'];
$sql_res=mysqli_query( $connect ,"select id,  user_type, avatar,first_name, last_name ,username from users where username like '%$q%' order by id LIMIT 50")or die(mysqli_error($connect));


             if(mysqli_num_rows($sql_res)>0){

              ?>



 <h6><span>USERS</span></h6>

              <?php


while($row=mysqli_fetch_array( $sql_res))
{

$userid=$row['id'];
$usertype=$row['user_type'];
    $username=$row['username'];
    $profile=$row['avatar'];
    $fn=$row['first_name'];
    $ln=$row['last_name'];


    if ($usertype == "Service Provider") {
      ?>

      <a style = "color:black; text-decoration: none;" href="userprofile_view.php?u=<?php echo $username;?>&id=<?php echo $userid;?>"> 
        <div class="display_box" align="left">
          <img src="<?php echo $profile; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name" id = "displayName"><?php echo $username; ?></span> &nbsp;<br/>
        </div>
      </a>

      <?php
    }else if ($usertype == "Service Seeker") {
      ?>

<a style = "color:black; text-decoration: none;" href="Service_seeker_view.php?u=<?php echo $username;?>&id=<?php echo $userid;?>"> 
        <div class="display_box" align="left">
          <img src="<?php echo $profile; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name" id = "displayName"><?php echo $username; ?></span> &nbsp;<br/>
        </div>
      </a>

      <?php
    }else if ($usertype == "Company") {
      ?>

      <a style = "color:black; text-decoration: none;" href="Company_profile_view.php?u=<?php echo $username;?>&id=<?php echo $userid;?>"> 
        <div class="display_box" align="left">
          <img src="<?php echo $profile; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name" id = "displayName"><?php echo $username; ?></span> &nbsp;<br/>
        </div>
      </a>

      <?php
    }


    ?>


    <?php
  }

}

  ?>
 


<style type="text/css">
  
  h6 { width:100%; text-align:center; border-bottom: 1px solid  #ffffff; line-height:0.1em; margin:10px 0 20px; } 
h6 span { background:#fff; padding:0 10px; }

</style>

<?php

  $sql=mysqli_query( $connect ,"select * from service where Service_name like '%$q%' GROUP BY Service_name")or die(mysqli_error($connect));

             if(mysqli_num_rows($sql)>0){

?>

 <h6><span>SERVICE</span></h6>

<?php

while($row=mysqli_fetch_array( $sql))
{
  $userid=$row['Service_name'];
  $Service_pic=$row['Service_pic'];
        $Service_id = $row['Service_id'];

  ?>

        <a style = "color:black; text-decoration: none;" href="service_display.php?u=<?php echo urlencode($userid);?>"> 
        <div class="display_box" align="left">
          <img src="<?php echo $Service_pic; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name" id = "displayName"><?php echo $userid; ?></span> &nbsp;<br/>
        </div>
      </a>

      <?php
}


}

}
?>