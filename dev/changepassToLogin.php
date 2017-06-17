<!DOCTYPE html>
<html lang="en">
<?php include_once("header.php");?>  
<head>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">



  <style media="screen">
    @import url('http://fonts.googleapis.com/css?family=Oswald');


    #video-background {


      z-index: -100;
    }

    article {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: 10px;
    }

    #vidh {
      position: absolute;
      top: 60%;
      width: 100%;
      font-size: 2vmax;
      letter-spacing: 3px;
      color: #fff;
      font-family: Oswald, sans-serif;
      text-align: center;
    }

    .bt-login,.bt-login:hover, .bt-login:active, .bt-login:focus {
      background-color: #ff8627;
      color: #ffffff;
      padding-bottom: 10px;
      padding-top: 10px;
      transition: background-color 300ms linear 0s;
    }


    .login-tab {
     margin: 0 auto;
     width: 90%;
   }

   .login-modal-header {
     background: #27ae60;
     color: #fff;
   }

   .login-modal-header .modal-title {
     color: #fff;
   }

   .login-modal-header .close {
     color: #fff;
   }

   .login-modal i {
     color: #000;
   }

   .login-modal form {
     max-width: 340px;
   }

   .tab-pane form {
     margin: 0 auto;
   }
   .login-modal-footer{
     margin-top:15px;
     margin-bottom:15px;
   }

   /*hoover effects*/
   .custom_hoover1:hover {
    border-radius:50%;
    box-shadow: 0 10px 6px -6px grey;
    -webkit-transform:scale(1.1);
    transform:scale(1.1);
  }
  .custom_hoover1 {
    -webkit-transition: all 0.7s ease;
    transition: all 0.7s ease;
  }

  .custom_hoover2:hover {
    -webkit-box-shadow: 0px 0px 15px 15px #fff;
    /*box-shadow: 0px 0px 15px 15px #fff;*/
    box-shadow: 0px 0px 15px 10px #00FF00;
    border-radius:50%;
    opacity: 1;
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);

  }
  .custom_hoover2 {
    opacity: 1;
    -webkit-transition: all 0.7s ease;
    transition: all 0.7s ease;
  }

  /*parallax effect*/
  .parallax_custom{
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
  /* caption of categories*/
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



  @media screen and (max-width: 480px) {
    #menulist{
      min-width: 250px;
      padding: 14px 14px 0;
      overflow:hidden;
      background-image: -ms-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: -moz-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: -o-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: -webkit-gradient(radial, center center, 0, center center, 125, color-stop(0, #BDBDBD), color-stop(200, #141413));
      background-image: -webkit-radial-gradient(center, ellipse closest-side, #BDBDBD 0, #141413 200%);
      background-image: radial-gradient(ellipse closest-side at center, #BDBDBD 0, #141413 200%);
      opacity: .9
    }
  }
</style>





<style>
body {
    background-size: cover;
    font-family: Montserrat;
}

.logo {
    width: 213px;
    height: 36px;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #F7D83D;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #F7D83D;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #F7D83D;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #F7D83D;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #DCB90C;
}

</style>
</head>
<body>
<div class="logo"></div>
<div class="login-block">
    <h1>Password updated successfully</h1>

   <p> Your password was sucessfully reset . Please <a href="http://test2.grezzli.com/login.php">log in</a> using your new password.</p>

<br>
<br>
<br>


</div>
<?php include_once("footer.php"); ?>
</body>
</html>


  <!-- -Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content login-modal">
        <div class="modal-header login-modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title text-center" id="loginModalLabel">USER REGISTRATION</h4>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <div role="tabpanel" class="login-tab">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"  class="active"><a id="signup-taba" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sign Up</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="profile">
                  <div class ="row">
                  </br>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <a href="service_seeker_reg.php" class="btn btn-block btn-primary"><p style="font-size:12.6px">Service Seeker</p></a>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <a href="service_provider_reg.php" class="btn btn-block btn-primary"><p style="font-size:12.6px">Service Provider</p></a>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <a href="company_reg.php" class="btn btn-block btn-primary"><p style="font-size:12.6px">Company</p></a>
                  </div>
                </div>

              </div>




            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>
<!-- - Login Model Ends Here -->



<!-- JS Files here -->
<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>
<script src="js/agency.js"></script>
<script src="chatbox/chatbox.js"></script>
<script src="js/aos.js"></script>