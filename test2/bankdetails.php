<!DOCTYPE html>
<html lang="en">

<?php include_once ("header.php"); ?>
  <div class="container">


    <style>
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

    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-1">
      </div>
      <div class="col-md-8 col-sm-8 col-xs-10">

        <!--<div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:30%">30% Complete

          </div>
        </div>-->
      </div>

    </div>
    <!--form container  -->
    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-1">
      </div>
      <div class="col-md-8 col-sm-8 col-xs-10">
        <p>Please fill following fields</p>
        <!-- form collapse goes here -->
        <form name="bankform" action="php_includes/bankdetails.php" role="form" method="post">

          <div class="panel-group" id="accordion">
            <!-- This Panel is for Bank Details -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#bank_detail">
                    Bank Detail
                  </a>
                </h4>
              </div>
              <div id="bank_detail" class="panel-collapse collapse in">
                <div class="panel-body">

                  <div class="form-group">

                    <div class="input-group">
                      <div class="input-group-addon"><span class="fa fa-university"></span></div>
                      <input type="text" class="form-control" id="bankid" name="bank_id"  placeholder="Enter Bank ID" required>
                      <div class="input-group-addon">
                        <a id="popover" class="fa fa-info-circle fa-xs  btn-popover " rel="popover" data-content="That requires because of" title="Providing this means:"></a>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">

                    <div class="input-group">
                      <div class="input-group-addon"><span class="fa fa-credit-card-alt"></span></div>
                      <input type="text" class="form-control" id="taxcard" name="taxcard" placeholder="Enter Taxcard number" required>
                      <div class="input-group-addon">
                        <a id="popover" class="fa fa-info-circle fa-xs  btn-popover " rel="popover" data-content="That requires because of" title="Choosing This Means:"></a>
                      </div>
                      <!--
                      <div class="input-group-addon"><p><a id="popover" class="btn btn-popover" rel="popover" data-content="That requires because of" title="Choosing This Means:">
                      <span class="fa fa-info-circle"></span></a></p></div> -->

                    </div>

                  </div>
                  <div class="form-group">

                    <div class="input-group">
                      <div class="input-group-addon"><span class="fa fa-user"></span></div>
                      <input type="text" class="form-control" id="ssc_number" name="ssn_number"  placeholder="Enter Social security number" required>
                      <div class="input-group-addon">
                        <a id="popover" class="fa fa-info-circle fa-xs  btn-popover " rel="popover" data-content="That requires because of" title="Choosing This Means:"></a>
                      </div>
                    </div>

                  </div>



                </div>
              </div>
            </div>


                      </br>

                      <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-block ">
                    </br>

                  </div>
                </form>

              </div>

            </div>




    <!-- <% if(true){ %>
   <h1>foo</h1>
 <% } else{ %>
   <h1>bar</h1>
<% } %> -->
  </div>
  </br>


  <!-- Footer -->
  <div>
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

 </div>





  <!-- JS Files here -->
  <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

  <script src="js/classie.js"></script>
  <script src="js/agency.js"></script>
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
    $('#certficate_start_date').datepicker({
      format: "dd/mm/yyyy"
    });
    $('#certficate_start_date').datepicker({
      format: "dd/mm/yyyy"
    });

  });

  </script>


</body>


</html>
