    
<?php


   include_once("../php_includes/check_login_status.php");
   
  if(!isset($_SESSION['username']))
  {
  header("Location: ../index.php");
  }

  
   //Read your session (if it is set)
   if (isset($_SESSION['fname']))
      $fn =  $_SESSION['fname'];
      $ln = $_SESSION['lname'];
      $u = $_SESSION['username'];
      $userid = $_SESSION['userid'];
      $avatar = $_SESSION['avatar'];



  $msg_listing = "SELECT * FROM message WHERE to_user = '$u' ";
      $msg_array = mysqli_query($db_conx, $msg_listing);
      
      
if (mysqli_num_rows($msg_array) != 0)
{
//results found
 //       echo "not";

} else {
// results not found
        echo "<span>You have no message</span>";

        ?>

        <script type="text/javascript">

        $('.table th').remove();

        </script>

        <?php

}


?>

<style type="text/css">
	
	.ayamas{
		cursor: pointer;
	}
</style>




   <table class="table table-inbox table-hover">
                            <tbody>

                            <th>From</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th></th>
                            <th></th>

                             <?php  
      while ($row = mysqli_fetch_array($msg_array, MYSQLI_ASSOC)) {
      $id = $row["id"];
      $from = $row["from_user"];
      $to = $row["to_user"];
      $sbj = $row["subject"];
      $msg = $row["message"];
      $status = $row["status"];
      $cd = $row["created_date"];
      ?>

      <?php

      if ( $status == "unread") {
      	
      	?>

      	<tr class="unread">

      	<td rel = "<?php echo $id; ?>" class="ayamas view-message  dont-show"><b><?php echo $from; ?></b></td>
      		<td rel = "<?php echo $id; ?>" class="ayamas view-message "> <b> <?php echo $sbj; ?> </b> </td>
      		<td rel = "<?php echo $id; ?>" class="ayamas view-message "> <b> <?php echo $cd; ?> </b> </td>
      		<td class="view-message  "><a style="color: black;" href="delete_inbox_msg.php?id=<?php echo $id; ?>" class="delete-row"><span class="glyphicon glyphicon-trash"></span></a>
      			<td id = "" rel = "<?php echo $id; ?>" class="ayamas view-message  "><a style="color: black;" href = "javascript:void(0)" class=" delete-row"><span class="glyphicon glyphicon-search"></span></a>
      			</td>
      		</tr>


      	<?php
      }else{

      	?>

      	<tr class="unread">

      		<td  rel = "<?php echo $id; ?>" class="ayamas view-message dont-show"><?php echo $from; ?></td>
      		<td  rel = "<?php echo $id; ?>" class="ayamas view-message "><?php echo $sbj; ?></td>
      		<td  rel = "<?php echo $id; ?>" class="ayamas view-message "><?php echo $cd; ?></td>
      		<td class="view-message  "><a style="color: black;" href="delete_inbox_msg.php?id=<?php echo $id; ?>" class="delete-row"><span class="glyphicon glyphicon-trash"></span></a>
      			<td id = "" rel = "<?php echo $id; ?>" class="ayamas view-message  "><a style="color: black;" href = "javascript:void(0)" class=" delete-row"><span class="glyphicon glyphicon-search"></span></a>
      			</td>
      		</tr>

      	<?php
      }

      ?>

                            
                           <?php } ?>


                             
                          </tbody>
                          </table>



<script type="text/javascript">
  
  $('.ayamas').click(function(){

  	   // var a = $(".drift").attr("href");
  	       var a = $(this).attr("rel");


    $('#messagebox').load('view_message.php?id='+a);
  })
</script>

