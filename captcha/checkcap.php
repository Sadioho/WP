<?php 
    session_start();
    if(isset($_SESSION['captcha_code'])){
        $captcha_code=$_SESSION['captcha_code'];
    }
    $captcha=$_POST['captcha'];

    if($captcha==$captcha_code){
        echo "Mã nhập vào đúng";
        exit();
    }else{
        echo "Nhập sai mã";
        exit();
    }
    // echo $captcha_code;


?>