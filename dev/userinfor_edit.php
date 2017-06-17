<?php
include_once("php_includes/db_conx.php");
session_start();
if(!isset($_SESSION['username']))
{
	header("Location: index.php");
}

    //Read your session (if it is set)
    //if (isset($_SESSION['fname']))
$fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$userid = $_SESSION['userid'];
$u = $_SESSION['username'];
$usertype = $_SESSION['user_type'];



      $sql="SELECT * FROM cv WHERE username='$u' LIMIT 1";
      $user_query = mysqli_query($db_conx, $sql);
      while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {

  $tentang_saya = $row["About_me"];


    $project_name = $row["Project_name"];
    $project_desc = $row["Project_desc"];
    $project_sdate = $row["Project_sdate"];
    $project_edate = $row["Project_edate"];


  $university = $row["University_name"];
  $University_level = $row["University_level"];
  $University_study_field = $row["University_study_field"];
  $University_major_course = $row["University_major_course"];
  $University_start_date = $row["University_start_date"];
  $University_end_date = $row["University_end_date"];

  $company_name = $row["Compnay_name"];
  $company_position = $row["Company_position"];
  $work_details = $row["Work_details"];
  $work_start_date = $row["Work_start_date"];
  $work_end_date = $row["Work_end_date"];


  $certificate_name = $row["Certificate_Name"];
  $certificate_authority = $row["Certificate_Authority"];
  $certificate_des = $row["Certificate_desc"];
  $certificate_start_date = $row["Certificate_start_date"];
  $certificate_end_date = $row["Certificate_end_date"];


    $skillku = $row["Skills"];
  $language = $row["Language"];
  $hobbies = $row["Hobbies"];
  
  }



$position="";
$background="";
$profile="";

$wechat="SELECT position , background , profile FROM useroptions WHERE username='$u' LIMIT 1";
$kuali = mysqli_query($db_conx, $wechat);
while ($row = mysqli_fetch_array($kuali, MYSQLI_ASSOC)) {
	$position = $row["position"];
	$background = $row["background"];
	$profile = $row["profile"];
}


