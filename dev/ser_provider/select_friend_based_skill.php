<?php

include_once("../php_includes/db_conx.php");

if($_POST) 
{

  $data = strip_tags($_POST['data']);

  $query = "SELECT * FROM skills WHERE skill_service_provider = '$data' ";

  $result = mysqli_query($db_conx, $query);

  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  header('Content-type: application/json');
  echo json_encode($rows);

}
?>