Login fb thành công


<?php 
    session_start();
  echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
  echo '<h3><b>Name :</b> '.$_SESSION['user_name'].'</h3>';
  echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
  echo '<h3><b>birthday :</b> '.$_SESSION['birthday'].'</h3>';
  echo '<h3><b>gender :</b> '.$_SESSION['gender'].'</h3>';
  echo '<h3><b>location :</b> '.$_SESSION['location'].'</h3>';

?>