<?php
include_once("php_includes/check_login_status.php");
     //Start your session
session_start();
if(!isset($_SESSION['username']))
{
  header("Location: index.php");
}

$fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$u = $_SESSION['username'];
$usertype = $_SESSION['user_type'];
$userid = $_SESSION['userid'];


$position="";
$background="";
$profile="";

$wechat="SELECT position , background , profile FROM useroptions WHERE id='$userid' LIMIT 1";
$kuali = mysqli_query($db_conx, $wechat);
while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
  $position = $row["position"];
  $background = $row["background"];
  $profile = $row["profile"];
}


$sql="SELECT cv_id , About_me FROM cv WHERE username='$u' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
  $id_of_cv = $row["cv_id"];
  $summary = $row["About_me"];
}



$project="SELECT id , project_name, project_desc, project_sd, project_ed FROM projects WHERE username='$u' ";
$proj=mysqli_query($db_conx, $project);



$certificate="SELECT id , certificate_Name, certificate_Authority, certificate_desc, certificate_start_date, certificate_end_date FROM certification WHERE username='$u' ";
$cert=mysqli_query($db_conx, $certificate);

$work_detail="SELECT id , compnay_name, company_position, work_details, work_start_date, work_end_date FROM employment WHERE username='$u' ORDER BY id";
$work=mysqli_query($db_conx, $work_detail);

$education="SELECT id ,  university_name, university_level, university_start_date, university_end_date FROM education WHERE username='$u' ";
$edu=mysqli_query($db_conx, $education);




$language="SELECT Language FROM cv WHERE username='$u' ";
$lang=mysqli_query($db_conx, $language);

while ($row = mysqli_fetch_array($lang, MYSQLI_ASSOC)) {
  $num_lang = $row["Language"];
}


$hobbies="SELECT Hobbies FROM cv WHERE username='$u' ";       
$hobby=mysqli_query($db_conx, $hobbies);  

while ($row = mysqli_fetch_array($hobby, MYSQLI_ASSOC)) {
  $num_interest = $row["Hobbies"];
}


$skills="SELECT * FROM skills WHERE username='$u' ";
$skill=mysqli_query($db_conx, $skills);


?>
<!DOCTYPE html>
<html lang="en">


<?php include_once ("headerlogin.php"); ?>


<link rel="stylesheet" href="style.css">
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



</head>

<body id="page-top" class="index">

  <!--navigation bar-->

  <!--row for cover photo  -->
  <div class="full-background">


  </div>
</br>

<div class="container">

  <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">

      <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-4">
          <a href="#" class="" data-toggle="">

           <!--  <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt=""> -->
              <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
              <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
            </a>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-4">
            <a href="#" class="" data-toggle="">

            <!--   <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt=""> -->
              <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
              <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
            </a>
          </div>

        </div>

      </div>

      <div class="col-md-3 col-sm-3 col-xs-3">

        <form enctype="multipart/form-data" action="image_upload_demo_submit.php" method="post" name="image_upload_form" id="image_upload_form">
          <div id="imgArea">        
            <img id="profile-photo" style="display: block; margin-left: auto; margin-right: auto;margin-top:-5vmax"  src="<?php echo $profile; ?>" class="img-responsive img-circle" alt="">

            <div class="progressBar">
              <div class="bar"></div>
              <div class="percent">0%</div>
            </div>
            <div id="imgChange"><span>Change Photo</span>
              <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">
              <input type = "hidden" name = "name" value = "<?php echo $fn.''.$ln; ?>">
              <input type = "hidden" name = "usertype" value = "<?php echo $usertype; ?>">
            </div>
          </div>
        </form>

        <p style="text-align:center"><?php echo $fn.' '.$ln; ?></p>

      </div>
      <div class="col-md-2 col-sm-2 col-xs-2">
      
     
      
        <a href="#" class="" data-toggle="">

          <!-- <img src="img/user_rating.png" class="img-responsive" alt=""> -->
          
          
          <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
          <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
        </a>
      </div>

