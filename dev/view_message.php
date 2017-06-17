                            
<?php


include_once("php_includes/check_login_status.php");

if(!isset($_SESSION['username']))
{
  header("Location: index.php");
}


   //Read your session (if it is set)
if (isset($_SESSION['fname']))
  $fn =  $_SESSION['fname'];
$ln = $_SESSION['lname'];
$u = $_SESSION['username'];
$userid = $_SESSION['userid'];
$avatar = $_SESSION['avatar'];





$id_number = $_GET['id'];



$nosql = "UPDATE message SET status = 'read' WHERE id ='$id_number' AND to_user = '$u' LIMIT 1";
$quey = mysqli_query($db_conx, $nosql);




$msg_listing = "SELECT * FROM message WHERE id = '$id_number' ";
$msg_array = mysqli_query($db_conx, $msg_listing);

while ($row = mysqli_fetch_array($msg_array, MYSQLI_ASSOC)) {
  $id = $row["id"];
  $from = $row["from_user"];
  $from_avatar = $row["from_image"];
  $to = $row["to_user"];
  $sbj = $row["subject"];
  $msg = $row["message"];
  $cd = $row["created_date"];
}






$query = "SELECT * FROM conversation WHERE msg_id = '$id_number' ORDER BY id";
      $result = mysqli_query($db_conx, $query);

if (mysqli_num_rows($result) != 0)
{
//results found
      //  echo "not";


} else {
// results not found
       // echo "available";

}

?>








<style type="text/css">
  
