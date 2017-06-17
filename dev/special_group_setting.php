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


$data ="SELECT * FROM special_group WHERE group_id = '$id_kumpulan' ";
$query = mysqli_query($db_conx, $data);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
  $group_name = $row["group_name"];
  $skill = $row["skill"];
  $group_id = $row["group_id"];
  $privacy = $row["privacy"];
  $created_by = $row["created_by"];
  $description = $row["description"];
  $interest = $row["interest"];
}
$data2 = "SELECT * FROM special_group WHERE group_id = '$id_kumpulan' ";
$query2 = mysqli_query($db_conx, $data2);


?>



<link href="css/styles-5.css" rel="stylesheet">



<style media="screen">

  .cur{
    cursor: pointer;
  }

  .panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';
    /* essential for enabling glyphicon */
    content: "\e114";
    /* adjust as needed, taken from bootstrap.css */
    float: right;
    /* adjust as needed */
    color: grey;
    /* adjust as needed */
  }

  .panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\e080";
    /* adjust as needed, taken from bootstrap.css */
  }
  /* SOCIAL ICONS */
  /* ----------------------------------------- */

  .social {
    width:100%;
    float:right;
    padding-top:10px;
  }

  .social ul {
    list-style: none;
  }

  .social ul li {
    float:left;
    width:21px;
    height:24px;
    margin:0;
    padding:0;
    margin-left:6px;
  }

  .thumbnail {
    position:relative;
    overflow:hidden;
  }

  .caption {
    position:absolute;
    top:0;
    right:0;
    background:rgba(66, 139, 202, 0.75);
    width:100%;
    height:100%;
    padding:2%;
    display: none;
    text-align:center;
    color:#fff !important;
    z-index:2;
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



<div class="main-wrapper">

  <div class=" row summary-section" id="summary">

   <h2 class="section-title"><i class="fa fa-user"></i>Group Details

     <i rel="tooltip" class="edit_group_detail fa fa-edit pull-right cur" aria-hidden="true"></i>



   </h2>

   <div class="summary">

     <br>
     <h5>Group Name : <?php echo $group_name; ?></h5>
     <h5>Category skill : <?php echo $skill; ?></h5>
     <h5>Privacy : <?php echo $privacy; ?></h5>
     <h5>Sub Category : </h5>
     <ul>
      <?php
      while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
        $other = $row["other"];
        ?>
        <li> <?php echo $other; ?></li>
        <?php 
      }
      ?>
    </ul>
    <h5>Created : <?php echo $created_by; ?></h5>

  </div><!--//summary-->



</div></br><!--//section--></br> <br><br>

<div class="row experiences-section" id="experience">
  <h2 class="section-title"><i class="fa fa-briefcase"></i>Network Description

   <i rel="tooltip" class="edit_network_detail fa fa-edit pull-right cur" aria-hidden="true"></i>

 </h2>


 <div class="summary">

   <br>
   <h5>Group Description : <?php echo $description; ?></h5>
   <h5>Interest : <?php echo $interest; ?></h5>
 </div><!--//summary-->





</div><!--//section-->
<br><br>

<div class="row experiences-section" id="Projects">
  <h2 class="section-title"><i class="fa fa-briefcase"></i>Add Service

   <i data-toggle="modal" data-target="#modal_add_service" rel="tooltip" class="fa fa-edit pull-right cur" aria-hidden="true"></i>

 </h2>
 <?php
 while ($row = mysqli_fetch_array($proj, MYSQLI_ASSOC)) {
  $id_project= $row["id"];
  $pn= $row["project_name"];
  $pd=$row["project_desc"];
  $sd1=$row["project_sd"];
  $ed1=$row["project_ed"];
  $pd = str_replace("\n", "<br/>", $pd);
  ?>  

  <div class="item">
    <div class="meta">
      <div class="upper-row">
        <h3 class="job-title"><?php echo $pn; ?></h3>
        <div class="time" style="color: black;"><?php echo $sd1; ?> - <?php echo $ed1; ?>

          <i id="<?php echo $id_project; ?>" class="edit_pro cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>

        </div>
      </div><!--//upper-row-->

    </div><!--//meta-->

    <br>
    <div class="details">
      <p><?php echo $pd; ?></p>

    </div><!--//details-->
  </div><!--//item-->
  <?php } ?>


</div><!--//section-->
<br><br>


</div><!--//main-body-->