<!--       <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-envelope"></i> </button>
        </a>
        <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
        <i class="fa fa-2x fa-info-circle"></i></a></p></div>

      </div>
      <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-plus"></i><i style="color:green" class="glyphicon glyphicon-user"></i></button>
        </a>
        
      </div> -->


    </div><!-- end of badge/photos section  -->
  </br>
  <div class="row">

    <div class="col-md-4 col-sm-4 col-xs-4 "></div>
    <div class="col-md-3 col-sm-4 col-xs-4 ">
      <a href="userprofile.php">
        <button  style="width:80%" class="btn btn-primary btn-block"> Show Services</button></a>
      </div>
      <div class="col-md-2">
        <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#videoModal" data-theVideo="https://www.youtube.com/embed/c_PZTAW5piQ">VIDEO CV</a> -->


        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div>
                  <iframe width="100%" height="350" src=""></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div></br>

    <div class="row">


      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-2"></div>
          <div class="social">
            <ul>
              <!--<li><a  href="#" title="Download .pdf"><img src="img/user_cv_icon/icn-save.jpg" alt="Download the pdf version" /></a></li>-->
              <!--<li><a  href="javascript:window.print()" title="Print"><img src="img/user_cv_icon/icn-print.jpg" alt="" /></a></li>-->
            </ul>
          </div>
        </div>
        <div class="wrapper">
          <div class="sidebar-wrapper">
            <div class="profile-container">
              <img class="profile img-responsive img-circle" src=" " alt="" >
              <h4 ><?php echo $fn.' '.$ln; ?></h4>

            </div><!--//profile-container-->

            <!--//contact-container-->
            <div class="education-container container-block">
              <h2 class="container-block-title">Education

               <i style="color: black;" data-toggle="modal" data-target="#modal_add_education" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>


             </h2>
             <?php
             while ($row = mysqli_fetch_array($edu, MYSQLI_ASSOC)) {
              $id_education = $row["id"];
              $uni_name = $row["university_name"];
              $uni_level = $row["university_level"];
              $uni_sd = $row["university_start_date"];
              $uni_ed = $row["university_end_date"];

              ?>
              <div class="item">

                <h4 class="degree"><?php echo $uni_level; ?>

                  <i id="<?php echo $id_education; ?>" class="edit_edu cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>

                </h4>
                <h5 class="meta"><?php echo $uni_name; ?></h5>
                <div class="time"><?php echo $uni_sd; ?> - <?php echo $uni_ed;?></div>
              </div><!--//item-->
              <?php    } ?>

            </div><!--//education-container-->




            <div class="languages-container container-block">

             <?php

             if ($num_lang == '') {
              ?>

              <h2 class="container-block-title">Languages
               <i style="color: black;" data-toggle="modal" data-target="#modal_add_language" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>
             </h2>
             <?php

             $lan = str_replace("\n", "<br/>", $num_lang); 
             ?>

             <ul class="list-unstyled interests-list">
              <li><?php echo $lan; ?> <span class="lang-desc"> </span></li>
            </ul>

            <?php
          }else{
            ?>
            <h2 class="container-block-title">Languages
            </h2>
            <?php

            $lan = str_replace("\n", "<br/>", $num_lang); 
            ?>

            <ul class="list-unstyled interests-list">

              <li>
               <i id="<?php echo $id_of_cv; ?>" class="edit_language cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>
               <?php echo $lan; ?> <span class="lang-desc"> </span>
             </li>
           </ul>




           <?php
         }
         ?>


       </div><!--//interests-->







       <div class="interests-container container-block">

         <?php
         if ($num_interest == '') {
          ?>

          <h2 class="container-block-title">Interests
            <i style="color: black;" data-toggle="modal" data-target="#modal_add_interest" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>
          </h2>

          <?php 
          $hob = str_replace("\n", "<br/>", $num_interest);

          ?>
          <ul class="list-unstyled interests-list">
            <li><?php echo $hob; ?></li> <br> 

          </ul>

          <?php
        }else{
          ?>

          <h2 class="container-block-title">Interests
          </h2>

          <?php 
          $hob = str_replace("\n", "<br/>", $num_interest);

          ?>
          <ul class="list-unstyled interests-list">
            <i id="<?php echo $id_of_cv; ?>" class="edit_interest cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>
            <li><?php echo $hob; ?></li> <br>
          </ul>



          <?php
        }
        ?>


      </div><!--//interests-->






    </div><!--//sidebar-wrapper-->

    <div class="main-wrapper">

      <div class=" row summary-section" id="summary">

        <?php

        if ( $summary == '') {
         ?>
         <h2 class="section-title"><i class="fa fa-user"></i>Career Profile

           <i data-toggle="modal" data-target="#modal_add_summary" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>

         </h2>

         <div class="summary">
          <p><?php echo "$summary";?></p>
          <!-- <p class="text-right" ><?php echo "$summary";?></p> -->

        </div><!--//summary-->

        <?php
      }else {
       ?>
       <h2 class="section-title"><i class="fa fa-user"></i>Career Profile
       </h2>

       <div class="summary">
        <p><?php echo "$summary";?>
         <i id="<?php echo $id_of_cv; ?>" class="edit_summary cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>
       </p>
       

     </div><!--//summary-->
     <?php
   } 
   ?>





 </div></br><!--//section--></br> <br><br>

 <div class="row experiences-section" id="experience">
  <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiences

    <i data-toggle="modal" data-target="#modal_add_exp" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>

  </h2>

  <?php
  while ($row = mysqli_fetch_array($work, MYSQLI_ASSOC)) {
    $employment_id = $row["id"];
    $company = $row["compnay_name"];
    $position1 = $row["company_position"];
    $work_details = $row["work_details"];
    $start_date = $row["work_start_date"];
    $end_date = $row["work_end_date"];

    $work_details = str_replace("\n", "<br/>", $work_details);

    ?>

    <div class="item">
      <div class="meta">
        <div class="row">
          <div class="col-md-5">
            <h4><?php echo $company; ?></h4>
            <h3 class="job-title"><?php echo $position1; ?></h3><div class="">

            <?php echo $start_date; ?> - <?php echo $end_date;?></div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-3"  style="padding-right:0;padding-left:0;padding-top:0">

            <i id="<?php echo $employment_id; ?>" class="edit_exp cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>


            <div class="thumbnail">
              <div class="caption">

                <a style="text-align:center" href="javascript:void(0)" class="btn btn-success add_exp" id = "<?php echo $employment_id; ?>">Details</a>
              </div>
              <img src="img/company_nologo.png" class="img-responsive" alt="...">
            </div>
          </div>

        </div><!--//upper-row-->





      </div><!--//meta-->
      <div class="details">
      </div><!--//details-->
    </div><!--//item-->



    <!-- Modals for Job Positions and Details -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="myModal_position"></h4>
          </div>
          <div class="modal-body">
            <p id="myModal_work_det" ></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div> 

    <?php
  }
  ?>






