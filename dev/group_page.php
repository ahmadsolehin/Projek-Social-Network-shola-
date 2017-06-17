<?php
   //Start your session
session_start();

include_once("php_includes/check_login_status.php");
   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$c = $_SESSION['comapny_name'];
$u = $_SESSION['username'];
$usertype = $_SESSION['user_type'];
$userid = $_SESSION['userid'];
$avatar = $_SESSION['avatar'];




$user_listing = "SELECT * FROM users WHERE username != '$u' ";
$user_array = mysqli_query($db_conx, $user_listing);



$skill_listing = "SELECT DISTINCT skill_service_provider FROM skills ";
$skill_array = mysqli_query($db_conx, $skill_listing);


$data1="SELECT * FROM new_group ";
$query1 = mysqli_query($db_conx, $data1);



$reader = "SELECT * FROM group_member";
$spl = mysqli_query($db_conx, $reader);
$num_of_row = mysqli_num_rows($spl);



$data2="SELECT * FROM special_group GROUP BY group_name ";
$query2 = mysqli_query($db_conx, $data2);





$service_user = "SELECT * FROM service_skill GROUP BY main_category ";
$array_skill = mysqli_query($db_conx, $service_user);
?>

<!DOCTYPE html>
<html lang="en">


<!-- Include jQuery library -->

<?php include_once ("headerlogin.php"); ?>

<link rel="stylesheet" href="style.css">




<style media="screen">

  #cursor{
    cursor: pointer;
  }

  body {
    padding-top: 74px;
  }
    /*@media screen and (max-width: 768px) {
    body { padding-top: 0px; }
  }*/
  /* Newsfeed box css*/

  .feed_box {
    position: relative;
    width: auto;
    height: auto;
    padding: 0px;
    background: #FFFFFF;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    border: #7F7F7F solid 2px;
  }

  .feed_box:after {
    content: '';
    position: absolute;
    border-style: solid;
    border-width: 8px 30px 8px 0;
    border-color: transparent #FFFFFF;
    display: block;
    width: 0;
    z-index: 1;
    left: -27px;
    top: 12px;
  }

  .feed_box:before {
    content: '';
    position: absolute;
    border-style: solid;
    border-width: 8px 30px 8px 0;
    border-color: transparent #7F7F7F;
    display: block;
    width: 0;
    z-index: 0;
    left: -27px;
    top: 9px;
  }
  /*status update bar*/

  .message {
    border-radius: 0;
    border: none;
  }

  .panel {
    border-radius: 0;
    border: none;
    margin-bottom: 0;
  }

  .privacy-dropdown {
    width: 100px;
  }


  .modal {
    text-align: center;
    padding: 0!important;
  }

  .modal:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px;
  }

  .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
  }
</style>




<style media="screen">

  .list-group-horizontal .list-group-item {
    display: inline-block;
  }
  .list-group-horizontal .list-group-item {
    margin-bottom: 0;
    margin-left:-4px;
    margin-right: 0;
  }
  .list-group-horizontal .list-group-item:first-child {
    border-top-right-radius:0;
    border-bottom-left-radius:4px;
  }
  .list-group-horizontal .list-group-item:last-child {
    border-top-right-radius:4px;
    border-bottom-left-radius:0;
  }

</style>


<script type="text/javascript">
  $(document).ready(function() {

    $(".js").select2({
      placeholder: "  Add friend",
      allowClear: true
    });

    $(".js2").select2({
      placeholder: "  Add skill",
      allowClear: true
    });

  });


</script>




<body id="page-top" class="index">

</br>















<div class="container">

  <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">

      <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-4">
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4">
        </div>

      </div>

    </div>

    <div class="col-md-3 col-sm-3 col-xs-3" >

    </div>
    <div class="col-md-2 col-sm-2 col-xs-2">

    </div>

    <div class="col-md-2 col-sm-2 col-xs-2">
    </div>

  </div></br>



  <div class="row">
    <!-- Info about  user  -->
    <div class="col-md-4 col-sm-4 col-xs-4">

      <div class="row">

       <div class="col-md-6 col-sm-8 col-xs-8 ">
         <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#GroupModal" >Create Group</a>
       </div>
       <div class="col-md-6 col-sm-4 col-xs-4 ">
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#SpecialGroupModal" >Create Network</a>

      </div>
    </div>

  </div>

