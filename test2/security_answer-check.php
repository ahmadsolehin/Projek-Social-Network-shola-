<?php
  
include_once("php_includes/db_conx.php");


  
  if($_POST) 
  {
      $name     = strip_tags($_POST['name']);
      $userid = strip_tags($_POST['userid']);



$query = "SELECT * FROM users WHERE security_answer = '$name' AND id= '$userid' LIMIT 1";

$result = mysqli_query($db_conx, $query);

if (mysqli_num_rows($result) != 0)
{
//results ade
        echo "ok";

} else {
// results xde
        echo "ko";

}

      
  }
?>