</div><!--//section-->
<br><br>

<div class="row experiences-section" id="Projects">
  <h2 class="section-title"><i class="fa fa-briefcase"></i>Projects

   <i data-toggle="modal" data-target="#modal_add_pro" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>

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



<div class=" row skills-section" id="skills">

  <h2 class="section-title"><i class="fa fa-rocket"></i>Skills &amp; Proficiency

   <i data-toggle="modal" data-target="#modal_add_skill" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>

 </h2>

 <div class="skillset">

   <?php
   while ($row = mysqli_fetch_array($skill, MYSQLI_ASSOC)) {
    $id_skills= $row["id"];
    $spl= $row["skill_service_provider"];
    ?>  


    <?php
    $s = str_replace("\n", "<br/>", $spl);
    ?>  
    <div class="item">
      <h3 class="level-title"><?php echo $s; ?></h3>

      <i id="<?php echo $id_skills; ?>" class="edit_skill cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>

    </div><!--//item-->


    <?php
  } 
  ?>


</div>

</div></br><!--//skills-section-->

<br><br>





<div class="row experiences-section" id="certificates">
  <h2 class="section-title"><i class="fa fa-briefcase"></i>Certificates

    <i data-toggle="modal" data-target="#modal_add_cert" rel="tooltip" class="fa fa-plus pull-right cur" aria-hidden="true"></i>

  </h2>
  <?php
  while ($row = mysqli_fetch_array($cert, MYSQLI_ASSOC)){
    $id_certificate = $row["id"]; 
    $certificate = $row["certificate_Name"]; 
    $cert_auth = $row["certificate_Authority"];
    $cert_des = $row["certificate_desc"];
    $csd = $row["certificate_start_date"];
    $ced = $row["certificate_end_date"];

    ?>

    <div class="item">
      <div class="meta">
        <div class="upper-row">
          <h3 class="job-title"><?php echo $certificate; ?></h3>
          <div class="time"  style="color: black;"><?php echo "$csd";?> - <?php echo "$ced";?>

            <i id="<?php echo $id_certificate; ?>" class="edit_cert cur fa fa-pencil-square-o pull-right" aria-hidden="true"></i>


          </div>
        </div><!--//upper-row-->
        <div class="company"><?php echo "$cert_auth";?></div>
      </div><!--//meta-->
      <div class="details">
        <p><?php echo $cert_des; ?></p>

      </div><!--//details-->
    </div><!--//item-->
    <?php } ?>


  </div><!--//section--> <br><br>

