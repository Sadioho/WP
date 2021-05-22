<?php
if (!isset($_SESSION)) {
  session_start();
}
include 'fb_config.php';
include 'db.php';
require_once __DIR__ . '/vendor/autoload.php';

try {
  $accessToken = $helper->getAccessToken();

  $response = $fb->get('./me?fields=id,name,email,birthday,gender,location', $accessToken);
  $fb_response_picture = $fb->get('/me/picture?redirect=false&height=300', $accessToken);

  $fb_user_info = $response->getGraphUser();
  $fb_picture = $fb_response_picture->getGraphUser();

  $_SESSION['fb']='fb';

  $_SESSION['user_gender'] =  $fb_user_info['gender'];
  $_SESSION['user_location'] =  $fb_user_info['location']['name'];


  if (!empty($fb_user_info['birthday'])) {
    $_SESSION['user_birthday'] = $fb_user_info['birthday']->format('m/d/Y');
  }

  if (!empty($fb_user_info['id'])) {
    $_SESSION['id'] = $fb_user_info['id'];
  }

  if (!empty($fb_user_info['gender'])) {
    $_SESSION['user_gender'] = $fb_user_info['gender'];
  }


  if (!empty($fb_user_info['location'])) {
    $_SESSION['user_location'] = $fb_user_info['location']['name'];
  }

  if (!empty($fb_picture['url'])) {
    $_SESSION['user_image'] =  $fb_picture['url'];
  }

  if (!empty($fb_user_info['name'])) {
    $_SESSION['username'] = $fb_user_info['name'];
    $_SESSION['position'] = '0';
    
  }

  if (!empty($fb_user_info['email'])) {
    $_SESSION['user_email'] = $fb_user_info['email'];
  }


  //


} catch (Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (!isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }

  exit;
}

//

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('551163792489247'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}
//
$id = $fb_user_info['id'];
$username = $fb_user_info['name'];
$email = $fb_user_info['email'];
$birthday = $fb_user_info['birthday']->format('Y/m/d');
$countries = $fb_user_info['location']['name'];
$gender = $fb_user_info['gender'];
$avatar = $fb_picture['url'];
$position = 0;
$active = 0;




$sql_username = "select * from acount where username='$username'";
$query_username = mysqli_query($conn, $sql_username);
if ($row_username = mysqli_fetch_assoc($query_username)) {
  if ($username === $row_username['username']) {
    header('location:index.php?page=home');
  }
} else {
  $sql_insert = "INSERT INTO acount(email,avatar,birthday,job,countries,gender,username,password,code,position,active) 
  values ('$email','$avatar','$birthday','','$countries','$gender','$username','','','$position','$active')";
  mysqli_query($conn, $sql_insert);
  header('location:index.php?page=home');
}