.panel {
    box-shadow: 0 2px 0 rgba(0,0,0,0.075);
    border-radius: 0;
    border: 0;
    margin-bottom: 24px;
}
.panel .panel-heading, .panel>:first-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.panel-heading {
    position: relative;
    height: 50px;
    padding: 0;
    border-bottom:1px solid #eee;
}
.panel-control {
    height: 100%;
    position: relative;
    float: right;
    padding: 0 15px;
}
.panel-title {
    font-weight: normal;
    padding: 0 20px 0 20px;
    font-size: 1.416em;
    line-height: 50px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.panel-control>.btn:last-child, .panel-control>.btn-group:last-child>.btn:first-child {
    border-bottom-right-radius: 0;
}
.panel-control .btn, .panel-control .dropdown-toggle.btn {
    border: 0;
}
.nano {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.nano>.nano-content {
    position: absolute;
    overflow: scroll;
    overflow-x: hidden;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
.pad-all {
    padding: 15px;
}
.mar-btm {
    margin-bottom: 15px;
}
.media-block .media-left {
    display: block;
    float: left;
}
.img-sm {
    width: 46px;
    height: 46px;
}
.media-block .media-body {
    display: block;
    overflow: hidden;
    width: auto;
}
.pad-hor {
    padding-left: 15px;
    padding-right: 15px;
}
.speech {
    position: relative;
    background: #b7dcfe;
    color: #317787;
    display: inline-block;
    border-radius: 0;
    padding: 12px 20px;
}
.speech:before {
    content: "";
    display: block;
    position: absolute;
    width: 0;
    height: 0;
    left: 0;
    top: 0;
    border-top: 7px solid transparent;
    border-bottom: 7px solid transparent;
    border-right: 7px solid #b7dcfe;
    margin: 15px 0 0 -6px;
}
.speech-right>.speech:before {
    left: auto;
    right: 0;
    border-top: 7px solid transparent;
    border-bottom: 7px solid transparent;
    border-left: 7px solid #ffdc91;
    border-right: 0;
    margin: 15px -6px 0 0;
}
.speech .media-heading {
    font-size: 1.2em;
    color: #317787;
    display: block;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    margin-bottom: 10px;
    padding-bottom: 5px;
    font-weight: 300;
}
.speech-time {
    margin-top: 20px;
    margin-bottom: 0;
    font-size: .8em;
    font-weight: 300;
}
.media-block .media-right {
    float: right;
}
.speech-right {
    text-align: right;
}
.pad-hor {
    padding-left: 15px;
    padding-right: 15px;
}
.speech-right>.speech {
    background: #ffda87;
    color: #a07617;
    text-align: right;
}
.speech-right>.speech .media-heading {
    color: #a07617;
}

.nano>.nano-pane {
    background-color: rgba(0,0,0,0.1);
    position: absolute;
    width: 5px;
    right: 0;
    top: 0;
    bottom: 0;
    opacity: 0;
    -webkit-transition: all .7s;
    transition: all .7s;
}
</style>




<div class="container">
    <div class="col-md-12 col-lg-6">
        <div class="panel">
          <!--Heading-->
    
        <!--Widget body-->
        <div id="demo-chat-body" class="collapse in">
            <div class="nano-content pad-all" tabindex="0" style="right: -17px;">
              <ul id = "aimantino" class="list-unstyled media-block">

              <?php

              if ( $from == $u ) {
                ?>


                             <li class="mar-btm">
                  <div class="media-right">
                    <img src="<?php echo $avatar; ?>" class="img-circle img-sm" alt="Profile Picture">
                  </div>
                  <div class="media-body pad-hor speech-right">
                    <div class="speech">
                      <a href="#" class="media-heading"><?php echo $from; ?></a>
                      <p><?php echo nl2br($msg); ?></p>
                      <p class="speech-time">
                        <i class="fa fa-clock-o fa-fw"></i><?php echo $cd; ?>
                      </p>
                    </div>
                  </div>
                </li>

                <?php
              }else{
                ?>

                 <li class="mar-btm">
                  <div class="media-left">
                    <img src="<?php echo $from_avatar; ?>" class="img-circle img-sm" alt="Profile Picture">
                  </div>
                  <div class="media-body pad-hor">
                    <div class="speech">
                      <a href="#" class="media-heading"><?php echo $from; ?></a>
                      <p><?php echo nl2br($msg); ?></p>
                      <p class="speech-time">
                      <i class="fa fa-clock-o fa-fw"></i><?php echo $cd; ?>
                      </p>
                    </div>
                  </div>
                </li>

                <?php
              }

              ?>

        
      
<?php  
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

  $dari = $row["from_user"];
        $from_image = $row["from_image"];
  $kpd = $row["to_user"];
        $to_image = $row["to_image"];
  $pesanan = $row["msg"];
  $photo = $row["avatar"];
  $date = $row["created_date"];

      
      ?>

      <?php

      if ( $dari == $u ) {

        ?>

                <li class="mar-btm">
                  <div class="media-right">
                    <img src="<?php echo $from_image; ?>" class="img-circle img-sm" alt="Profile Picture">
                  </div>
                  <div class="media-body pad-hor speech-right">
                    <div class="speech">
                      <a href="#" class="media-heading"><?php echo $dari; ?></a>
                      <p><?php echo nl2br($pesanan); ?></p>
                      <p class="speech-time">
                        <i class="fa fa-clock-o fa-fw"></i><?php echo $date; ?>
                      </p>
                    </div>
                  </div>
                </li>

        <?php
      }else{

        ?>

        <li class="mar-btm">
                  <div class="media-left">
                    <img src="<?php echo $from_image; ?>" class="img-circle img-sm" alt="Profile Picture">
                  </div>
                  <div class="media-body pad-hor">
                    <div class="speech">
                      <a href="#" class="media-heading"><?php echo $dari; ?></a>
                      <p><?php echo nl2br($pesanan); ?></p>
                      <p class="speech-time">
                      <i class="fa fa-clock-o fa-fw"></i><?php echo $date; ?>
                      </p>
                    </div>
                  </div>
                </li>


        <?php
      }

      ?>

        

                       <?php } ?>


              </ul>
            </div>
          <div class="nano-pane"><div class="nano-slider" style="height: 30px; transform: translate(0px, 0px);"></div></div>
    
          <!--Widget footer-->
          <div class="panel-footer">
            <div class="row">
              <div class="col-xs-9">
                <textarea  id="reply_msg" placeholder="Enter your text" class="form-control chat-input" cols="30" rows="1" onkeyup="AutoGrowTextArea(this)"></textarea>
              </div>
              <div class="col-xs-3">
                <button class="btn btn-primary btn-block" id="reply" type="submit">Send</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>




<script type="text/javascript">

  $('#reply').click(function(){

    var to = '<?php echo $from; ?>';
    var to_image = '<?php echo $from_image; ?>';
    var msg = $('#reply_msg').val();
    var id_number = '<?php echo $id; ?>';

        var d = new Date();
    var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();


         $.ajax(
    {
        url : 'messages/reply_msg_ajax.php',
        type: "POST",
        data : {
          username : to,
          message : msg,
          message_id : id_number,
          to_image : to_image
        },
        success:function(data, textStatus, jqXHR) 
        {
                   $('#aimantino').append("<li class='mar-btm'><div class='media-right'><img src='<?php echo $avatar; ?>' class='img-circle img-sm'></div><div class='media-body pad-hor speech-right'><div class='speech'><a href='#' class='media-heading'><?php echo $u; ?></a><p>"+msg+"</p><p class='speech-time'><i class='fa fa-clock-o fa-fw'></i>'"+time+"'</p></div></div></li>");

                    $('#reply_msg').val('');



        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails      
        }
    });


       })
     </script>


<script type="text/javascript">
// Auto-Grow-TextArea script.
// Script copyright (C) 2011 www.cryer.co.uk.
// Script is free to use provided this copyright header is included.
function AutoGrowTextArea(textField)
{
  if (textField.clientHeight < textField.scrollHeight)
  {
    textField.style.height = textField.scrollHeight + "px";
    if (textField.clientHeight < textField.scrollHeight)
    {
      textField.style.height = 
        (textField.scrollHeight * 2 - textField.clientHeight) + "px";
    }
  }
}
</script>