</div><!--//main-body-->
</div>


</div>

</div>

</div></br>


<!-- Footer -->

<?php include_once ("footer.php"); ?>



<input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">


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


<script src="coverphoto/coverphoto.js"></script>

<script src="js/jquery.form.js"></script> 

<!--  script for autoplay video-->
<script>
  $(document).ready(function() {


    autoPlayYouTubeModal();
  //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
  function autoPlayYouTubeModal() {
    var trigger = $("body").find('[data-toggle="modal"]');
    trigger.click(function() {
      var theModal = $(this).data("target"),
      videoSRC = $(this).attr("data-theVideo"),
      videoSRCauto = videoSRC + "?autoplay=1";
      $(theModal + ' iframe').attr('src', videoSRCauto);
      $(theModal + ' button.close').click(function() {
        $(theModal + ' iframe').attr('src', videoSRC);
      });
    });
  }

});
  $('.btn-popover').popover({
    container: 'body',
    trigger:'hover',
    animation: true,
    placement: 'bottom'
  });

  $('.btn-popover').on('click', function (e) {
    $('.btn-popover').not(this).popover('hide');
  });



// script for caption fade-in/out
// $("[rel='tooltip']").tooltip();

$('.thumbnail').hover(
  function(){
    $(this).find('.caption').slideDown(250); //.fadeIn(250)
  },
  function(){
    $(this).find('.caption').slideUp(250); //.fadeOut(205)
  }
  );
</script>
<script>

</script>
<script>
  jQuery(document).ready(function($) {


    /*======= Skillset *=======*/


    $('.level-bar-inner').css('width', '0');

    $(window).on('load', function() {

      $('.level-bar-inner').each(function() {

        var itemWidth = $(this).data('level');

        $(this).animate({
          width: itemWidth
        }, 800);

      });

    });



  });
</script>






<script type="text/javascript">

 var usertype = '<?php echo $usertype; ?>';
 var background = '<?php echo $background; ?>';
 var position = '<?php echo $position; ?>';

 var simple = '<?php echo $fn; ?>';
 simple += '<?php echo $ln; ?>';

 if (background == 'original') {

  path = 'img/plain.jpg';

}else {

  if (usertype == "Service Provider") 
  {
    var path = 'user_provider/';
    path+=simple;
    path+='/'+background;

  }else if (usertype == "Service Seeker") {

    var path = 'user_seeker/';
    path+=simple;
    path+=background;
  }else if (usertype == "Company") {

    var path = 'user_company/';
    path+=simple;
    path+=background;
  }

}





$(function() {
  $(".full-background").CoverPhoto({
    currentImage: path,
    editable: true
  });

  $(".full-background").bind('coverPhotoUpdated', function(evt, dataUrl) {

   var pos =  $(".coverphoto-photo-container").children().position(); // returns an object with the attribute top and left
   
   $.ajax({
    type:'post',
    url: 'juju.php',
    data: {
          'name':dataUrl, //dataurl nie basecode64 img
          'position':pos.top //nie position when user move image
        },
        success: function(data){
     //      alert(data);
   }
 });


 });

});






</script>
</body>

</html>

<script type="text/javascript">

  $(document).ready(function(){

    var itik = $('#positionimage').val();

    $(".coverphoto-photo-container").children().css({"position":"relative", "top":itik});

  })

</script>


<script>
  $(document).on('change', '#image_upload_file', function () {
    var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

    $('#image_upload_form').ajaxForm({
      beforeSend: function() {
        progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
      },
      uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
      },
      success: function(html, statusText, xhr, $form) {   
        obj = $.parseJSON(html);  
        if(obj.status){   
          var percentVal = '100%';
          bar.width(percentVal)
          percent.html(percentVal);
          $("#imgArea>img").prop('src',obj.image_medium);     
        }else{
          alert(obj.error);
        }
      },
      complete: function(xhr) {
        progressBar.fadeOut();      
      } 
    }).submit();    

  });
</script>





<!-- work experience -->

<script type="text/javascript">

  $(document).ready(function(){

    $('.add_exp').click(function(){

     $.ajax({
      type:'post',
      url: 'ser_provider/get_job_description.php',
      data: {
        'id':this.id
      },
      dataType: 'json',
      success: function(data){

       $('#myModal_work_det').text(data[0].work_details).wrap('<pre class = "kesah"/>');

       $('#myModal_position').text(data[0].company_position);
       $('#myModal').modal('show'); 

     }
   });


   });
  })

