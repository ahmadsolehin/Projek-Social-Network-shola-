<?php
  
include_once("../php_includes/db_conx.php");

  
  if($_POST) 
  {
      $user1     = strip_tags($_POST['user1']);
      $user2     = strip_tags($_POST['user2']);


        $sql = "DELETE from friends WHERE user1 = '$user1' AND user2 = '$user2' ";

        mysqli_query($db_conx, $sql);


$sql = "INSERT INTO friends (user1, user2, status , datemade)
VALUES ('$user1', '$user2', 'unfollow', 'now()')";

if (mysqli_query($db_conx, $sql)) {
    echo "yes";
} else {
    echo "Error deleting record: " . mysqli_error($db_conx);
}
      
  }
?>