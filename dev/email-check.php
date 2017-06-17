<?php
  
include_once("php_includes/db_conx.php");

  
  if($_POST) 
  {
      $name     = strip_tags($_POST['name']);



$query = "SELECT email FROM users WHERE email = '$name' LIMIT 1";

$result = mysqli_query($db_conx, $query);

if (mysqli_num_rows($result) != 0)
{
//results found
        echo "not";

} else {
// results not found
        echo "available";

}

      
  }
?>