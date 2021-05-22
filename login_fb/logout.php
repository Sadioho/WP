<?php

//logout.php
session_start();

// session_destroy();
if(isset($_SESSION["user_image"])
&& $_SESSION["user_email_address"]
&& $_SESSION["user_name"]
&&$_SESSION["birthday"]
&& $_SESSION["gender"]
&& $_SESSION["location"]
){
unset($_SESSION["user_image"]);
unset($_SESSION["user_email_address"]);
unset($_SESSION["user_name"]);
unset($_SESSION["birthday"]);
unset($_SESSION["gender"]);
unset($_SESSION["location"]);

}
header('location:login.php');
?>