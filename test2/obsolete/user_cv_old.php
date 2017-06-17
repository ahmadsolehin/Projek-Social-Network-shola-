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
      
	$summary="";
	$company ="";
	$position1= "";
	$work_details="";
	$start_date="";
	$end_date="";
	$uni_name="";
	$uni_level="";
	$uni_sd="";
	$uni_ed="";
	$certificate="";
	$cert_auth="";
	$csd="";
	$ced="";
	$pn="";
	$pd="";
	$sd1="";
	$ed1="";
	$s="";

  	$c2 = "";
  	$p2 = "";
  	$j2 = "";
  	$ws2 = "";
  	$we2 = "";
     
$sql="SELECT About_me,Compnay_name,Company_position,Work_details,Work_start_date,Work_end_date,  company_2, position_2, job_description_2, work_start_date_2, work_end_date_2,            University_name,University_level,University_start_date,University_end_date,Certificate_Name,Certificate_Authority,Certificate_start_date,Certificate_end_date, Project_name,Project_desc,Project_sdate, Project_edate,Skills FROM cv WHERE username='$u' LIMIT 1";
      $user_query = mysqli_query($db_conx, $sql);
      while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {

	$summary = $row["About_me"];
	$company = $row["Compnay_name"];
	$position1 = $row["Company_position"];
	$work_details = $row["Work_details"];
	$start_date = $row["Work_start_date"];
	$end_date = $row["Work_end_date"];

      $c2 =  $row['company_2'];
      $p2 = $row['position_2'];
      $j2 = $row['job_description_2'];
      $ws2 = $row['work_start_date_2'];
      $we2 = $row['work_end_date_2'];


	$uni_name = $row["University_name"];
	$uni_level = $row["University_level"];
	$uni_sd = $row["University_start_date"];
	$uni_ed = $row["University_end_date"];
	$certificate = $row["Certificate_Name"];
	$cert_auth = $row["Certificate_Authority"];
	$csd = $row["Certificate_start_date"];
	$ced = $row["Certificate_end_date"];
	$pn= $row["Project_name"];
	$pd=$row["Project_desc"];
	$sd1=$row["Project_sdate"];
	$ed1=$row["Project_edate"];
	$s=$row["Skills"];
	
	$pd = str_replace("\n", "<br/>", $pd);
	$work_details = str_replace("\n", "<br/>", $work_details);
	$s = str_replace("\n", "<br/>", $s);
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Grezzli</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- Custom CSS files here -->


  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/header.css">
  <link href="css/agency.css" rel="stylesheet">
  <link href="css/styles-5.css" rel="stylesheet">

  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <!-- Custom Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>



  <style media="screen">
  #navbar-main {
    min-width: 250px;
    padding: 14px 14px 0;
    overflow: hidden;
    background-image: -ms-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: -moz-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: -o-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: -webkit-gradient(radial, center center, 0, center center, 125, color-stop(0, #BDBDBD), color-stop(200, #141413));
    background-image: -webkit-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
    background-image: radial-gradient(ellipse closest-side at center, #BDBDBD 0, #141413 200%);
    opacity: .9
  }

  body,
  html {
    height: 100%;
  }

  body {
    padding-top: 62px;
  }

  .full-background {
    width: 100%;
    height: 100%;
    height: calc(100% - 60%);
    background-image: url('https://c.stocksy.com/a/5HS100/z0/347019.jpg');
    background-size: cover;
  }

  .full-background img {
    width: 100%;
  }

  #profile-photo {
    width: 75%;
    height: 80%;
  }

  #badge-icon {
    width: 75%;
    height: 80%;
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

  <nav class="navbar navbar-default  navbar-fixed-top" role="navigation" id="navbar-main">
    <div class="container">
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navCollapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="fa fa-chevron-down"></span> Menu
        </button>
        <a href="index.html">
          <img width="180" height="60" class="img-responsive" src="img/logo.png" alt="">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="navCollapse">
        <div class="col-sm-4 col-md-4 col-sm-4 col-md-offset-2">
          <form class="navbar-form" role="search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="q">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <ul id="menulist" class="nav navbar-nav navbar-right">
          <li class=""><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
          <li class=""><a href="#"><i class="glyphicon glyphicon-envelope"></i></a></li>
          <li class=""><a href="logout.php"><i class="glyphicon glyphicon-log-out">Logout</i></a></li>  
          <li class=""><a href="http://test.grezzli.com/userprofile.php?"><i class="glyphicon glyphicon-user"></i> <?php echo $fn.' '.$ln; ?></a></li> 


        </div>
      </div>
    </nav>
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

              <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt="">
              <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
              <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
            </a>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-4">
            <a href="#" class="" data-toggle="">

              <img id="badge-icon" src="img/Badge-icon.png" class="img-responsive" alt="">
              <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
              <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
            </a>
          </div>

        </div>

      </div>

      <div class="col-md-3 col-sm-3 col-xs-3">


        <img id="profile-photo" style="margin-top:-5vmax" src="img/anl.jpg" class="img-responsive img-circle" alt="">
        <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
        <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->

      </div>
      <div class="col-md-2 col-sm-2 col-xs-2">
        <a href="#" class="" data-toggle="">

          <img src="img/user_rating.png" class="img-responsive" alt="">
          <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
          <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
        </a>
      </div>

      <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-envelope"></i> </button>
        </a>
        <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
        <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->

      </div>
      <div class="col-md-1 col-sm-1 col-xs-1">

        <a href="#">
          <button style="font-size:1vmax" class="btn btn-primary" type="submit"><i style="color:green" class="glyphicon glyphicon-plus"></i><i style="color:green" class="glyphicon glyphicon-user"></i></button>
        </a>
        <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
        <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->

      </div>


    </div><!-- end of badge/photos section  -->
  </br>
  <div class="row">

    <div class="col-md-4 col-sm-4 col-xs-4 "></div>
    <div class="col-md-3 col-sm-4 col-xs-4 ">
      <a href="userprofile.php">
        <button  style="width:80%" class="btn btn-primary btn-block"> Show Services</button></a>
      </div>
      <div class="col-md-2">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#videoModal" data-theVideo="http://www.youtube.com/embed/loFtozxZG0s">VIDEO CV</a>


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
              <li><a  href="#" title="Download .pdf"><img src="img/user_cv_icon/icn-save.jpg" alt="Download the pdf version" /></a></li>
              <li><a  href="javascript:window.print()" title="Print"><img src="img/user_cv_icon/icn-print.jpg" alt="" /></a></li>
            </ul>
          </div>
        </div>
        <div class="wrapper">
          <div class="sidebar-wrapper">
            <div class="profile-container">
              <img class="profile img-responsive img-circle" src="img/anl.jpg" alt="" >
              <h4 ><?php echo $fn. ' '.$ln;?></h4>
              <h5 class="tagline"><?php echo $position1;?></h5>
            </div><!--//profile-container-->

            <div class="contact-container container-block">
              <ul class="list-unstyled contact-list">
                <li class="email"><i class="fa fa-envelope"></i><a href="mailto: yourname@email.com"><!-- email--></a></li>
                <li class="phone"><i class="fa fa-phone"></i><a href="tel:0123 456 789"></a><!-- phone--></li>
                <li class="website"><i class="fa fa-globe"></i><a href="http://www.grezzli.com/" target="_blank"><!--website or portfolio --></a></li>
                <li class="linkedin"><i class="fa fa-linkedin"></i><a href="#" target="_blank"><!-- linkedin--></a></li>
                <li class="github"><i class="fa fa-github"></i><a href="#" target="_blank"><!--github --></a></li>
                <li class="twitter"><i class="fa fa-twitter"></i><a href="http://www.grezzli.com/" target="_blank"><!--twitter--></a></li>
              </ul>
            </div><!--//contact-container-->
            <div class="education-container container-block">
              <h2 class="container-block-title">Education</h2>
              <div class="item">
                <h4 class="degree"><?php echo $uni_level;?></h4>
                <h5 class="meta"><?php echo $uni_name; ?></h5>
                <div class="time"><?php echo $uni_sd; ?> - <?php echo $uni_ed;?></div>
              </div><!--//item-->
              <div class="item">
               
             </div><!--item-->
            </div><!--education-container-->

            <div class="languages-container container-block">
              <h2 class="container-block-title">Languages</h2>
              <ul class="list-unstyled interests-list">
                <li><span class="lang-desc"></span></li>
                <li><span class="lang-desc"></span></li>
              </ul>
            </div><!--//interests-->

            <div class="interests-container container-block">
              <h2 class="container-block-title">Interests</h2>
              <ul class="list-unstyled interests-list">
                <li>Climbing</li>
                <li>Snowboarding</li>
                <li>Cooking</li>
                <li>Walking</li>
              </ul>
            </div><!--//interests-->

          </div><!--//sidebar-wrapper-->

          <div class="main-wrapper">

            <div class=" row summary-section" id="summary">
              <h2 class="section-title"><i class="fa fa-user"></i>Career Profile</h2>
              <div class="summary">
                <p> <?php echo "$summary";?></p>
              </div><!--//summary-->
            </div></br><!--//section--></br>

            <div class="row experiences-section" id="experience">
              <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiences</h2>

              <div class="item">
                <div class="meta">
                  <div class="row">
                    <div class="col-md-5">
                      <h3 class="job-title"><?php echo "$position1";?></h3><div class="">

                        <?php echo "$start_date";?> - <?php echo "$end_date"; ?></div>
                      </div>
                      <div class="col-md-4"></div>
                      <div class="col-md-3"  style="padding-right:0;padding-left:0;padding-top:0">
                        <div class="thumbnail">
                          <div class="caption">


                            <!-- Trigger the modal with a button -->
                            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                          
                          <a style="text-align:center" href="" class="btn btn-success" data-toggle="modal" data-target="#myModal" rel="tooltip" >Details</a>
                        </div>
                        <img src="img/company_nologo.png" class="img-responsive" alt="...">
                      </div>
                    </div>
                    <!-- <div class="col-md-3">
                    <a id="popover" class="btn-popover " rel="popover" data-content="Describe your role here lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque pena"
                    title="My Role"><img src="img/eezy-logo.jpg"  style="width:100px;height:40px"class="img-responsive" alt=""></a>
                  </div> -->

                </div><!--//upper-row-->


              </div><!--//meta-->
              <div class="details">
              </div><!--//details-->
            </div><!--//item-->
    

        </div></br><!--//section-->



            <div class="row experiences-section" id="experience">
              <h2 class="section-title"><i class="fa fa-briefcase"></i>Another Experiences</h2>

              <div class="item">
                <div class="meta">
                  <div class="row">
                    <div class="col-md-5">
                      <h3 class="job-title"><?php echo "$p2";?></h3><div class="">

                        <?php echo "$ws2";?> - <?php echo "$we2"; ?></div>
                      </div>
                      <div class="col-md-4"></div>
                      <div class="col-md-3"  style="padding-right:0;padding-left:0;padding-top:0">
                        <div class="thumbnail">
                          <div class="caption">


                            <!-- Trigger the modal with a button -->
                            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                          
                          <a style="text-align:center" href="" class="btn btn-success" data-toggle="modal" data-target="#myModal2" rel="tooltip" >Details</a>
                        </div>
                        <img src="img/company_nologo.png" class="img-responsive" alt="...">
                      </div>
                    </div>
                    <!-- <div class="col-md-3">
                    <a id="popover" class="btn-popover " rel="popover" data-content="Describe your role here lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque pena"
                    title="My Role"><img src="img/eezy-logo.jpg"  style="width:100px;height:40px"class="img-responsive" alt=""></a>
                  </div> -->

                </div><!--//upper-row-->


              </div><!--//meta-->
              <div class="details">
              </div><!--//details-->
            </div><!--//item-->
    

        </div></br><!--//section-->



        <!-- Modals for Job Positions and Details -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo "$position1";?></h4>
              </div>
              <div class="modal-body">
                <p> <?php echo "$work_details"?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>


        <div class="modal fade" id="myModal2" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo "$p2";?></h4>
              </div>
              <div class="modal-body">
                <p> <?php echo "$j2"?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>



        <div class="row projects-section" id="projects">
          <h2 class="section-title"><i class="fa fa-archive"></i>Projects</h2>
          <div class="intro">
          
          </div><!--//intro-->
          <div class="item">
            <span class="project-title"><a href="#hook"><!--Project Details -- ></a></span> <span class="project-tagline"> <?php echo $pn; ?></span>

          </div><!--//item-->
          <div class="item">
            <span class="project-title"><a href="http://grezzli.com/" target="_blank"><!--Project Name --></a></span> -
            <span class="project-tagline"><?php echo $pd; ?> <br>
             <?php echo $sd1; ?>- <?php echo $ed1; ?></span>
          </div><!--//item-->
       
              
          
        </div></br><!--//section-->

        <div class=" row skills-section" id="skills">
          <h2 class="section-title"><i class="fa fa-rocket"></i>Skills &amp; Proficiency</h2>
         <?php echo $s; ?> <br>
        </div> <br>

        <div class="row experiences-section" id="certificates">
          <h2 class="section-title"><i class="fa fa-briefcase"></i>Certificates</h2>

          <div class="item">
            <div class="meta">
              <div class="upper-row">
                <h3 class="job-title"><?php echo "$certificate";?></h3>
                <div class="time"><?php echo "$csd";?> - <?php echo "$ced";?></div>
              </div><!--//upper-row-->
              <div class="company"><?php echo "$cert_auth";?></div>
            </div><!--//meta-->
            <div class="details">
              <p><!-- details of certificate--> </p>

            </div><!--//details-->
          </div><!--//item-->


        </div><!--//section-->

      </div><!--//main-body-->
    </div>


  </div>

</div>

</div></br>


<!-- Footer -->

<footer class="footer-distributed">

  <div class="footer-left">

    <h3>
      <img width="180" height="60" class="img-responsive" src="img/logo.png" alt="">
    </a>
  </h3>

  <p class="footer-links">
    <a href="#">Home</a> &middot;
    <a href="#">Blog</a> &middot;
    <a href="#">About</a> &middot;
    <a href="#">Faq</a> &middot;
    <a href="#">Contact</a>
  </p>

  <p class="footer-company-name">Grezzli &copy; 2016</p>
</div>

<div class="footer-center">

  <div>
    <i class="fa fa-map-marker"></i>
    <p>
      <span>Skinnarilankatu</span> 53850 Lappeenranta, Finland</p>
    </div>

    <div>
      <i class="fa fa-phone"></i>
      <p>+358417289202</p>
    </div>

    <div>
      <i class="fa fa-envelope"></i>
      <p><a href="mailto:support@company.com">grezzli.com</a></p>
    </div>

  </div>

  <div class="footer-right">

    <p class="footer-company-about">
      <span>About the company</span>
      Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
    </p>

    <div class="footer-icons">

      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-google-plus"></i></a>

    </div>

  </div>

</footer>







<!-- JS Files here -->
<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/agency.js"></script>

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





</body>

</html>
