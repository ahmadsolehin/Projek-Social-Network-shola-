<?php
$link = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Choose database
$db_select = mysqli_select_db($link, grezzejn_startup);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error());
}


$name = mysqli_real_escape_string($link, $_POST['name']);	
$email = mysqli_real_escape_string($link, $_POST['email']);


//send email
$to = $_POST['email'];
	$subject = "Grezzli is Launching";
//$n = $_POST['name']);
$message = ' <!DOCTYPE html><html><head><meta charset="UTF-8"><title>Grezzli Message</title></head>
    Hello '.$name .',<br /> <br>
<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#ffffff">
	
                <table align="center" width="690px" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="width:690px!important">
                <tbody>
                	<tr>
                    	<td>
                			<table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                            <tbody>
                            	<tr>
                                    <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="padding:0;margin:0;font-size:0;line-height:0">
                                        <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        	<tr>
                                            	<td width="30"></td>
                                                <td align="center" bgcolor="#ffffff" style="padding:0;margin:0;font-size:0;line-height:0">
                                                    <a href="http://www.grezzli.com/" target="_blank"><img src="https://c1.staticflickr.com/3/2841/33889382875_057dfd9fc4_z.jpg" alt="Grezzli" ></a></td>
                                                <td width="30" ></td> 
                                            </tr>
                                       	</tbody>
                                        </table>
                                  	</td>
                    			</tr>
                                <tr>
                                   
                                    <td colspan="3" align="center">
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" background=" ">
                                        <tbody>
                                        	<tr>
                                            	<td colspan="3" height="60"></td></tr><tr><td width="25"></td>
                                                <td align="center">
                                                    <h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:25px;color:#AE5113;line-height:48px;font-weight:bold;margin:0;padding:0">WE ARE LAUNCHING</h1>
                                                </td>
                                                <td width="25"></td>
                                            </tr>
                                            <tr>
                                            	<td colspan="3" height="40"></td></tr><tr><td colspan="5" align="center">
                                                    <p style="color:#000000;font-size:14px;line-height:24px;font-weight:lighter;padding:0;margin:0"><b>Greetings from Grezzli Team. </b> <br>
                                                        We are launching our Services after 4 days on Tuesday 11th April 2017. <br> You are one of our earliest subscribers. <br> We want you to know that we will help you reach your goals. <br> 
                                                        
                                                        <hr> “Show your skills, develop yourself, and opportunities will come to you” <hr> <br>
                                            
                                                       <font color="#AE5113"><b> WIN PRIZES! </b> <br></font> 
                                            
                                            Invite your friends to subscribe to our website. <br>
                                            Send us the names of your friends that have subscribed and we will choose the person with the highest referals to be our winner.
                                            


                                                </p>
                                            
                                                    
                                                </td>
                                            </tr>
                                         
                                 	</tbody>
                                    </table>
                             	</td>
                   			</tr>
                            
                            <tr bgcolor="#ffffff">
                                <td width="30" bgcolor="#ffffff"></td>
                                <td>
                                  <table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    	<tr>
                                        	<td colspan="4" align="center">&nbsp;</td>
                                      	</tr>
                        
                                        
                                        <tr>
                                        	<td colspan="4" align="center"><font color="#AE5113"><h2 style="font-size:24px">Contact Us <br></h2></font>  <h3>  Grezzli <br></h3> Skinnarilankatu 34 <br>Lappeenranta, 53850, Finland <br>+358417289202 <br> contact@grezzli.com <br> <a href="www.grezzli.com"> www.grezzli.com</a> </td>
                                      	</tr>
                                        <tr>
                                        	<td colspan="4">&nbsp;</td>
                                      	</tr>
                             
                                        <tr>
                                            <td align="center" valign="top">
                                                	<span style="line-height:20px;font-size:10px"><a href="https://www.facebook.com/grezzlionline/?fref=nf" target="_blank"><img src="https://farm2.staticflickr.com/1569/26019542934_0e2c6f2823_t.jpg" alt="Facebook"></a>&nbsp;</span>
                                                <span style="line-height:20px;font-size:10px"><a href="https://www.instagram.com/grezzli_official/" target="_blank"><img src="https://farm2.staticflickr.com/1571/26600141286_6bfab56f40_t.jpg" alt="Instagram"></a>&nbsp;</span>
                                                   <!-- <span style="line-height:20px;font-size:10px"><a href=" " target="_blank"><img src="https://farm2.staticflickr.com/1639/26532236362_8b6edaed15_t.jpg" alt="twit"></a>&nbsp;</span>
                                                    <span style="line-height:20px;font-size:10px"><a href=" " target="_blank"><img src="https://farm2.staticflickr.com/1482/26532236322_e197e27ed1_t.jpg" alt="g"></a>&nbsp;</span> -->
      
                                                <br> <h3><p align="center">  </p></h3>
                                              	</td>
                                        	<td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>
                                      	</tr>
                                        
                                        <tr>
                                        	<td colspan="4">&nbsp;</td>
                                        </tr>
                                  	</tbody>
                                    </table>
                                    
                                </td>
                                <td width="30" bgcolor="#ffffff"></td>
                            </tr>
                          	</tbody>
                            </table>
                  			<table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="width:750px!important">
                            <tbody>
                            	<tr>
                                	<td>
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                        <tbody>
                                        	<tr><td colspan="2" height="30"></td></tr>
                                            <tr>
                                            	<td width="360" valign="top" align="center">
                                                	<div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0"><hr>Copyright&#169; Grezzli Team 2017, All rights reserved</div>
                                                	<div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                                	
                                        		</td>
                                              
                                            </tr>
                                            <tr><td colspan="2" height="5"></td></tr>
                                           
                                      	</tbody>
                                        </table>
                                   	</td>
                  				</tr>
                          	</tbody>
                            </table>
                  		</td>
                	</tr>
              	</tbody>
                </table>
       
</div>

</html>';

// Get HTML contents from file
	//$htmlContent = file_get_contents("email_template1.html");

// Set content-type for sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
	$headers .= 'From: Grezzli<contact@grezzli.com>' . "\r\n";
	//$headers .= 'Cc: contact@grezzli.com' . "\r\n";
	mail($to,$subject,$message,$headers);



echo "<script>
alert('Email Sent successfully!');
window.location.href='https://www.grezzli.com/sendmail-1C1CHBD_enFI720FI720&ion.html';
</script>";

 //echo "<script type='text/javascript'>alert('Email Sent successfully!')</script>";


// close connection

?>
