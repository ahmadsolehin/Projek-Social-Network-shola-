<?php
session_start();

$link = mysqli_connect("localhost", "grezzejn", "kEb!wkP+wNs64x", "grezzejn_social_b");
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$config['callback_url']         =   'https://www.grezzli.com/company_reg.php'; //Your callback URL
$config['Client_ID']      =   '81x0yp9vak6wzt'; // Your LinkedIn Application Client ID
$config['Client_Secret']      =   'YvwtZMq3Jj0EBbz8';  // Your LinkedIn Application Client Secret
?>

<?php

if(isset($_GET['code'])) // get code after authorization
{
  $url = 'https://www.linkedin.com/uas/oauth2/accessToken'; 
  $param = 'grant_type=authorization_code&code='.$_GET['code'].'&redirect_uri='.$config['callback_url'].'&client_id='.$config['Client_ID'].'&client_secret='.$config['Client_Secret'];
    $return = (json_decode(post_curl($url,$param),true)); // Request for access token

if($return['error']) // if invalid output error
{
 $content = 'Some error occured<br><br>'.$return['error_description'].'<br><br>Please Try again.';
}
    else // token received successfully
    {
     $url = 'https://api.linkedin.com/v1/people/~:(id,firstName,lastName,pictureUrls::(original),headline,publicProfileUrl,location,industry,positions,email-address)?format=json&oauth2_access_token='.$return['access_token'];
       $User = json_decode(post_curl($url)); // Request user information on received token
       
     //  echo "<pre>";
     //  print_r($User);

       $nama_pertama = $User->firstName;
       $nama_akhir = $User->lastName;
       $emel = $User->emailAddress;
       $pictureUrls = $User->pictureUrls->values[0];
       $folder_nama= $nama_pertama.$nama_akhir;

       $emelcheck = mysqli_query($link , "SELECT email FROM users WHERE email='$emel' LIMIT 1");
       $count_emel = mysqli_num_rows($emelcheck);

       if($count_emel!=0)
       {

        ?>

        <script language='Javascript'>
          alert('Already register using Linkedin..');
          location.href='index.php';

        </script>

        <?php

        die();
      }else{


        $sql = "INSERT INTO users (user_type, first_name, last_name, username, email, password, gender, country, city, avatar ,  signup, lastlogin, notescheck,   activated , security_question, security_answer)   VALUES('Company','$nama_pertama','$nama_akhir','$folder_nama','$emel','','','','', '$pictureUrls' ,now(),now(),now(),'1','' , '')";

        $query = mysqli_query($link,$sql); 
        $uid = mysqli_insert_id($link);


        $sqlite = "INSERT INTO useroptions (id, username, background , profile) VALUES ('$uid','$folder_nama','original' , '$pictureUrls')";

        $queryy = mysqli_query($link, $sqlite);


        $sqlcv = "INSERT INTO cv (cv_id, username) VALUES ('$uid','$folder_nama')";
        $query3 = mysqli_query($link, $sqlcv);


    // Create directory(folder) to hold each user's files(pics, MP3s, etc.)
  if (!file_exists('/home/grezzejn/public_html/user_company/'. $folder_nama)) {
    mkdir('/home/grezzejn/public_html/user_company/'. $folder_nama, 0755);
    
    }
        ?>

              <script language='Javascript'>
        alert('Congratulation.. Register with Linkedin success!');

        location.href='index.php';
      </script>

      <?php

      }



    }
  }

  function post_curl($url,$param="")
  {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    if($param!="")
      curl_setopt($ch,CURLOPT_POSTFIELDS,$param);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
  }

  ?>


<?php

  # Autoload the required files
require_once __DIR__ . '/vendor/autoload.php';

  # Set the default parameters
$fb = new Facebook\Facebook([
  'app_id' => '128341554340886',
  'app_secret' => '29822f50e0600e2bd781f790244704d1',
  'default_graph_version' => 'v2.8',
  ]);
$redirect ='https://www.grezzli.com/company_reg.php';


  # Create the login helper object
$helper = $fb->getRedirectLoginHelper();

  # Get the access token and catch the exceptions if any
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

  # If the 