</div>
















<div class="row" style="padding-top:50px;">

  <h4>Group</h4>



  <?php

  while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

    $gid = $row["id"];
    $gn = $row["group_name"];
    $pr = $row["privacy"];
    $cb = $row["created_by"];

    ?>

    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a style = "color:black;" href="../new_group.php?id=<?php echo $gid; ?>"><?php echo $gn; ?></a>
        </div>
        <div class="panel-body">
          <div class="media conversation headbox" id="<?php echo $gn; ?>" >
            <button type="button" rel="<?php echo $cb; ?>" id="<?php echo $gid; ?>" class="btn-newgroup pull-right btn btn-default">Join</button>
            <div class="media-body">
              <h5 class="media-heading"><?php echo $pr; ?> Group
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php
  }
  ?>





</div>












<div class="row" style="padding-top:50px;">

  <h4>Special Group</h4>



  <?php

  while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

    $id_special = $row["id"];
    $groupid_special = $row["group_id"];
    $gn_special = $row["group_name"];
    $pr_special = $row["privacy"];
    $cb_special = $row["created_by"];
    $skill_special = $row["skill"];

    ?>

    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">

          <a style = "color:black;" href="../special_group.php?id=<?php echo $skill_special; ?>"><?php echo $gn_special; ?></a>              
        </div>
        <div class="panel-body">
          <div class="media conversation headbox" id="<?php echo $gn_special; ?>" >
            <button type="button" href = "<?php echo $cb_special; ?>" rel="<?php echo $groupid_special; ?>"  id="<?php echo $skill_special; ?>" class="btn-special pull-right btn btn-default">Join</button>
            <div class="media-body">
              <h5 class="media-heading"><?php echo $pr_special; ?> Group
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php
  }
  ?>



</div>






</div></br>



<!-- 




  <div class="container">
    <div class="row" style="padding-top:50px; padding-right:62%; ">

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">

        <div id = "cursor" class="list-group list-group-horizontal">
          <a id="btn-discuss" class="list-group-item">Discussion</a>
          <a id="btn-member" class="list-group-item">Members</a>
        </div>

      </div>


    </div>










    <div class="col-md-8 col-sm-8 col-xs-8">



      <div class="panel panel-default">
        <div class="panel-body" id = "messagebox">


        </div>
      </div>
    </div>








    <div class="col-md-3 col-sm-3 col-xs-3">
      <div class = "row">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1769554773319547";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


        <div class="fb-page" data-href="https://www.facebook.com/grezzli.online/" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/grezzli.online/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/grezzli.online/">Grezzli</a></blockquote></div>
      </div>    
    </div>





  </div>


-->




<!-- Footer -->
<div>
 <?php include_once("footer.php"); ?>
</div>



<script src="coverphoto/jquery.js"></script>
<script src="coverphoto/jquery-ui.custom.min.js"></script>




<!-- JS Files here -->
<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->

<script src="js/cdn/datepicker.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/agency.js"></script>





<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>



</body>

</html>



<script type='text/javascript'>
  $(document).ready(function(){

    $('#messagebox').load("group_discuss.php");




    $('#btn-discuss').click(function(){

      $('#messagebox').load("group_discuss.php");
    })


    $('#btn-member').click(function(){

      $('#messagebox').load("group_member.php");
    })



  });
</script>





<div class="modal fade" id="GroupModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Group</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_exp" method="post" action="group/create_group.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="group_name" placeholder="Enter group name"/>
              <input type="hidden" value="<?php echo $u; ?>" name="created_by" />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Add Friend </label>
            <div class="col-sm-10">


              <select class="js form-control" multiple="multiple" name="group_member[]" style="width: 100%;">


                <?php  
                while ($row = mysqli_fetch_array($user_array, MYSQLI_ASSOC)) {
                  $nama_pertama = $row["first_name"];
                  $nama_akhir = $row["last_name"];
                  $id_pengguna = $row["id"];
                  $username = $row["username"];
                  $avatar = $row["avatar"];
                  ?>

                  <option value="<?php echo $username;?>"><?php echo $nama_pertama; ?> <?php echo $nama_akhir; ?></option>

                  <?php } ?>

                </select>

              </div>
            </div>

            <div class="form-group">
              <label  class="col-sm-2 control-label"
              for="">Privacy Group </label>
              <div class="col-sm-10">

               <select name="privacy" class="form-control" id="sel1">
                <option>Public</option>
                <option>Private</option>
              </select>
            </div>
          </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
































