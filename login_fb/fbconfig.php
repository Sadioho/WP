
<?php 
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

session_start();
if(!session_id()) {
  session_start();
}
$fb = new \Facebook\Facebook([
  'app_id' => '747019266175060',
  'app_secret' => '13a7232efe42b9d2a5370b07e896f676',
  'default_graph_version' => 'v10.0',
]);

$helper =  $fb->getRedirectLoginHelper();
$permissions=['email'];
$loginUrl=$helper->getLoginUrl('http://localhost/login_fb/fb-callback.php',$permissions);

?>