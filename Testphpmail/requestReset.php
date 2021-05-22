<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'connection.php';


if(isset($_POST["email"])){
    $emailTo = trim($_POST["email"]);
    $code=uniqid(true);
    $sql="select * from resetpasswords where email='$emailTo'";
    $query_select=mysqli_query($mysqli, $sql);

    // if(empty($emailTo)){
    //     echo "sai roi thang lol";
    // }else
    if($row_select=mysqli_fetch_assoc($query_select)){
        $checkemail=password_verify($emailTo,$row_select['email']);
        var_dump( $checkemail);
        if($row_select['email']===$emailTo && isset($checkemail)){
            $email_up=$row_select['email'];
            $sql_update="update resetpasswords set code='$code' where email='$email_up'";
            $query_update=mysqli_query($mysqli,$sql_update);
        }
    }else{
        $sql_update="insert into resetpasswords(code,email) values ('$code','$emailTo')";
        $query_update=mysqli_query($mysqli,$sql_update);
    }


   
    mysqli_close($mysqli);

    if(!$query_update){
        exit("erro");
    }
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

<form action="" method="POST">

    <input type="text" name="email" placeholder="Enter Email">
    <br/>
    <input type="submit" name="submit" value="Reset Email">
  
</form>