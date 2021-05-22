<?php 
include 'fb_config.php';
include 'db.php';
require_once __DIR__ . '/vendor/autoload.php';

try {
  $accessToken = $helper->getAccessToken();

  $response=$fb->get('./me?fields=id,name,email,birthday,gender,location',$accessToken);
  $fb_response_picture = $fb->get('/me/picture?redirect=false&height=300',$accessToken);

  $fb_user_info=$response->getGraphUser();
  $fb_picture=$fb_response_picture->getGraphUser();

  $_SESSION['birthday']= $fb_user_info['birthday']->format('m/d/Y');
  // $_SESSION['gender'] =  $fb_user_info['gender'];
  // $_SESSION['location'] =  $fb_user_info['location']['name'];

    if(!empty($fb_user_info['id']))
    {
    $_SESSION['user_id'] = $fb_user_info['id'];
    }

    if(!empty($fb_user_info['gender']))
    {
    $_SESSION['user_gender'] = $fb_user_info['gender'];
    }


    if(!empty($fb_user_info['location']))
    {
    $_SESSION['location'] = $fb_user_info['location']['name'];
    }

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


//biến 
  // $name=$fb_user_info['name'];
  // $gender=$fb_user_info['gender'];
  // $id=$fb_user_info['id'];
  // $user_image=$fb_user_info['user_image'];
  // $birthday=$fb_user_info['birthday']->format('m/d/Y');
  // $location=$fb_user_info['location']['name'];
  // $email = $fb_user_info['email'];
  // $active=1;
  // $position=0;

  //đẩy dữ liệu vào mysql 


header('location:index.php')

  


?>
<a href="logout.php">logout</a>