</script>


<style type="text/css">
  .kesah
  {border: 0; background-color: transparent;}

  
</style>

<div class="modal fade" id="modal_add_exp" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Experience</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_exp" method="post" action="ser_provider/add_new_experience.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Company </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="company_name" placeholder="Enter company name" required />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Position </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="company_position" placeholder="Enter position name" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Work </label>
            <div class="col-sm-10">
              <textarea name="work_details" rows="7" placeholder="Enter work details" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "work_start_date" id="work_start_date" class="form-control" placeholder="Start Year" required />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "work_end_date" id="work_end_date" class="form-control" placeholder="End Year" required />
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

    $('.edit_exp').click(function(){

               $('#form_edit_exp')[0].reset(); // reset form on modals

               $.ajax({
                type:'post',
                url: 'ser_provider/get_job_description.php',
                data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id"]').val(json[i].id);
            $('[name="edit_company_name"]').val(json[i].compnay_name);
            $('[name="edit_company_position"]').val(json[i].company_position);
            $('[name="edit_work_details"]').val(json[i].work_details);
            $('[name="edit_work_start_date"]').val(json[i].work_start_date);
            $('[name="edit_work_end_date"]').val(json[i].work_end_date);
            $(".del_btn").attr("id", json[i].id);


          }
          $('#modal_edit_exp').modal('show'); 

        }
      });



             });
  })

</script>





<div class="modal fade" id="modal_edit_exp" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Work Experience</h4>
      </div>
      <div class="modal-body">


        <form id="form_edit_exp" class="form-horizontal" role="form"  method="post" action="ser_provider/edit_experience.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Company </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_company_name" placeholder="Enter company name" required/>
              <input type="hidden" class="form-control" 
              id="" name="id"/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Position </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_company_position" placeholder="Enter position name" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Work </label>
            <div class="col-sm-10">
              <textarea name="edit_work_details" rows="7" placeholder="Enter work details" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_work_start_date" id="edit_work_start_date" class="form-control" placeholder="Start Year" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_work_end_date" id="edit_work_end_date" class="form-control" placeholder="End Year" required/>
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
        <button type="button" id="btndelete_exp" class="del_btn btn btn-danger" data-dismiss="modal">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">

  $(document).ready(function(){

    $('.del_btn').click(function(){

     $.ajax({
      type:'post',
      url: 'ser_provider/delete_experience.php',
      data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });

   });


    $('#work_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#work_end_date').datepicker({
      format: "dd/mm/yyyy"
    });

    $('#edit_work_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#edit_work_end_date').datepicker({
      format: "dd/mm/yyyy"
    });





    $('#project_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#project_end_date').datepicker({
      format: "dd/mm/yyyy"
    });

    $('#edit_project_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#edit_project_end_date').datepicker({
      format: "dd/mm/yyyy"
    });

    $('#edu_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#edu_end_date').datepicker({
      format: "dd/mm/yyyy"
    });

    $('#edit_education_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#edit_education_end_date').datepicker({
      format: "dd/mm/yyyy"
    });


    $('#cert_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#cert_end_date').datepicker({
      format: "dd/mm/yyyy"
    });

    $('#edit_cert_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#edit_cert_end_date').datepicker({
      format: "dd/mm/yyyy"
    });

  })

</script>















<div class="modal fade" id="modal_add_pro" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Project</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_exp" method="post" action="ser_provider/add_new_project.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="project_name" placeholder="Enter project name" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Description </label>
            <div class="col-sm-10">
              <textarea name="project_description" rows="7" placeholder="Enter project description" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "project_start_date" id="project_start_date" class="form-control" placeholder="Start Year" required />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "project_end_date" id="project_end_date" class="form-control" placeholder="End Year" required/>
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

    $('.edit_pro').click(function(){

               $('#form_edit_pro')[0].reset(); // reset form on modals

               $.ajax({
                type:'post',
                url: 'ser_provider/get_project.php',
                data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id_pro"]').val(json[i].id);
            $('[name="edit_project_name"]').val(json[i].project_name);
            $('[name="edit_project_description"]').val(json[i].project_desc);
            $('[name="edit_project_start_date"]').val(json[i].project_sd);
            $('[name="edit_project_end_date"]').val(json[i].project_ed);
            $(".del_btn_pro").attr("id", json[i].id);


          }
          $('#modal_edit_pro').modal('show'); 

        }
      });



             });
  })

