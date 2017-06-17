<?php
include_once("php_includes/check_login_status.php");
	   //Start your session
   	session_start();
	if(!isset($_SESSION['username']))
	{
	header("Location: index.php");
	}

      $fn =  $_SESSION['fname'];
      $ln = $_SESSION['lname'];
      $u = $_SESSION['username'];
      
	
     
      $query="SELECT * FROM cv WHERE username='$u' ";
      

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> Grezzli</title>
</head>

<body>
About me <br>

<?php   $user_query = mysqli_query($db_conx, $query);
      while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
?>
Company name: <?php echo $row["Compnay_name"]; ?>  <br>
Position : <?php echo $row["Company_position"]; ?> <br>

<?php $work_details = $row["Work_details"];
$work_details = str_replace("\n", "<br/>", $work_details);
?>
Work details: <?php echo $work_details; ?> <br>
Start_Day: <?php echo $row["Work_start_date"]; ?> <br>
End_Day: <?php echo $row["Work_end_date"]; ?> <br>
 <?php } ?>

</body>

</html>

