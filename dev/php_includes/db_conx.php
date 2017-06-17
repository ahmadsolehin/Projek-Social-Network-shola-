<?php
$db_conx = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_b");
// Check the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
} else {
	//echo "Successful database connection";
}
?>