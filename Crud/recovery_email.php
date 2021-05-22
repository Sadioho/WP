<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
require 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST["recovery_email"])){
    $emailTo = $_POST["email"];
    $sql="select * from acount where email='$emailTo'";
    $query_select=mysqli_query($mysqli, $sql);
    if($row_select=mysqli_fetch_assoc($query_select)){
        $code=$row_select['code'];
        echo $code; 
    }else{
        exit("khong ton tai email nay!");
    }

    mysqli_close($mysqli);

    // if(!$query_update){
    //     exit("erro");
    // }
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
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

        $url="http://" . $_SERVER["HTTP_HOST"]. dirname($_SERVER["PHP_SELF"])."/resetPassword.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = "<h1>Tou requested a password reset</h1>
                            Click <a href='$url'>This link </a> to do so;
        
        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Reset Password Email';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit(); 
}



//Instantiation and passing `true` enables exceptions

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>LOGIN</title>
</head>

<body>


    <h1 class='mt-5 text-center'>recovery_email</h1>
    <div class='col-sm-4 m-auto'>
        <form class='mt-5' method='POST'>
            <div class='mb-3'>
                <label for='exampleInputEmail1' class='form-label'>Email</label>
                <input type='email' class='form-control' name="email" placeholder="Enter Email"
               >
            </div>
            <button type='submit' name='recovery_email' class='btn btn-primary'>Send Email</button>
           
            
        </form>

    </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>