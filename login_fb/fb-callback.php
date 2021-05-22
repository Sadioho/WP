<?php 
include 'fbconfig.php';
require_once __DIR__ . '/vendor/autoload.php';

try {
  $accessToken = $helper->getAccessToken();

  $response=$fb->get('./me?fields=id,name,email,birthday,gender,location',$accessToken);
  $fb_response_picture = $fb->get('/me/picture?redirect=false&height=300',$accessToken);

  $fb_user_info=$response->getGraphUser();
  $fb_picture=$fb_response_picture->getGraphUser();



  $_SESSION['birthday']= $fb_user_info['birthday']->format('m/d/Y');
  $_SESSION['gender'] =  $fb_user_info['gender'];
  $_SESSION['location'] =  $fb_user_info['location']['name'];

    if(!empty($fb_picture['url'])){
      $_SESSION['user_image'] =  $fb_picture['url'];
    }

    if(!empty($fb_user_info['name']))
    {
    $_SESSION['user_name'] = $fb_user_info['name'];
    }

    if(!empty($fb_user_info['email']))
    {
    $_SESSION['user_email_address'] = $fb_user_info['email'];
    }

    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

  if (! isset($accessToken)) {
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

  echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
  echo '<h3><b>Name :</b> '.$_SESSION['user_name'].'</h3>';
  echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
  echo '<h3><b>birthday :</b> '.$_SESSION['birthday'].'</h3>';
  echo '<h3><b>gender :</b> '.$_SESSION['gender'].'</h3>';
  echo '<h3><b>location :</b> '.$_SESSION['location'].'</h3>';
  


?>
<a href="logout.php">logout</a>