</script>


<div class="modal fade" id="modal_edit_pro" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Project</h4>
      </div>
      <div class="modal-body">


        <form id="form_edit_pro" method="post" action="ser_provider/edit_project.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_project_name" placeholder="Enter project name" required/>
              <input type="hidden" class="form-control" 
              id="" name="id_pro"/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Description </label>
            <div class="col-sm-10">
              <textarea name="edit_project_description" rows="7" placeholder="Enter project description" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_project_start_date" id="edit_project_start_date" class="form-control" placeholder="Start Year" required />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_project_end_date" id="edit_project_end_date" class="form-control" placeholder="End Year" required/>
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
        <button type="button" id="btndelete_pro" class="del_btn_pro btn btn-danger" data-dismiss="modal">Delete</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>








<script type="text/javascript">

  $(document).ready(function(){

    $('.del_btn_pro').click(function(){

     $.ajax({
      type:'post',
      url: 'ser_provider/delete_project.php',
      data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });

   });



  })

</script>















<div class="modal fade" id="modal_add_education" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Education</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_education" method="post" action="ser_provider/add_new_education.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="university_name" placeholder="Enter university name" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Level </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="university_level" placeholder="Enter university level" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Study </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="area_study" placeholder="Enter area of study" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Major </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="major_course" placeholder="Enter major course" required/>
            </div>
          </div>


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "edu_start_date" id="edu_start_date" class="form-control" placeholder="Start Year" required />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "edu_end_date" id="edu_end_date" class="form-control" placeholder="End Year" required/>
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

    $('.edit_edu').click(function(){

               $('#form_edit_edu')[0].reset(); // reset form on modals

               $.ajax({
                type:'post',
                url: 'ser_provider/get_education.php',
                data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id_edu"]').val(json[i].id);
            $('[name="edit_university_name"]').val(json[i].university_name);
            $('[name="edit_university_level"]').val(json[i].university_level);
            $('[name="edit_area_study"]').val(json[i].university_study_field);
            $('[name="edit_major_course"]').val(json[i].university_major_course);
            $('[name="edit_education_start_date"]').val(json[i].university_start_date);
            $('[name="edit_education_end_date"]').val(json[i].university_end_date);
            $(".del_btn_edu").attr("id", json[i].id);

          }
          $('#modal_edit_edu').modal('show'); 

        }
      });



             });
  })

</script>



<div class="modal fade" id="modal_edit_edu" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Education</h4>
      </div>
      <div class="modal-body">


        <form id="form_edit_edu" method="post" action="ser_provider/edit_education.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_university_name" placeholder="Enter university name" required/>

              <input type="hidden" class="form-control" 
              id="" name="id_edu"/>

            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Level </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_university_level" placeholder="Enter university level" required/>

            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Study </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_area_study" placeholder="Enter area of study" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Major </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_major_course" placeholder="Enter major course" required/>
            </div>
          </div>



          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_education_start_date" id="edit_education_start_date" class="form-control" placeholder="Start Year" required />
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_education_end_date" id="edit_education_end_date" class="form-control" placeholder="End Year" required />
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
        <button type="button" id="btndelete_edu" class="del_btn_edu btn btn-danger" data-dismiss="modal">Delete</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<script type="text/javascript">

  $(document).ready(function(){

    $('.del_btn_edu').click(function(){

     $.ajax({
      type:'post',
      url: 'ser_provider/delete_education.php',
      data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });

   });



  })

</script>



















<div class="modal fade" id="modal_add_cert" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Certificate</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_cert" method="post" action="ser_provider/add_new_certificate.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="certificate_name" placeholder="Enter certificate name" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Authority </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="issue_authority" placeholder="Enter issue authority" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Description </label>
            <div class="col-sm-10">
              <textarea name="brief_description" rows="7" placeholder="Enter brief description" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "cert_start_date" id="cert_start_date" class="form-control" placeholder="Start Year" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "cert_end_date" id="cert_end_date" class="form-control" placeholder="End Year" required />
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

    $('.edit_cert').click(function(){

               $('#form_edit_cert')[0].reset(); // reset form on modals

               $.ajax({
                type:'post',
                url: 'ser_provider/get_certificate.php',
                data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id_cert"]').val(json[i].id);
            $('[name="edit_certificate_name"]').val(json[i].certificate_Name);
            $('[name="edit_issue_authority"]').val(json[i].certificate_Authority);
            $('[name="edit_brief_description"]').val(json[i].certificate_desc);
            $('[name="edit_cert_start_date"]').val(json[i].certificate_start_date);
            $('[name="edit_cert_end_date"]').val(json[i].certificate_end_date);
            $(".del_btn_cert").attr("id", json[i].id);

          }
          $('#modal_edit_cert').modal('show'); 

        }
      });



             });
  })

