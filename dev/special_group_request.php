<?php
   //Start your session
session_start();

include_once("php_includes/check_login_status.php");
   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$u = $_SESSION['username'];



$id= $_GET['id'];
$id_kumpulan = $_GET['ud'];


$data1="SELECT * FROM service WHERE Service_category = '$id' GROUP BY Username";
$query1 = mysqli_query($db_conx, $data1);


$data9 ="SELECT * FROM group_special_member WHERE group_id = '$id_kumpulan' AND status = 'request' AND created_by = '$u' ";
$query9 = mysqli_query($db_conx, $data9);

?>



<h5>Suggestion member</h5>

<div class="row" style="padding-top:50px;">

  <?php

  while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

    $pr = $row['Username'];

    ?>

    <?php

    $data2="SELECT * FROM users WHERE username= '$pr' ";
    $query2 = mysqli_query($db_conx, $data2);

    while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
      $username_person = $row["username"];
      $user_first = $row["first_name"];
      $user_last = $row["last_name"];
      $user_avatar = $row["avatar"];
      ?>

      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="media conversation headbox" id="<?php echo $user_first; ?>" >

              <a class="pull-left" href="#" >
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" src="<?php echo $user_avatar; ?>">
              </a>

              <button type="button" id="<?php echo $username_person; ?>" class="addMember pull-right btn btn-default">Add</button>
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































<h5>Request member</h5>

<div class="row" style="padding-top:50px;">

  <?php

  while ($row = mysqli_fetch_array($query9, MYSQLI_ASSOC)) {

    $id_newgroup = $row["id"];
    $gn = $row["group_name"];
    $pr = $row['member_username'];
    $cb = $row["status"];

    ?>

    <?php

    $data7="SELECT * FROM users WHERE username= '$pr' ";
    $query7 = mysqli_query($db_conx, $data7);

    while ($row = mysqli_fetch_array($query7, MYSQLI_ASSOC)) {
      $user_first7 = $row["first_name"];
      $user_last7 = $row["last_name"];
      $user_avatar7 = $row["avatar"];
      ?>

      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="media conversation headbox" id="<?php echo $gn; ?>" >

              <a class="pull-left" href="#" >
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" src="<?php echo $user_avatar7; ?>">
              </a>

              <button type="button" id="<?php echo $id_newgroup; ?>" class="appButang pull-right btn btn-default">Approve</button>
              <button type="button" id="<?php echo $id_newgroup; ?>" class="RejButang pull-right btn btn-default">Reject</button>
              <div class="media-body">
                <h5 class="media-heading"><?php echo $user_first7; ?> <?php echo $user_last7; ?>
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

        var hehe = '<?php echo $id; ?>';
            var id_kumpulan = '<?php echo $id_kumpulan; ?>';


    $('.appButang').click(function(){

      var a = this.id;

      $.ajax(
      {
        url : 'group/new_special_group_approve_member.php',
        type: "POST",
        data : {
          id : a
        },
        success:function(data, textStatus, jqXHR) 
        {
                      window.location.href = "../special_group.php?id="+hehe+"&ud="+id_kumpulan;
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
          }
        });

    })

  })

</script>


<script type="text/javascript">

  $(document).ready(function(){

            var hehe = '<?php echo $id; ?>';

    var id_kumpulan = '<?php echo $id_kumpulan; ?>';

    $('.RejButang').click(function(){
      
      var a = this.id;

      $.ajax(
      {
        url : 'group/new_special_group_reject_member.php',
        type: "POST",
        data : {
          id : a
        },
        success:function(data, textStatus, jqXHR) 
        {
                      window.location.href = "../special_group.php?id="+hehe+"&ud="+id_kumpulan;
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
          }
        });

    })

  })

</script>





















<script type="text/javascript">

  $(document).ready(function(){

        var hehe = '<?php echo $id; ?>';
    var id_kumpulan = '<?php echo $id_kumpulan; ?>';

    $('.addMember').click(function(){

      var a = this.id;

      $.ajax(
      {
        url : 'group/new_special_group_insert_member.php',
        type: "POST",
        data : {
          id_kumpulan : id_kumpulan,
          username : a
        },
        success:function(data, textStatus, jqXHR) 
        {
                      window.location.href = "../special_group.php?id="+hehe+"&ud="+id_kumpulan;
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
          }
        });

    })

  })

</script>

