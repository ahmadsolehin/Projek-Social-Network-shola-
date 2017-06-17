<?php
if(isset($_POST["bank_id"])){
	// CONNECT TO THE DATABASE
	include_once("db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$bid = preg_replace('#[^a-z0-9]#i', '', $_POST['bank_id']);
	$tax= preg_replace('#[^a-z0-9]#i', '', $_POST['taxcard']);
	$ssn= preg_replace('#[^a-z0-9]#i', '', $_POST['ssn_number']);
    
    if($bid == "" || $tax == "" || $ssn == ""  ){
		header("Location: ../bankdetails.php");
        exit();
	}
    
    $sql = "INSERT INTO validate_user (	bank_id, taxcard_no, social_security, date)       
		        VALUES('$bid','$tax', '$ssn',now())";
		$query = mysqli_query($db_conx, $sql); 
		 header("Location: ../login.php");
}

?>