if (isset($accessToken)) {
      // Logged in!
    // Now you can redirect to another page and use the
      // access token from $_SESSION['facebook_access_token'] 
      // But we shall we the same page

    // Sets the default fallback access token so 
    // we don't have to pass it to each request
  $fb->setDefaultAccessToken($accessToken);

  try {
    $response = $fb->get('/me?fields=email,first_name,last_name,name');
    $userNode = $response->getGraphUser();
  }catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }


  $name = $userNode->getName();
  $email = $userNode->getProperty('email');
  $firstName = $userNode->getProperty('first_name');
  $lastName = $userNode->getProperty('last_name');
  $image = 'https://graph.facebook.com/'.$userNode->getId().'/picture?width=200';
      $folder_name= $firstName.$lastName;



  $emailcheck = mysqli_query($link , "SELECT email FROM users WHERE email='$email' LIMIT 1");
  $count = mysqli_num_rows($emailcheck);

  if($count!=0)
  {

    ?>

    <script language='Javascript'>
      alert('Already register using facebook..');
      location.href='index.php';

    </script>

    <?php


    die();
  }else{

    $sql = "INSERT INTO users (user_type, first_name, last_name, username, email, password, gender, country, city, avatar ,  signup, lastlogin, notescheck,   activated , security_question, security_answer)   VALUES('Company','$firstName','$lastName','$name','$email','','','','', '$image' ,now(),now(),now(),'1','' , '')";

    $query = mysqli_query($link,$sql); 
    $uid = mysqli_insert_id($link);



    $sqlite = "INSERT INTO useroptions (id, username, background , profile) VALUES ('$uid','$name','original' , '$image')";

    $queryy = mysqli_query($link, $sqlite);


    $sqlcv = "INSERT INTO cv (cv_id, username) VALUES ('$uid','$name')";
    $query3 = mysqli_query($link, $sqlcv);


    // Create directory(folder) to hold each user's files(pics, MP3s, etc.)
  if (!file_exists('/home/grezzejn/public_html/user_company/'. $folder_name)) {
    mkdir('/home/grezzejn/public_html/user_company/'. $folder_name, 0755);
    
    }
    

    ?>


    <script language='Javascript'>
      alert('Congratulation.. Register with facebook success!');

      location.href='index.php';
    </script>

    <?php
  }





}else{
  $permissions  = ['email'];
  $loginUrl = $helper->getLoginUrl($redirect,$permissions);
}


?>


<?php include_once ("header_reg.php"); ?>

  <div class="container">
    <div class="row">

      <div class="col-md-4 col-sm-4 col-xs-4">
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4">

    <span id="registration_fail" class="response_error" style="display: none;">Registration failed, please try again.</span>
    <div class="row">
      <div class="col-md-5">
          <a class="btn btn-block btn-social btn-facebook" href="<?php echo $loginUrl; ?>">
            <span class="fa fa-facebook"></span> Facebook
          </a>
      </div>
      <div class="col-md-2">
      </div>
      <div class="col-md-5">
        
        <?php
            echo '<a class="btn btn-block btn-social btn-linkedin" href="https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id='.$config['Client_ID'].'&redirect_uri='.$config['callback_url'].'&state=98765EeFWf45A53sdfKef4233&scope=r_basicprofile r_emailaddress">    <span class="fa fa-linkedin"></span> Linkedin </a>';
            ?>


      </div>

    </div>

    <div class="row">
      <div class="col-md-5">
    </div>
      <div class="col-md-2">
        <p>OR</p>
      </div>
      <div class="col-md-5">

      </div>

    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    <!-- Signup form -->
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4">

    <form name="signup_individual_part_1" action="php_includes/signup_company_reg.php" role="form" method="post" >
    <!-- Error Message goes here if the email/username exist -->
      <div class="form-group">


     <!-- <span><%= errorMessage %></span> -->



      </div>
        <div class="form-group">

            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="InputCompanyName" id="Company" placeholder="Enter Company Name" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div> </br>
      

         <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="InputCompanyNumber" id="CompanyNumber" placeholder="Enter Company Registration Number" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div> </br>


            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="InputFName" id="InputFName" placeholder="Enter First Name" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div> </br>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="InputLName" id="InputLName" placeholder="Enter Last  Name" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
        </div>
        
       <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-user"></i></div>
          <input type="text" class="form-control" name="username" autocomplete="off" id="username" placeholder="Enter Username" required>
          <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
        </div> 

        <span id="result"></span>


      </br>



              <div class="form-group">

        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
          
          
          <input id="emailchecker" placeholder="Enter email" class="form-control classname" autocomplete="off"  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="InputEmail" readonly type="email" onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly');
    // fix for mobile safari to show virtual keyboard
    this.blur();    this.focus();  }" />

    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
  </div>

</div>

<span id="displayemail"></span>

<style type="text/css">

  input[readonly].classname{
    background-color:transparent;
    font-size: 1em;
  }

