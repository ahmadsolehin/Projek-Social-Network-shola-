<?php

include_once("php_includes/check_login_status.php");
     //Start your session
if(!isset($_SESSION['username']))
{
  header("Location: index.php");
}


   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$userid = $_SESSION['userid'];
$usertype = $_SESSION['user_type'];
$u = $_SESSION['username'];



$varr = $_GET['user'];


$car= preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($varr)); 
$username = html_entity_decode($car,null,'UTF-8');




$_SESSION['wey']  = $_GET['id'];
$user2  = $_GET['id'];



$sql_res=mysqli_query( $db_conx ,"select user_type , avatar,first_name, last_name ,username from users where username like '$username' order by id LIMIT 50")or die(mysqli_error($db_conx));
while($row=mysqli_fetch_array( $sql_res))
{
  $usertype_user=$row['user_type'];
  $profile=$row['avatar'];
  $fn_other=$row['first_name'];
  $ln_other=$row['last_name'];

}
?>













<?php



$position="";
$background="";
$profile="";

$wechat="SELECT position , background , profile FROM useroptions WHERE username ='$username' LIMIT 1";
$kuali = mysqli_query($db_conx, $wechat);
while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
  $position = $row["position"];
  $background = $row["background"];
  $profile = $row["profile"];
}



$summary="";

$sql="SELECT cv_id , About_me FROM cv WHERE username='$username' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
  $summary = $row["About_me"];
    $id_of_cv = $row["cv_id"];

}



$project="SELECT id , project_name, project_desc, project_sd, project_ed FROM projects WHERE username='$username' ";
$proj=mysqli_query($db_conx, $project);



$certificate="SELECT id , certificate_Name, certificate_Authority, certificate_desc, certificate_start_date, certificate_end_date FROM certification WHERE username='$username' ";
$cert=mysqli_query($db_conx, $certificate);

$work_detail="SELECT id , compnay_name, company_position, work_details, work_start_date, work_end_date FROM employment WHERE username='$username' ";
$work=mysqli_query($db_conx, $work_detail);

$education="SELECT id ,  university_name, university_level, university_start_date, university_end_date FROM education WHERE username='$username' ";
$edu=mysqli_query($db_conx, $education);





$language="SELECT Language FROM cv WHERE username='$username' ";
$lang=mysqli_query($db_conx, $language);

while ($row = mysqli_fetch_array($lang, MYSQLI_ASSOC)) {
  $num_lang = $row["Language"];
}


$hobbies="SELECT Hobbies FROM cv WHERE username='$username' ";       
$hobby=mysqli_query($db_conx, $hobbies);  

while ($row = mysqli_fetch_array($hobby, MYSQLI_ASSOC)) {
  $num_interest = $row["Hobbies"];
}


$skills="SELECT Skills FROM cv WHERE username='$username' ";
$skill=mysqli_query($db_conx, $skills);

while ($row = mysqli_fetch_array($skill, MYSQLI_ASSOC)) {
  $num_skill = $row["Skills"];
}

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

             <!--  <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt=""> -->
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
          </div>
        </form>

        <p style="text-align:center"><?php echo $fn_other.' '.$ln_other; ?></p>




      </div>
      <div class="col-md-2 col-sm-2 col-xs-2">
        <a href="#" class="" data-toggle="">

          <!-- <img src="img/user_rating.png" class="img-responsive" alt="">-->
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
      <a href="userprofile_view.php?u=<?php echo $username;?>&id=<?php echo $user2?>">
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
              <h4 ><?php echo $fn_other.' '.$ln_other; ?></h4>

            </div><!--//profile-container-->

            <!--//contact-container-->
            <div class="education-container container-block">
              <h2 class="container-block-title">Education

              </h2>
              <?php
              while ($row = mysqli_fetch_array($edu, MYSQLI_ASSOC)) {

                $university = $row["university_name"];
                $University_level = $row["university_level"];
                $University_study_field = $row["university_study_field"];
                $University_major_course = $row["university_major_course"];
                $University_start_date = $row["university_start_date"];
                $University_end_date = $row["university_end_date"];
                ?>
                <div class="item">

                  <h4 class="degree"><?php echo $university_level; ?>
                  </h4>

                  <h5 class="meta"><?php echo $university; ?></h5>
                  <div class="time"><?php echo $university_start_date; ?> - <?php echo $university_end_date;?></div>
                </div><!--//item-->
                <?php    } ?>

              </div><!--//education-container-->




              <div class="languages-container container-block">

                <h2 class="container-block-title">Languages
                </h2>

                <?php

                $lan = str_replace("\n", "<br/>", $num_lang); 
                ?>

                <ul class="list-unstyled interests-list">
                  <li><?php echo $lan; ?> <span class="lang-desc"> </span></li>
                </ul>

              </div><!--//interests-->







              <div class="interests-container container-block">

                <h2 class="container-block-title">Interests
                </h2>

                <?php 
                $hob = str_replace("\n", "<br/>", $num_interest);

                ?>
                <ul class="list-unstyled interests-list">
                  <li><?php echo $hob; ?></li> <br> 

                </ul>

            </div><!--//interests-->






          </div><!--//sidebar-wrapper-->

          <div class="main-wrapper">

            <div class=" row summary-section" id="summary">

               <h2 class="section-title"><i class="fa fa-user"></i>Career Profile

               </h2>

               <div class="summary">
                <p><?php echo "$summary";?></p>

              </div><!--//summary-->

       </div></br><!--//section--></br> <br><br>




       <div class="row experiences-section" id="experience">

        <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiences
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
       </h2>

       <div class="skillset">

        <?php
        $s = str_replace("\n", "<br/>", $num_skill);
        ?>  
        <div class="item">
          <h3 class="level-title"><?php echo $s; ?></h3>
        </div><!--//item-->

      </div>

</div></br><!--//skills-section-->



<br><br>



<div class="row experiences-section" id="certificates">
  <h2 class="section-title"><i class="fa fa-briefcase"></i>Certificates


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

 var usertype = '<?php echo $usertype_user; ?>';
 var background = '<?php echo $background; ?>';
 var position = '<?php echo $position; ?>';

 var simple = '<?php echo $fn_other; ?>';
 simple += '<?php echo $ln_other; ?>';

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
          editable: false
        })

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


</body>

</html>
