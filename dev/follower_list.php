    
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
$userid = $_SESSION['userid'];
$avatar = $_SESSION['avatar'];



$listing = "SELECT * FROM friends WHERE ( user1 = '$userid' OR user2 = '$userid' ) AND status = 'follow' ";
$array = mysqli_query($db_conx, $listing);


if (mysqli_num_rows($array) != 0)
{
//results found
 //       echo "not";

} else {
// results not found
  echo "<span>You have no follower in list</span>";

  ?>

  <script type="text/javascript">

    $('.table th').remove();

  </script>

  <?php

}


?>

<style type="text/css">
  
  .unread{
    cursor: pointer;
  }
</style>




<table class="table table-inbox table-hover">
  <tbody>

    <th></th>
    <th>Follower List</th>

    <?php  
    while ($row = mysqli_fetch_array($array, MYSQLI_ASSOC)) {
      $id = $row["id"];
      $user1_id = $row["user1"];
      $user2_id = $row["user2"];
      ?>




      <?php

      if ( $user1_id == $userid ) {
        
        ?>

          <?php


$details = "SELECT * FROM users WHERE id = '$user2_id' LIMIT 1";
$data = mysqli_query($db_conx, $details);
while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    $id_user = $row["id"];
  $first = $row["first_name"];
  $last = $row["last_name"];
  $avatar = $row["avatar"];
      $username = $row["username"];
       $usertype = $row["user_type"];

}


      ?>

      <tr class="unread" id="<?php echo $usertype; ?>">
        <td  rel = "<?php echo $id_user; ?>" id = "<?php echo $username; ?>"  class="view-message "><img src="<?php echo $avatar; ?>" class="img-rounded" width="55" height="55"> </td>
        <td  rel = "<?php echo $id_user; ?>" class="view-message dont-show"><?php echo $first; ?> <?php echo $last; ?></td>
      </td>
    </tr>


        <?php
      }else{

        ?>

            <?php


$details = "SELECT * FROM users WHERE id = '$user1_id' LIMIT 1";
$data = mysqli_query($db_conx, $details);
while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
      $id_user = $row["id"];
  $first = $row["first_name"];
  $last = $row["last_name"];
  $avatar = $row["avatar"];
      $username = $row["username"];
       $usertype = $row["user_type"];

}


      ?>

      <tr class="unread" id="<?php echo $usertype; ?>" >
        <td  rel = "<?php echo $id_user; ?>" id = "<?php echo $username; ?>" class="view-message "><img src="<?php echo $avatar; ?>" class="img-rounded" width="55" height="55"> </td>
        <td  rel = "<?php echo $id_user; ?>" class="view-message dont-show"><?php echo $first; ?> <?php echo $last; ?></td>

                  <td class="view-message  "><a style="color: black;" href="follower_block_user.php?id=<?php echo $id; ?>" class="delete-row"><span class="glyphicon glyphicon-remove"></span></a> </td>


    </tr>



        <?php

      }

      ?>



    





       <?php } ?>



     </tbody>
   </table>




<script>

$(document).ready(function(){
    $(".unread").click(function(){
      
      var type = this.id;
    var ids = $(this).find(".view-message").attr("rel");    
    var username = $(this).find(".view-message").attr("id");    

      if (type == 'Service Seeker') {
        window.location.href = "https://grezzli.com/Service_seeker_view.php?u="+username+"&id="+ids;
      }else if (type == 'Service Provider') {
                window.location.href = "https://grezzli.com/userprofile_view.php?u="+username+"&id="+ids;
      }else if (type == 'Company' ) {
                window.location.href = "https://grezzli.com/Company_profile_view.php?u="+username+"&id="+ids;
      }

    });
});
</script>