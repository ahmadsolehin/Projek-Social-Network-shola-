<?php
session_start();

//Include Facebook SDK
require_once 'inc/facebook.php';

/*
 * Configuration and setup FB API
 */
$appId = '1411305082492982'; //Facebook App ID
$appSecret = '6d538e22c3cbb1dca00356976990229c'; // Facebook App Secret
$redirectURL = 'http://test2.grezzli.com/service_seeker_reg.php'; // Callback URL
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));
$fbUser = $facebook->getUser();
?>