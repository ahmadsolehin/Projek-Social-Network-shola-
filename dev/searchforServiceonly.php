<style type="text/css">
  
  h6 { width:100%; text-align:center; border-bottom: 1px solid  #ffffff; line-height:0.1em; margin:10px 0 20px; } 
h6 span { background:#fff; padding:0 10px; }

</style>


<?php

$connect = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_b");


if($_POST)
{
$q=$_POST['searchword'];

  $sql=mysqli_query( $connect ,"select * from service where Service_name like '%$q%' GROUP BY Service_name")or die(mysqli_error($connect));

             if(mysqli_num_rows($sql)>0){

?>

 <h6><span>SERVICE</span></h6>

<?php

while($row=mysqli_fetch_array( $sql))
{
  $userid=$row['Service_name'];
  $Service_pic=$row['Service_pic'];
        $Service_id = $row['Service_id'];

  ?>

        <a style = "color:black; text-decoration: none;" href="service_display2.php?u=<?php echo urlencode($userid);?>"> 
        <div class="display_box" align="left">
          <img src="<?php echo $Service_pic; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name" id = "displayName"><?php echo $userid; ?></span> &nbsp;<br/>
        </div>
      </a>

      <?php
}


}

}
?>
