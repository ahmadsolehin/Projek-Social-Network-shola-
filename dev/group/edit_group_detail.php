<?php
  
include_once("../php_includes/db_conx.php");

  
  if($_POST) 
  {
      $id = strip_tags($_POST['id']);



$query = "SELECT * FROM special_group WHERE group_id = '$id' LIMIT 1";

$result = mysqli_query($db_conx, $query);


$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
header('Content-type: application/json');
echo json_encode($rows);
      
  }
?>