</script>



<div class="modal fade" id="modal_edit_cert" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Certificate</h4>
      </div>
      <div class="modal-body">


        <form id="form_edit_cert" method="post" action="ser_provider/edit_certificate.php" class="form-horizontal" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_certificate_name" placeholder="Enter certificate name" required/>

              <input type="hidden" class="form-control" 
              id="" name="id_cert"/>

            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Authority </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" 
              id="" name="edit_issue_authority" placeholder="Enter issue authority" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Description </label>
            <div class="col-sm-10">
              <textarea name="edit_brief_description" rows="7" placeholder="Enter brief description" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Start </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_cert_start_date" id="edit_cert_start_date" class="form-control" placeholder="Start Year" required/>
            </div>
          </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">End </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_cert_end_date" id="edit_cert_end_date" class="form-control" placeholder="End Year" required/>
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

        <button type="button" id="btndelete_cert" class="del_btn_cert btn btn-danger" data-dismiss="modal">Delete</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>







<script type="text/javascript">

  $(document).ready(function(){

    $('.del_btn_cert').click(function(){

     $.ajax({
      type:'post',
      url: 'ser_provider/delete_certificate.php',
      data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });

   });



  })

</script>










<div class="modal fade" id="modal_add_summary" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title-summary">Add Profile Summary</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_education" method="post" action="ser_provider/add_new_summary.php" class="form-horizontal" role="form" enctype="multipart/form-data">


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Summary </label>
            <div class="col-sm-10">
              <textarea name="x" rows="7" placeholder="Enter profile summary" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <input type="hidden" class="form-control" 
          value="<?php echo $id_of_cv; ?>" name="yuyu"/>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>
        </form>


      </div>
      <div class="modal-footer huhu">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<script type="text/javascript">

  $(document).ready(function(){

    $('.edit_summary').click(function(){

      $('.del_btn_summary').remove();


      $.ajax({
        type:'post',
        url: 'ser_provider/get_summary.php',
        data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="yuyu"]').val(json[i].cv_id);
            $('[name="x"]').val(json[i].About_me);
           // $(".del_btn_cert").attr("id", json[i].id);

         }
                      $('.title-summary').text('Edit Profile Summary'); // Set title to Bootstrap modal title
                      var a = $('<button type="button" id="'+json[0].cv_id+'" class="del_btn_summary btn btn-danger" data-dismiss="modal">Delete</button>');
                      $('.huhu').append(a);

                      $('#modal_add_summary').modal('show'); 


                    }
                  });  

    });



  })

</script>


<script type="text/javascript">

  $(document).on('click', '.del_btn_summary', function(){ 

   $.ajax({
    type:'post',
    url: 'ser_provider/delete_summary.php',
    data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });


 });

</script>











<div class="modal fade" id="modal_add_language" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title-language">Add Language</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_education" method="post" action="ser_provider/add_new_language.php" class="form-horizontal" role="form" enctype="multipart/form-data">


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Language </label>
            <div class="col-sm-10">
              <textarea name="add_language" rows="7" placeholder="Enter language" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <input type="hidden" class="form-control" 
          value="<?php echo $id_of_cv; ?>" name="id_language"/>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>
        </form>


      </div>
      <div class="modal-footer hihi">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>








<script type="text/javascript">

  $(document).ready(function(){

    $('.edit_language').click(function(){

      $('.del_btn_language').remove();


      $.ajax({
        type:'post',
        url: 'ser_provider/get_summary.php',
        data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id_language"]').val(json[i].cv_id);
            $('[name="add_language"]').val(json[i].Language);
           // $(".del_btn_cert").attr("id", json[i].id);

         }
                      $('.title-language').text('Edit Language'); // Set title to Bootstrap modal title
                      var a = $('<button type="button" id="'+json[0].cv_id+'" class="del_btn_language btn btn-danger" data-dismiss="modal">Delete</button>');
                      $('.hihi').append(a);

                      $('#modal_add_language').modal('show'); 


                    }
                  });  

    });



  })

