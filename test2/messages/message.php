<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if($msg == "activation_failure"){
	$message = '<h2>Activation Error</h2> Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.';
} else if($msg == "activation_success"){
	$message = '<h2>Activation Success</h2> Your account is now Activated. <a href="login.php">Click here to log in</a>';
	
} else if($msg == "activated"){
	$message = '<h2>Account Already Activated</h2> Sorry Your account is already Activated. <a href="index.php">Click here to log in</a>';

} else {
	$message = $msg;
}
?>
<div><?php echo $message; ?></div>