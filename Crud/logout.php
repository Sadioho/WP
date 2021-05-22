<?php 

    session_start();
    if(isset($_SESSION['username'])!=null){
        unset($_SESSION['username']);
        unset($_SESSION['position']);
        header('location: login.php');

    }


?>