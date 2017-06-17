<!DOCTYPE html>
<html lang="en">

<?php include_once ("header.php"); ?>
  <div class="container">

    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
      <img  style="display: block; margin-left: auto; margin-right: auto " src="img/ukko-img.jpg" class="img-responsive" alt="">
    </div>
    </div>
    <!-- ukko form -->
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4">

    <form name="ukkoregister" action="php_includes/ukko.php" role="form" method="post" >
    <!-- Error Message goes here if the email/username exist -->
      <div class="form-group">


      <span> </span>



      </div>
        <div class="form-group">

            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="ukkoid" id="ukkoid" placeholder="Enter Ukko Number(ID)" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div> </br>

    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="ukkoref" id="ukkoref" placeholder="Enter Ukko Reference Number" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>

        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary btn-block "></br>

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

    <?php include_once ("footer.php"); ?>





  <!-- JS Files here -->
  <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="js/classie.js"></script>
  <script src="js/agency.js"></script>



</body>

</html>
