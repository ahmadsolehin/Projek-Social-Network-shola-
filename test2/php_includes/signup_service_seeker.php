<?php
$link = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_a");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Choose database
//$db_select = mysqli_select_db($link, Grezzli_test);
//if (!$db_select) {
    //die("Database selection failed: " . mysqli_error());
//}
    
    $first_name = mysqli_real_escape_string($link, $_POST['InputFName']);	
    $last_name = mysqli_real_escape_string($link,$_POST['InputLName']);	
    $username = mysqli_real_escape_string($link, $_POST['username']);	
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $sex = mysqli_real_escape_string($link, $_POST['Gender']);
    $country = mysqli_real_escape_string($link, $_POST['Country']);
    $city = mysqli_real_escape_string($link, $_POST['City']);
    $security_question = mysqli_real_escape_string($link, $_POST['Security']);
    $answer_security_question = mysqli_real_escape_string($link, $_POST['Answer']);
    $email = mysqli_real_escape_string($link, $_POST['InputEmail']);
    $user = "Service Seeker";
    $folder_name= $_POST['InputFName'].$_POST['InputLName'];
    //$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
    
    // DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	//$sql = "SELECT id FROM users WHERE username='$email_address' LIMIT 1";
   // $query = mysqli_query($db_conx, $sql); 
	//$u_check = mysqli_num_rows($query);
   // if (u_check > 0){
      //  echo "That email address is already in use in the system";
        //exit();
   // }
    // Begin Insertion of data into the database
		
		//$cryptpass = crypt($password);
		$pass_hash = md5($password);
    
		
		// Add user info into the database table for the main site table
		
        $sql = "INSERT INTO users (user_type, first_name, last_name, username, email, password, gender, country, city, signup, lastlogin, notescheck, security_question, security_answer)   VALUES('$user','$first_name','$last_name','$username','$email','$pass_hash','$sex','$country','$city',now(),now(),now(),'$security_question','$answer_security_question')";
		
       		$query = mysqli_query($link,$sql); 
		$uid = mysqli_insert_id($link);
		// Establish their row in the useroptions table
		$sql = "INSERT INTO useroptions (id, username, background , profile) VALUES ('$uid','$username','original' , './img/noimage.jpg')";

		$query = mysqli_query($link, $sql);
		
		$sqlcv = "INSERT INTO cv (cv_id, username) VALUES ('$uid','$username')";
		$query = mysqli_query($link, $sqlcv);
		
		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
	if (!file_exists('/home/grezzejn/public_html/test2/user_seeker/'. $folder_name)) {
		mkdir('/home/grezzejn/public_html/test2/user_seeker/'. $folder_name, 0755);
		
		//mkdir(dirname(__FILE__)."/"."$username");
		}
    
    // Email the user their activation link
		$to = "$email";							 
		$from = "verify@grezzli.com";
		$subject = 'Grezzli Account Activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Grezzli Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.grezzli.com"><img src="http://test.grezzli.com/img/logo.png" width="36" height="30" alt="Grezzli" style="border:none; float:left;"></a>Grezzli Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$first_name.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://www.test2.grezzli.com/activation_service_seeker.php?id='.$uid.'&u='.$username.'&p='.$pass_hash.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$email.'</b></div></body></html>';
		$headers = "From: $from\n";
      		$headers .= "MIME-Version: 1.0\n";
     		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers);

    
   //echo "Insertion successful"; 
 header("Location: ../reg_success.php");
     
// close connection
mysqli_close($link);


?>