<!-- JS Files here -->
<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->

<script src="js/cdn/datepicker.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/agency.js"></script>







<script type="text/javascript">

  $(document).ready(function(){

    $('.edit_group_detail').click(function(){

      var id = '<?php echo $id_kumpulan; ?>';

      $.ajax({
        type:'post',
        url: 'group/edit_group_detail.php',
        data: {
          'id':id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id"]').val(json[i].id);
            $('[name="group_name"]').val(json[i].group_name);
            $('[name="category_skill"]').val(json[i].skill);
            $('[name="privacy"]').val(json[i].privacy);
            $('[name="created_by"]').val(json[i].created_by);


          }
          $('#modal_group_detail').modal('show'); 

        }
      });




    });
  })

</script>




<div class="modal fade" id="modal_group_detail" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Group Details</h4>
      </div>
      <div class="modal-body">


        <form id="form_edit_exp" class="form-horizontal" role="form"  method="post" action="group/edit_group_detail_setting.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="group_name" placeholder="Enter group name" required/>
              <input type="hidden" class="form-control" 
              id="" value="<?php echo $id_kumpulan; ?>" name="group_id"/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Category skill </label>
            <div class="col-sm-10">
             

              <select id="" class="js2 form-control" name="category_skill" style="width: 100%;">
                <?php
                $kerdas ="SELECT * FROM special_group GROUP BY skill";
                $qertyy = mysqli_query($db_conx, $kerdas);
                while ($row = mysqli_fetch_array($qertyy, MYSQLI_ASSOC)) {
                  $ocho = $row["skill"];

                  if ($ocho == $skill) {
                    echo "<option selected value='".$row['skill']."'>".$row['skill']."</option>";
                  }else{
                    echo "<option value='".$row['skill']."'>".$row['skill']."</option>";

                  }
                }
                ?>
              </select>


            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Other </label>
            <div class="col-sm-10">

              <select id="sub_category" class="js2 form-control" multiple="multiple" name="sub_category[]" style="width: 100%;">
                <?php
                $das ="SELECT * FROM special_group WHERE group_id = '$id_kumpulan' ";
                $qerty = mysqli_query($db_conx, $das);
                while ($row = mysqli_fetch_array($qerty, MYSQLI_ASSOC)) {
                  $other = $row["other"];
                  echo "<option selected value='".$row['other']."'>".$row['other']."</option>";
                }
                ?>
              </select>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Privacy </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="privacy" placeholder="Enter privacy" required/>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Created </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="created_by" placeholder="Enter privacy" readonly/>
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

























<script type="text/javascript">

  $(document).ready(function(){

    $('.edit_network_detail').click(function(){


      $('#modal_network_detail').modal('show'); 


    });
  })

</script>




<div class="modal fade" id="modal_network_detail" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Network Details</h4>
      </div>
      <div class="modal-body">


        <form id="form_edit_exp" class="form-horizontal" role="form"  method="post" action="group/edit_group_network_setting.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Group Description </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="group_desc" value = "<?php echo $description; ?>" required/>
              <input type="hidden" class="form-control" 
              id="" value="<?php echo $id_kumpulan; ?>" name="id"/>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Interest </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="group_int" value = "<?php echo $interest; ?>" required/>
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
























<div class="modal fade" id="modal_add_service" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Group Details</h4>
      </div>
      <div class="modal-body">


        <form id="form_edit_exp" class="form-horizontal" role="form"  method="post" action="group/edit_group_detail_setting.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Service Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="service_name" placeholder="Enter service name" required/>
              <input type="hidden" class="form-control" 
              id="" value="<?php echo $id_kumpulan; ?>" name="group_id"/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Category skill </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="category_skill" placeholder="Enter skill" required/>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Other </label>
            <div class="col-sm-10">

              <select id="sub_category" class="js2 form-control" multiple="multiple" name="sub_category[]" style="width: 100%;">
                <?php
                $das ="SELECT * FROM special_group WHERE group_id = '$id_kumpulan' ";
                $qerty = mysqli_query($db_conx, $das);
                while ($row = mysqli_fetch_array($qerty, MYSQLI_ASSOC)) {
                  $other = $row["other"];
                  echo "<option selected value='".$row['other']."'>".$row['other']."</option>";
                }
                ?>
              </select>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Privacy </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="privacy" placeholder="Enter privacy" required/>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Created </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="created_by" placeholder="Enter privacy" readonly/>
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








