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
      $c = $_SESSION['comapny_name'];

     $u = $_SESSION['username'];
       $usertype = $_SESSION['user_type'];

      


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



    $computer="SELECT * FROM company WHERE username='$u' ORDER BY id LIMIT 1 ";
      $comp = mysqli_query($db_conx, $computer);



  $pictu="SELECT product_pic FROM company WHERE username='$u' ";
      $pikachu = mysqli_query($db_conx, $pictu);
      
     
?>


<!DOCTYPE html>
<html lang="en">


  <!-- Include jQuery library -->

<?php include_once ("headerlogin.php"); ?>

  <link rel="stylesheet" href="style.css">
  <link href="css/styles-5.css" rel="stylesheet">


  <style media="screen">
   
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

        <p style="text-align:center"><?php echo $fn.' '.$ln; ?></p>

      </div>
      <div class="col-md-2 col-sm-2 col-xs-2">
        <a href="#" class="" data-toggle="">

          <img src="img/user_rating.png" class="img-responsive" alt="">
          <!-- <div class="col-md-2"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="This badge indicates..." title="Choosing This Means:">
          <i class="fa fa-2x fa-info-circle"></i></a></p></div> -->
        </a>
      </div>

  <!--     <div class="col-md-1 col-sm-1 col-xs-1">

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
        <a href="companyprofile.php">
      <button  style="width:80%" class="btn btn-primary btn-block"> Show Profile</button></a>
      </div>
      <div class="col-md-2">
       <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#videoModal" data-theVideo="http://www.youtube.com/embed/loFtozxZG0s">VIDEO CV</a> -->


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

          <!--form container  -->
          <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-1">
            </div>
            <div class="col-md-8 col-sm-8 col-xs-10">
              <p>Please fill following fields</p>
              <!-- form collapse goes here -->
              <form enctype="multipart/form-data" id="formid" role="form" method="post">


                       <?php
  while ($row = mysqli_fetch_array($comp, MYSQLI_ASSOC)) {
        $about = $row["about"];
  $loc = $row["location"];
  $w = $row["website"];
      }
      ?>

         
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">ABOUT US</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">

                  <div class="form-group">
                    <label class="col-md-4 control-label" >About us</label>
                    <div class="col-md-8">
                      <textarea class="form-control" rows="5" name="about"><?php echo $about; ?></textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>







          <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">WEBSITE</a>
                </h4>
              </div>
              <div id="collapse9" class="panel-collapse collapse">
                <div class="panel-body">


                <div class="form-group">

                  <div class="input-group">
                    <div class="input-group-addon"><span class=" "></span></div>
                    <textarea rows="9" cols="47"  name="website" placeholder="website"> <?php echo $w; ?> </textarea>

                  </div>

                </div>


              </div>
            </div>
          </div>






              
              
               <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">LOCATION</a>
                </h4>
              </div>
              <div id="collapse7" class="panel-collapse collapse">
                <div class="panel-body">


                <div class="form-group">

                  <div class="input-group">
                    <div class="input-group-addon"><span class=" "></span></div>
                    <textarea rows="9" cols="47"  name="location" placeholder="location"> <?php echo $loc; ?> </textarea>

                  </div>

                </div>


              </div>
            </div>
          </div>






                         <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">PRODUCT</a>
                </h4>
              </div>
              <div id="collapse8" class="panel-collapse collapse">
                <div class="panel-body">




  <div class="col-md-6">
    <ul id="mylist" class="list-group">

    <?php 

    if ( $pikachu == '') {
      
      ?>

      hhtjthj

      <?php
    }

    ?>


<?php  
      while ($row = mysqli_fetch_array($pikachu, MYSQLI_ASSOC)) {
      $pc= $row["product_pic"];
    
      ?>


       <?php 

    if ( $pc != '') {
      
      ?>

              <li id="<?php echo $pc; ?>" href="#" class="list_delete list-group-item">

          <img width = "50px" height="50px" src="<?php echo $pc; ?>">

         <i class="fa fa-remove fa-2x pull-right" style="color: red;"></i> 

        </li>

      <?php
    }

    ?>



               <?php } ?>


    </ul>
</div>


<style type="text/css">
  
  .fa-remove{
    font-size:22px;
    padding-left:10px;
    margin-top:-3px
}

</style>

                <div class="form-group">

                  <div class="input-group">
           

            <input type="file" name="files[]" id="rest" multiple="multiple">

                  </div>

                </div>


              </div>
            </div>
          </div>
          
          
          

          
          
          



        </div>

                                    <input name="submit" id="submit" value="Submit" class="btn btn-primary btn-block ">

        

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
<?php include_once("footer.php"); ?>



<input type = "hidden" value = "<?php echo $position; ?>" id = "positionimage">


  <script src="coverphoto/jquery.js"></script>
  <script src="coverphoto/jquery-ui.custom.min.js"></script>

<!-- JS Files here -->
<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/agency.js"></script>



    
      <script src="coverphoto/coverphoto.js"></script>

<script src="js/jquery.form.js"></script> 






<script>
  $(document).ready(function() {


    $('#submit').click(function(){

      var imgVal = $('#rest').val(); 

      if(imgVal=='') 
      { 

                var formData = new FormData($("#formid")[0]);

        $.ajax({
          type:'post',
          url: 'company_edit_info_upload_v2.php',
          data:formData,
          processData: false,
          contentType: false,
          success: function(){

window.location.href = "http://test2.grezzli.com/companyprofile.php";

         }
       });


      }else{

        var formData = new FormData($("#formid")[0]);

        $.ajax({
          type:'post',
          url: 'company_edit_info_upload.php',
          data:formData,
          processData: false,
          contentType: false,
          success: function(){
window.location.href = "http://test2.grezzli.com/companyprofile.php";
         }
       });
      }


    })

  });
</script>



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








  <!-- for multiple img -->
  <link href="css/jquery.filer.css" rel="stylesheet">
  <script src="js/jquery.filer.min.js" type="text/javascript"></script>
  <script src="js/custom.js" type="text/javascript"></script>
</body>

</html>


                  <script type="text/javascript">
                    
                    $('.list_delete').click(function(){

var that = $(this);

        $.ajax({
            type:'POST',
            url:'delete_multiple_Image.php',
            data:{'del_id':this.id},
            success: function(data){
                 if(data=="YES"){
                    that.remove();
                 }else{
                        alert("can't delete the row")
                 }
             }

            });
        




                    })
                  </script>