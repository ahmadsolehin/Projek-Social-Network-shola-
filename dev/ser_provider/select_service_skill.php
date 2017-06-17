<?php

include_once("../php_includes/db_conx.php");

if($_POST) 
{

  $data = strip_tags($_POST['data']);

  $query = "SELECT * FROM service_skill WHERE main_category = '$data' ";

  $result = mysqli_query($db_conx, $query);

  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  header('Content-type: application/json');
  echo json_encode($rows);

}
?>