</script>






<script type="text/javascript">

  $(document).on('click', '.del_btn_language', function(){ 

   $.ajax({
    type:'post',
    url: 'ser_provider/delete_language.php',
    data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });


 });

</script>

















<div class="modal fade" id="modal_add_interest" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title-interest">Add Interest</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_education" method="post" action="ser_provider/add_new_interest.php" class="form-horizontal" role="form" enctype="multipart/form-data">


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Interest </label>
            <div class="col-sm-10">
              <textarea name="add_interest" rows="7" placeholder="Enter interest" class="form-control" style="min-width: 100%" required></textarea>
            </div>
          </div>

          <input type="hidden" class="form-control" 
          value="<?php echo $id_of_cv; ?>" name="id_interest"/>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>
        </form>


      </div>
      <div class="modal-footer footer-interest">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<script type="text/javascript">

  $(document).ready(function(){

    $('.edit_interest').click(function(){

      $('.del_btn_interest').remove();



      $.ajax({
        type:'post',
        url: 'ser_provider/get_summary.php',
        data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id_interest"]').val(json[i].cv_id);
            $('[name="add_interest"]').val(json[i].Hobbies);
           // $(".del_btn_cert").attr("id", json[i].id);

         }
                      $('.title-interest').text('Edit Interest'); // Set title to Bootstrap modal title
                      var a = $('<button type="button" id="'+json[0].cv_id+'" class="del_btn_interest btn btn-danger" data-dismiss="modal">Delete</button>');
                      $('.footer-interest').append(a);

                      $('#modal_add_interest').modal('show'); 


                    }
                  });  

    });



  })

</script>



<script type="text/javascript">

  $(document).on('click', '.del_btn_interest', function(){ 

   $.ajax({
    type:'post',
    url: 'ser_provider/delete_interest.php',
    data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });


 });

</script>










<div class="modal fade" id="modal_add_skill" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title-skill">Add Skill</h4>
      </div>
      <div class="modal-body">


        <form id="form_add_education" method="post" action="ser_provider/add_new_skill.php" class="form-horizontal" role="form" enctype="multipart/form-data">


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Skill </label>
            <div class="col-sm-10">
              <input type="text" name = "add_skill" placeholder="Enter skill" class="form-control" required />

            </div>
          </div>


                    <input type="hidden" class="form-control" 
          value="<?php echo $fn; ?>" name="fn"/>

                    <input type="hidden" class="form-control" 
          value="<?php echo $ln; ?>" name="ln"/>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>
        </form>


      </div>
      <div class="modal-footer footer-skill">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">

  $(document).ready(function(){

    $('.edit_skill').click(function(){

           $.ajax({
            type:'post',
            url: 'ser_provider/get_skill.php',
            data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(data){

          var json = $.parseJSON(data);

          for (var i=0;i<json.length;++i)
          {

            $('[name="id_skill"]').val(json[i].id);
            $('[name="edit_skill"]').val(json[i].skill_service_provider);
            $(".del_btn_skill").attr("id", json[i].id);

          }

          $('#modal_edit_skill').modal('show'); 

        }
      });  

         });



  })

</script>







<div class="modal fade" id="modal_edit_skill" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title-skill">Edit Skill</h4>
      </div>
      <div class="modal-body">


        <form id="" method="post" action="ser_provider/edit_new_skill.php" class="form-horizontal" role="form" enctype="multipart/form-data">


          <div class="form-group">
            <label  class="col-sm-2 control-label"
            for="">Edit Skill </label>
            <div class="col-sm-10">
              <input type="text" name = "edit_skill" placeholder="Enter skill" class="form-control" required/>

            </div>
          </div>

          <input type="hidden" class="form-control" 
          value="" name="id_skill"/>

          

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Save</button>
            </div>
          </div>
        </form>


      </div>
      <div class="modal-footer footer-skill">

              <button type="button" id="btndelete_skill" class="del_btn_skill btn btn-danger" data-dismiss="modal">Delete</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<script type="text/javascript">

  $(document).on('click', '.del_btn_skill', function(){ 

   $.ajax({
    type:'post',
    url: 'ser_provider/delete_skill.php',
    data: {
          'id':this.id //nie position when user move image
        },
        dataType: 'text',
        success: function(){
          location.reload(true);
        }
      });


 });

</script>



</body>

</html>
