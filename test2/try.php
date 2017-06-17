      
<?php
$servername = "localhost";
$username = "grezzejn";
$password = "kEb!wkP+wNs64x";
$dbname = "grezzejn_social_a";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Service_name, Service_category, Price, Service_description FROM service";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Service_name: " . $row["Service_name"]. " - Service_Category: " . $row["Service_category"]. " - Price: " . $row["Price"]. " - Service_description: " . $row["Service_description"] "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 