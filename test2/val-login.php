
<?
include_once("headerlogin.php");
?>

<!DOCTYPE html>
<html lang="en">

  </br>

  <div class="container">

    <!-- Signup form -->
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4">
   <p><h4>Email verification successful</h4></p>
    <p> For quick validation of your accounnt, it is advisable to provide the below information. </p> <br>
    <!-- Multiple Radios -->
            <div style="width:500px;">
       <!-- <button ><a href= "login.php"> <font color="black" > Skip to Login</font></a></button> <br> -->
          <p><h4><a href="login.php"><B>Skip to log in</B></a></h4></p>
    </div> <br>

    </div>
    </div>
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4">
    <p><h4> Do you have an account from ?</h4></p>

    <form name="signup_individual_part_2" action="/bank_detail" id="signup_form_individual_part_2" role="form" method="post" >
    <!-- Error Message goes here if the email/username exist -->
   


      <div class="form-group">

        <div class="col-md-6">
        <div class="radio">
          <label for="eezy">
            <input type="radio" name="radios" id="eezy" value="1" >
            <a href="#" class="btn btn-block btn-primary" style="border:0px;background-color:white">
              <img  src="img/eezy-logo.jpg" class="img-responsive" alt="">
            </a>

          </label>
      	</div>
        <div class="radio">
          <label for="ukko">
            <input type="radio" name="radios" id="ukko" value="2" >
            <a href="#" class="btn btn-block btn-primary" style="border:0px;background-color:white">
              <img  src="img/ukko-logo.png" class="img-responsive" alt="">
            </a>

          </label>
      	</div>
        <div class="radio">
          <label for="No">
            <input type="radio" name="radios" id="No" value="2" checked="checked">

              <p>No


          </label>
      	</div>
        </div>
      </div>


    </form>

    </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4">
      </div>


      <div class="col-md-4 col-sm-4 col-xs-4">
      <div class="form-group">
        <a id ="directpages" href="" >
        <button type="button" id="submitbut"  class="btn btn-primary btn-block" aria-label="Left Button">Submit</button>
      </a>
      </div>

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
          <span> </span>
          
        </p>

        <div class="footer-icons">
<a href="https://www.facebook.com/grezzli.online/?fref=ts"><i class="fa fa-facebook"></i></a>
        <a href="https://www.instagram.com/grezzli_official/"><i class="fa fa fa-instagram"></i></a>
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
  $(document).ready(function(){
    $('#submitbut').click(function() {
      if(document.getElementById("eezy").checked) {
        $('#directpages').attr('href',"eezy.php");
        // document.getElementById("signup_form_individual_part_2").submit();
      }else if(document.getElementById('ukko').checked) {
        $('#directpages').attr('href',"ukkodetails.php");
        // document.getElementById("signup_form_individual_part_2").submit();
      }else{
        $('#directpages').attr('href',"bankdetails.php");
        // document.getElementById("signup_form_individual_part_2").submit();
      }
    });
  });

  </script>



</body

</html>
