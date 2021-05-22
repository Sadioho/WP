<?php 

    session_start();
    if(isset($_SESSION['username'])!=null ||isset($_SESSION['user_name'])!=null){
        unset($_SESSION['username']);
        unset($_SESSION['position']);
        unset($_SESSION['id']);
        //fb
        unset($_SESSION['user_name']);

        
        header('location: login.php');
    }


?>