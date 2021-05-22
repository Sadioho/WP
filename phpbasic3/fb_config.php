
<?php 
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

if(!session_id()) {
  session_start();
}
$fb = new \Facebook\Facebook([
  'app_id' => '185172776706814',
  'app_secret' => '6584eb99757249b3a886be5121d8576f',
  'default_graph_version' => 'v10.0',
]);

$helper =  $fb->getRedirectLoginHelper();
$permissions=['email'];
// $loginUrl=$helper->getLoginUrl('http://localhost/phpbasic3/fb_callback.php',$permissions);
$loginUrl=$helper->getLoginUrl('http://localhost/phpbasic3/fb_callback.php',$permissions);

?>