</style>
            
     

      
        <div class="form-group">
          <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-lock"></i></div>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
          </div>
          <!-- <span class="help-block has-error" id="password-error"></span> -->
        </div>
      
        <!-- Select Country -->
        <div class="form-group">
      <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="selectbasic">Country</label>
      <div class="col-md-8 col-sm-8 col-xs-8 ">
        <select id="selectbasic" name="selectbasic" class="form-control">
          <option value="1">Finland</option>
        </select>
      </div>
    </div></br> <br>
     <!-- Select City -->
     <div class="form-group">
      <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="selectbasic">City</label>
      <div class="col-md-8 col-sm-8 col-xs-8 ">
        <select id="selectbasic" name="selectbasic" class="form-control">
           <option value="Espoo">Espoo</option>
          <option value="Helsinki">Helsinki</option>
          <option value="Joensuu">Joensuu</option>
          <option value="Kupio">Kupio</option>
           <option value="Lappeenranta">Lappeenranta</option>
          <option value="Oulu">Oulu</option>
          <option value="Pori">Pori</option>
          <option value="Porvoo">Porvoo</option>
          <option value="Rovaniemi">Rovaniemi</option>
          <option value="Tampere">Tampere</option>
          <option value="Turku">Turku</option>
          <option value="Vaasa">Vaasa</option>
          <option value="Vantaa">Vantaa</option>
        </select>
      </div>
    </div><br> <br>

     <div class="form-group">
      <label class="col-md-4 col-sm-4 col-xs-4 control-label" for="selectbasic">Security Question</label>
      <div class="col-md-8 col-sm-8 col-xs-8 ">
        <select id="selectbasic" name="selectbasic" class="form-control">
          <option value="1">Where were you born</option>
          <option value="2">What is your favorite movie</option>
          <option value="">What is your high school name</option>
        </select>
      </div>
    </div><br> <br>

    <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" name="SecurityAnswer" id="SecurityAnswer" placeholder="Answer Security Question" required>
                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div> </br>
       <div class="radio">
            <input type="radio" name="radios" id="terms" value="1" required > By Clicking Submit you Accept the <a href="#" > Terms and Condition</a> of Grezzli (In every interaction and issue, the Laws and Legislations of Finland is used and applied. Kaikissa tapauksissa noudatetaan ja sovelletaan Suomen lakia ja määräyksiä.)

        </div>
      </br>
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
  <div>
   <?php include_once ("footer.php"); ?>

 </div>





  <!-- JS Files here -->
  <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="js/classie.js"></script>
  <script src="js/agency.js"></script>



</body>

</html>




  <!-- -Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content login-modal">
        <div class="modal-header login-modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
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


<script type="text/javascript">

  $(document).ready(function()
  {    
   $("#username").keyup(function()
   {  
    var name = $(this).val(); 

    
    if(name.length > 1)
    {  
     $("#result").html('checking...');
     
     $.ajax({

      type : 'POST',
      url  : 'username-check.php',
      data : {
        name : name
      },
      success : function(data)
      {
        if (data == "available") {

         $("#result").html("<span style='color:green;'>available</span>");

         if ( $('#emailchecker').val() == '' ) {

         }else{
           $(':input[type="submit"]').prop('disabled', false);
         }


       }else if(data == "not"){
         $("#result").html("<span style='color:brown;'>Sorry username already taken !!!</span>");
         $(':input[type="submit"]').prop('disabled', true);

       }
     }
   });
     return false;
     
   }
   else
   {
     $("#result").html('');
   }
 });
   
 });
</script>




<script type="text/javascript">

  $(document).ready(function()
  {    
   $("#emailchecker").keyup(function()
   {  
    var name = $(this).val(); 

    
    if(name.length > 1)
    {  
     $("#displayemail").html('checking...');
     
     $.ajax({

      type : 'POST',
      url  : 'email-check.php',
      data : {
        name : name
      },
      success : function(data)
      {
        if (data == "available") {

         $("#displayemail").html("<span style='color:green;'>available</span>");

         if ( $('#username').val() == '' ) {

         }else{
           $(':input[type="submit"]').prop('disabled', false);
         }

       }else if(data == "not"){
         $("#displayemail").html("<span style='color:brown;'>Sorry email already taken !!!</span>");
         $(':input[type="submit"]').prop('disabled', true);

       }
     }
   });
     return false;
     
   }
   else
   {
     $("#displayemail").html('');
   }
 });
   
 });
</script>




<script>
  $(document).ready(function(){

   $(':input[type="submit"]').prop('disabled', true);


 });
</script>
