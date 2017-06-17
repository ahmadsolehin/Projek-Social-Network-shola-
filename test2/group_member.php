    
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



$listing = "SELECT * FROM users ORDER BY id";
$array = mysqli_query($db_conx, $listing);


if (mysqli_num_rows($array) != 0)
{
//results found
 //       echo "not";

} else {
// results not found
  echo "<span>You have no friends in list</span>";

  ?>

  <script type="text/javascript">

    $('.table th').remove();

  </script>

  <?php

}


?>

<style type="text/css">
  
  .ayamas{
    cursor: pointer;
  }
</style>



        <div class="col-md-6 col-sm-6 col-xs-6">



<table class="table table-inbox table-hover">
  <tbody>

    <th></th>
    <th>Member List</th>

    <?php  
    while ($row = mysqli_fetch_array($array, MYSQLI_ASSOC)) {
      $id = $row["id"];
      $first = $row["first_name"];
      $last = $row["last_name"];
      $avatar = $row["avatar"];
      ?>



      <tr class="unread">
        <td  rel = "<?php echo $id; ?>" class="view-message "><img src="<?php echo $avatar; ?>" class="img-rounded" width="55" height="55"> </td>
        <td  rel = "<?php echo $id; ?>" class="view-message dont-show"><?php echo $first; ?> <?php echo $last; ?></td>
      </td>
    </tr>






       <?php } ?>



     </tbody>
   </table>


</div>