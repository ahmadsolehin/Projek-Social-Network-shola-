<?php
   //Start your session
session_start();

include_once("php_includes/check_login_status.php");
   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$u = $_SESSION['username'];



$id= $_GET['ud'];


$data1="SELECT * FROM group_special_member WHERE group_id = '$id' AND status = 'member' ";
$query1 = mysqli_query($db_conx, $data1);

?>

    <div class="row" style="padding-top:50px;">

      <?php

      while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

        $id_newgroup = $row["id"];
        $gn = $row["group_name"];
        $pr = $row['member_username'];
        $cb = $row["status"];

        ?>

           <?php

           $data2="SELECT * FROM users WHERE username= '$pr' ";
$query2 = mysqli_query($db_conx, $data2);

      while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
        $user_first = $row["first_name"];
        $user_last = $row["last_name"];
        $user_avatar = $row["avatar"];
        ?>

        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="panel panel-default">
            <div class="panel-body">
                <div class="media conversation headbox" id="<?php echo $gn; ?>" >

                    <a class="pull-left" href="#" >
                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" src="<?php echo $user_avatar; ?>">
                </a>

              
                  <div class="media-body">
                    <h5 class="media-heading"><?php echo $user_first; ?> <?php echo $user_last; ?>
                    </h5>
                  </div>
                </div>
            </div>
          </div>
        </div>


        <?php
      }
      ?> 

          <?php
      }
      ?>





    </div>








<script type="text/javascript">

  $(document).ready(function(){

    $('.appButang').click(function(){
      alert('gh');
      var a = this.id;
      alert(a);
    })

  })

</script>