if(isset($_POST["submit"])){


      $profile_summary = mysqli_real_escape_string($db_conx, $_POST['profile_summary']);

      $c = mysqli_real_escape_string($db_conx, $_POST['company']);
      $p = mysqli_real_escape_string($db_conx, $_POST['position']);
      $j = mysqli_real_escape_string($db_conx, $_POST['job_description']);
      $ws = mysqli_real_escape_string($db_conx, $_POST['work_start_date']);
      $we = mysqli_real_escape_string($db_conx, $_POST['work_end_date']);
      
      $un = mysqli_real_escape_string($db_conx, $_POST['university']);
      $el = mysqli_real_escape_string($db_conx, $_POST['education_level']);
      $sf = mysqli_real_escape_string($db_conx, $_POST['study_field']);
      $mc = mysqli_real_escape_string($db_conx, $_POST['major_course']);
      $s = mysqli_real_escape_string($db_conx, $_POST['work_start_date_2']);
      $e = mysqli_real_escape_string($db_conx, $_POST['work_end_date_2']);

      $project_name = mysqli_real_escape_string($db_conx, $_POST['project_name']);
      $project_description = mysqli_real_escape_string($db_conx, $_POST['project_description']);
      $project_start_date = mysqli_real_escape_string($db_conx, $_POST['project_start_date']);
      $project_end_date = mysqli_real_escape_string($db_conx, $_POST['project_end_date']);

      $certificate_name = mysqli_real_escape_string($db_conx, $_POST['certificate_name']);
      $certificate_authority = mysqli_real_escape_string($db_conx, $_POST['certificate_authority']);
      $certificate_desc = mysqli_real_escape_string($db_conx, $_POST['certificate_des']);
      $certificate_start_date = mysqli_real_escape_string($db_conx, $_POST['certificate_start_date']);
      $certificate_end_date = mysqli_real_escape_string($db_conx, $_POST['certificate_end_date']);
      
      $hobbies = mysqli_real_escape_string($db_conx, $_POST['hobbies']);
      
      $language = mysqli_real_escape_string($db_conx, $_POST['language']);

      $skills = mysqli_real_escape_string($db_conx, $_POST['skills_input']);


      $sql = "UPDATE cv SET About_me='$profile_summary', Hobbies='$hobbies', Language='$language', University_name ='$un', University_level='$el', University_study_field='$sf', University_major_course='$mc', University_start_date='$s', University_end_date='$e',  Compnay_name='$c', Company_position='$p', Work_details='$j', Work_start_date='$ws', Work_end_date='$we', company_2='$c2', position_2='$p2', job_description_2='$j2', work_start_date_2='$ws2', work_end_date_2='$we2', Project_name='$project_name', Project_desc='$project_description', Project_sdate='$project_start_date', Project_edate='$project_end_date', Certificate_Name='$certificate_name', Certificate_Authority='$certificate_authority', Certificate_desc='$certificate_desc',  Certificate_start_date='$certificate_start_date', Certificate_end_date='$certificate_end_date', Skills='$skills'  WHERE username ='$u' LIMIT 1";
              $query = mysqli_query($db_conx, $sql);


              header("location: user_cv_new.php");
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


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>


	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- Custom CSS files here -->

	<link rel="stylesheet" href="css/kopi.css">
	<link rel="stylesheet" href="coverphoto/coverphoto.css">

	<style type="text/css">
		.coverphoto, .output {
			width: 1024px;
			height: 200px;
			border: 1px solid black;
			margin: 10px auto;
		}
	</style>

	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/header.css">
	<link href="css/agency.css" rel="stylesheet">
	<link href="chatbox/chatbox.css" rel="stylesheet">

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
				<a href="userprofile.php">
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
					<li class=""><a href="newsfeed_version1.php"><i class="glyphicon glyphicon-home"></i><B>Home</B></a></li>
					<li class=""><a href="#"><i class="glyphicon glyphicon-envelope"></i></a></li>
					<li class=""><a href="logout.php"><i class="glyphicon glyphicon-log-out"><B>Logout</B></i></a></li>  
					<li class=""><a href="userprofile.php?"><i class="glyphicon glyphicon-user"></i><B><?php echo $fn; ?></B></a></li> 

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

	<p style="text-align:center"><?php echo $fn .' '. $ln; ?></p>

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



		<div class="col-md-9 col-sm-9 col-xs-9">


			<div class="row">

				<div class="row">
					<div class="col-md-2 col-sm-2 col-xs-1">
					</div>
					<div class="col-md-8 col-sm-8 col-xs-10">
						<br>
						<p>Edit User Details</p>
						<!-- form collapse goes here -->
						<form action="userinfor_edit.php" role="form" method="post">


							<br>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#home">SUMMARY</a></li>
								<li><a data-toggle="tab" href="#menu1">WORK EXPERIENCE</a></li>
								<li><a data-toggle="tab" href="#menu2">EDUCATION</a></li>
								<li><a data-toggle="tab" href="#menu3">PROJECTS</a></li>
								<li><a data-toggle="tab" href="#menu4">CERTIFICATES</a></li>
								<li><a data-toggle="tab" href="#menu5">SKILLS & PRFICIENCY</a></li>
								<li><a data-toggle="tab" href="#menu6">LANGUAGES</a></li>
								<li><a data-toggle="tab" href="#menu7">HOBBIES</a></li>
							</ul>

							<div class="tab-content">
								<div id="home" class="tab-pane fade in active">

									<br>


									<div class="form-group">
										<label class="col-md-4 control-label" >Profile Summary</label>
										<div class="col-md-8">
											<textarea class="form-control" rows="5" name="profile_summary"><?php echo $tentang_saya; ?></textarea>
										</div>
									</div>

									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">

								</div>
								<div id="menu1" class="tab-pane fade">

									<br>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="company_name" value = "<?php echo $company_name; ?>" name="company" placeholder="Enter Company Name" >

										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="position" name="position" value = "<?php echo $company_position; ?>" placeholder="Position name" >

										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class=""></span></div> Job Description
											<textarea rows="9" cols="47"  name="job_description" placeholder="Job Description" required> <?php echo $work_details; ?> </textarea>

										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-calendar"></span></div>
											<div class="input-group">
												<input type="text" value=" <?php echo $work_start_date; ?>" name = "work_start_date" id="work_start_date" class="form-control" placeholder="Start Year" />
												<span class="input-group-addon">-</span>
												<input type="text" value=" <?php echo $work_end_date; ?>" name = "work_end_date" id="work_end_date" class="form-control" placeholder="End Year" />
											</div>
										</div>

									</div>

									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">

								</div>
								<div id="menu2" class="tab-pane fade">

									<br>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="university_name" value="<?php echo $university; ?>" name="university" placeholder="University name" >
										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="education_level" value = "<?php echo $University_level; ?>" name="education_level"  placeholder="University level" >

										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="study_field" value = "<?php echo $University_study_field; ?>" name="study_field" placeholder="Area of study" >

										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="major_course" value = "<?php echo $University_major_course; ?>" name="major_course" placeholder="Enter Major Courses" >

										</div>

									</div>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-calendar"></span></div>
											<div class="input-group">
												<input type="text" name = "work_start_date_2" id="work_start_date_2" class="form-control" value = "<?php echo $University_start_date; ?>" placeholder="Start Year" />
												<span class="input-group-addon">-</span>
												<input type="text" value = "<?php echo $University_end_date; ?>" name = "work_end_date_2" id="work_end_date_2" class="form-control" placeholder="End Year" />
											</div>
										</div>

									</div>

									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">

								</div>
								<div id="menu3" class="tab-pane fade">

									<br>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="" name="project_name" value = "<?php echo $project_name; ?>" placeholder="Enter project name" >

										</div>

									</div>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class=" "></span></div> Project Description
											<textarea rows="9" cols="47"  name="project_description" placeholder="Project Description" required>  <?php echo $project_desc; ?> </textarea>

										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-calendar"></span></div>
											<div class="input-group">
												<input type="text" name = "project_start_date" value = "<?php echo $project_sdate; ?>" id="project_start_date" class="form-control" placeholder="Start Year" />
												<span class="input-group-addon">-</span>
												<input type="text" value = "<?php echo $project_edate; ?>" name = "project_end_date" id="project_end_date" class="form-control" placeholder="End Year" />
											</div>
										</div>

									</div>

									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">

								</div>


								<div id="menu4" class="tab-pane fade">

									<br>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>
											<input type="text" class="form-control" id="" name="certificate_name" value = "<?php echo $certificate_name; ?>" placeholder="Enter certificate name" >

										</div>

									</div>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-university"></span></div>  
											<input type="text" class="form-control" id="" name="certificate_authority" value="<?php echo $certificate_authority; ?>" placeholder="Issuing Authority" >
										</div>

									</div>
									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class=""></span></div>  
											<input type="text" class="form-control" id="" name="certificate_des" value="<?php echo $certificate_des; ?>" placeholder="Brief Description" >
										</div>

									</div>

									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class="fa fa-calendar"></span></div>
											<div class="input-group">
												<input type="text" value="<?php echo $certificate_start_date; ?>" name = "certificate_start_date" id="certificate_start_date" class="form-control" placeholder="Start Year" />
												<span class="input-group-addon">-</span>
												<input type="text" value="<?php echo $certificate_end_date; ?>" name = "certificate_end_date" id="certificate_end_date" class="form-control" placeholder="End Year" />
											</div>
										</div>

									</div>

									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">


								</div>


								<div id="menu5" class="tab-pane fade">
									<br>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon"><span></span></div>
				
											<textarea rows="9" cols="47" name="skills_input" placeholder=""> <?php echo $skillku; ?> </textarea>
										</div>
									</div>
									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">
								</div>



								<div id="menu6" class="tab-pane fade">

									<br>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class=" "></span></div>
											<textarea rows="9" cols="47"  name="language" placeholder="Languages" > <?php echo $language; ?> </textarea>

										</div>

									</div>

									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">

								</div>


								<div id="menu7" class="tab-pane fade">

									<br>


									<div class="form-group">

										<div class="input-group">
											<div class="input-group-addon"><span class=" "></span></div>
											<textarea rows="9" cols="47"  name="hobbies" placeholder="Hobbies"> <?php echo $hobbies; ?> </textarea>

										</div>

									</div>

									<input type="submit" name="submit" id="submit" value="Save" class="btn btn-primary">


								</div>


							</div>





						</form>

					</div>

				</div>


			</div>



		</div>
		<!--  advertisement and top services section-->
		<div class="col-md-3 col-sm-3 col-xs-3">


			<div class="row">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h5 class="section-heading">Trending Services</h5>
						<!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
					</div>
				</div>


				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
						<a href="#" class="" data-toggle="">

							<img src="img/portfolio/roundicons.png" class="img-responsive" alt="">
						</a>
						<div class="">

							<p class="text-muted">Graphic Design</p>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
						<a href="#" class="" data-toggle="">

							<img src="img/portfolio/roundicons.png" class="img-responsive" alt="">
						</a>
						<div class="">

							<p class="text-muted">Graphic Design</p>
						</div>
					</div>

				</div>

			</div>

			<!-- Advertisements  -->
			<div class="row">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h5 class="section-heading">ADS</h5>
						<!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
					</div>
				</div>

			</div>

		</div>
	</div>

</div></br>


<!-- Footer -->
<?php include_once ("footer.php"); ?>


<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/agency.js"></script>

<script src="coverphoto/coverphoto.js"></script>

<script src="js/jquery.form.js"></script> 



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
</script>
<script>
    // $(document).ready(function(){
    //   // $('#popover').popover();
    //
    //   $('#popover').popover();
    //
    //   $('#popover').on('click', function (e) {
    //       $('#popover').not(this).popover('hide');
    //   });
    // });
    $(document).ready(function(){

    	$('.btn-popover').popover({
    		trigger:'hover',
    		animation: false,
    		placement: 'auto right'
    	});

    	$('.btn-popover').on('click', function (e) {
    		$('.btn-popover').not(this).popover('hide');
    	});

    	$('#uni_start_date').datepicker({
    		format: "dd/mm/yyyy"
    	});

    	$('#uni_end_date').datepicker({
    		format: "dd/mm/yyyy"
    	});

    	$('#work_start_date').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#work_end_date').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#work_start_date_2').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#work_end_date_2').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#project_start_date').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#project_end_date').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#certificate_start_date').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#certificate_end_date').datepicker({
    		format: "dd/mm/yyyy"
    	});



    	$('#certficate_start_date').datepicker({
    		format: "dd/mm/yyyy"
    	});
    	$('#certficate_start_date').datepicker({
    		format: "dd/mm/yyyy"
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
			path+='/'+background;
		}else if (usertype == "Company") {

			var path = 'user_company/';
			path+=simple;
			path+='/'+background;
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