<div class="modal fade" id="SpecialGroupModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Special Group</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_exp" method="post" action="group/create_special_group.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="group_name" placeholder="Enter group name"/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Add Skill </label>
            <div class="col-sm-10">


            <select id="service_category" class="js2 form-control" name="service_category" style="width: 100%;">

               <?php  
               while ($row = mysqli_fetch_array($array_skill, MYSQLI_ASSOC)) {
                $skill_id = $row["id"];
                $m_cate = $row["main_category"];
                $s_cate = $row["sub_category"];
                ?>

                <option value="<?php echo $m_cate;?>"><?php echo $m_cate; ?></option>

                <?php } ?>

              </select>

            </div>
          </div>

                    <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Other Skill </label>
            <div class="col-sm-10">
            <select id="sub_category" class="js2 form-control" multiple="multiple" name="sub_category[]" style="width: 100%;">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Privacy Group </label>
            <div class="col-sm-10">

             <select name = "privacy" class="form-control" id="sel1">
              <option>Public</option>
              <option>Private</option>
            </select>
          </div>
        </div>


        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save</button>
          </div>
        </div>
      </form>


    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>




<script type='text/javascript'>
  $(document).ready(function(){

    $("#skill_user").change(function(){

     $( ".js2" ).each(function() {

       var hehe $(this).val();

       alert(hehe);

       $.ajax({
        type:'post',
        url: 'ser_provider/select_friend_based_skill.php',
        data: {
          'in':hehe //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

      //      $('[name="id_skill"]').val(json[i].id);
       //     $('[name="edit_skill"]').val(json[i].skill_service_provider);
       alert(json);

     }


   }
 }); 

     })





   });


  });
</script>





<script type='text/javascript'>
  $(document).ready(function(){

    $(".btn-newgroup").click(function(){

     var hehe = this.id;

     var created_by = $(this).attr('rel');

     $.ajax({
      url: "group/check_status_member.php",
      type: "post",
      data: {
        id: hehe,
        created : created_by
      } ,
      success: function (data) {
        if (data == "ada") {
          alert("You already member..")
          window.location.href = "../new_group.php?id="+hehe;

        }else if (data == "not") {
          alert("Request send..Awaiting approval..")
        };
      },
      error: function(jqXHR, textStatus, errorThrown) {
       console.log(textStatus, errorThrown);
     }
   });


   });


  });
</script>



<script type='text/javascript'>
  $(document).ready(function(){

    $(".btn-special").click(function(){


     var hehe = this.id;
          var c = $(this).attr('rel');
     var created_by = $(this).attr('href');


               $.ajax({
      url: "group/check_status_special_member.php",
      type: "post",
      data: {
        id: c,
       created : created_by
      } ,
      success: function (data) {
        if (data == "ada") {
          alert("You already member..")
          window.location.href = "../special_group.php?id="+hehe+"&ud="+c;

        }else if (data == "not") {
          alert("Request send..Awaiting approval..")
        };
      },
      error: function(jqXHR, textStatus, errorThrown) {
       console.log(textStatus, errorThrown);
     }
   });

     
   });


  });
</script>





  <script type="text/javascript">

    $(document).ready(function(){

      $('#service_category').change(function(){
        var a = $('#service_category').find(":selected").text();

        $.ajax({
          type:'post',
          url: 'ser_provider/select_service_skill.php',
          data: {
          'data':a //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

           $('#sub_category').empty();

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {
            $('#sub_category').append('<option value="'+json[i].sub_category+'">'+json[i].sub_category+'</option>');                      
          }
        }
      }); 

      });

    })

  </script>

