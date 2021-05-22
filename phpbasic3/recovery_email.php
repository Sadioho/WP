<?php
session_start();
require 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


    $emailTo = $_POST["email"];
    //cap
    $captcha=$_POST['captcha'];
    //capcha 
    $captcha_code=$_SESSION['captcha_code']; 
    if($captcha!=$captcha_code){
        exit("Captcha không đúng");
    }


    $sql="select * from acount where email='$emailTo' and active='1'";
    $query_select=mysqli_query($conn, $sql);
    if($row_select=mysqli_fetch_assoc($query_select)){
        $code=$row_select['code'];
        // echo $code; 
    }else{
        exit("Email này không tồn tại !");
    }

    mysqli_close($conn);

    $mail = new PHPMailer(true);

    try {
                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'hoxuananh9.3@gmail.com';                     //SMTP username
        $mail->Password   = 'ppnnwxekquozcdjx';                               //SMTP password
        $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('hoxuananh9.3@gmail.com', 'Test2');
           //Add a recipient
        $mail->addAddress($emailTo);               //Name is optional
        $mail->addReplyTo('no-reply@gmail.com', 'No-reply');

        //Content

        $url="http://" . $_SERVER["HTTP_HOST"]. dirname($_SERVER["PHP_SELF"])."/forgotPassword.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = "<h1>Tou requested a password reset</h1>
                            Click <a href='$url'>This link </a> to do so;
        
        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Kiểm tra email của bạn ';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit(); 




//Instantiation and passing `true` enables exceptions

?>

