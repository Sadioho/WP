<?php 

    session_start();
    if(isset($_SESSION['username'])!=null ){
        unset($_SESSION['username']);
        unset($_SESSION['position']);
        unset($_SESSION['id']);
        header('location: index.php');
    }


?>