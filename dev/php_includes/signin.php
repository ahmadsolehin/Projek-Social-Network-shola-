<?php
include_once("check_login_status.php");
// If user is already logged in, header that weenis away
if($user_ok == true){
	header("location: userprofile.php?u=".$_SESSION["fname"].$_SESSION["lname"]);
    exit();
}
?><?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["username"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$e = mysqli_real_escape_string($db_conx, $_POST['username']);
	$p = md5($_POST['password']);
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($e == "" || $p == ""){
		
		header("location: ../login.php?msg=Login Failed");
		
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT id, user_type, first_name, last_name, username, password, company_name , avatar FROM users WHERE username='$e' AND activated='1' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
        	$db_id = $row[0];
        	$db_user_type = $row[1];
        	$db_fname = $row[2];
        	$db_lname = $row[3];
		$db_username = $row[4];
        	$db_pass_str = $row[5];
        	$db_company_name = $row[6];
        	$avatar = $row[7];
		if($p != $db_pass_str){
			//echo "login_failed";
			header("location: ../login.php?msg=Login Failed");
            exit();
		} else {
			//CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $db_id;
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_pass_str;
			$_SESSION['fname'] = $db_fname;
			$_SESSION['lname'] = $db_lname;
			$_SESSION['user_type'] = $db_user_type;
			$_SESSION['comapny_name'] = $db_company_name;
			$_SESSION['avatar'] = $avatar;
			setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
    		setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE); 
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
            $query = mysqli_query($db_conx, $sql);   
            
            if ($db_user_type == "Company"){
            header("location: ../companyprofile.php?u=".$_SESSION['comapny_name']);
            } else if ($db_user_type == "Service Seeker"){
            header("location: ../service_seeker_profile.php?u=".$_SESSION["fname"].$_SESSION["lname"]);
            }else {
            header("location: ../userprofile.php?u=".$_SESSION["fname"].$_SESSION["lname"]);
            }
            
		    exit();
		}
	}
	exit();
}
?>