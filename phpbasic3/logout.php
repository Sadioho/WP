<?php 
if(!isset($_SESSION['username'])){
    header("location:index.php");
}
    session_start();
    if(isset($_SESSION['username'])!=null ||isset($_SESSION['user_name'])!=null){
        unset($_SESSION['username']);
        unset($_SESSION['position']);
        unset($_SESSION['id']);
        //fb
        unset($_SESSION['user_id']); 
        unset($_SESSION['user_birthday']);
         unset($_SESSION['user_gender']); 
         unset($_SESSION['user_location']); 
         unset($_SESSION['user_image']); 
         unset($_SESSION['user_active']); 
         unset($_SESSION['user_email']); 
         unset( $_SESSION['fb']); 

        header('location: index.php');
    }
