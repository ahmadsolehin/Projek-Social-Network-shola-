<?php
if(isset($_POST["ukkoid"])){
	// CONNECT TO THE DATABASE
	include_once("db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$id = preg_replace('#[^a-z0-9]#i', '', $_POST['ukkoid']);
	$ref = preg_replace('#[^a-z0-9]#i', '', $_POST['ukkoref']);
    
    if($id == "" || $ref == "" ){
		header("Location: ../ukkodetails.php");
        exit();
	}
    
    $sql = "INSERT INTO eezy (	eezy_id, email, date)       
		        VALUES('$id','$ref',now())";
		$query = mysqli_query($db_conx, $sql); 
		 header("Location: ../login.php");
}

?>