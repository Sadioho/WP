<?php 

   if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) && empty($_SESSION['position'])) {
    header('location:index.php');
}



include 'db.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


    $emailTo = $_POST["email"];
    $username=$_POST["username"];
    $birthday=$_POST['birthday'];
    $job=$_POST['job'];
    $countries=$_POST['countries'];
    $gender=$_POST['gender'];
    $password=$_POST['password'];
    $captcha=$_POST['captcha'];
    
    

    //capcha 
    $captcha_code=$_SESSION['captcha_code']; 
    if($captcha!=$captcha_code){
        echo "err_cap";
        exit();
    }
    //
    //sql xu li email
    $sql_email="select * from acount where email='$emailTo'";
    $query_email=mysqli_query($conn,$sql_email);

    //sql xu li username
    $sql_username="select * from acount where username='$username'";
    $query_username=mysqli_query($conn,$sql_username);
    //
    if($row=mysqli_fetch_assoc($query_email)){
        if($emailTo===$row['email']){
            echo "email_err";
            exit();
        }
    }
    if($row_username=mysqli_fetch_assoc($query_username)){
        if($username===$row_username['username']){
            echo "user_err";
            exit();
        }
    }

    mysqli_close($conn);

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
        $mail->setFrom('hoxuananh9.3@gmail.com', 'Kich hoat tai khoan');
           //Add a recipient
        $mail->addAddress($emailTo);               //Name is optional
        $mail->addReplyTo('no-reply@gmail.com', 'No-reply');

        //Content

        $url="http://" . $_SERVER["HTTP_HOST"]. dirname($_SERVER["PHP_SELF"])."/kick_hoat_tai_khoan.php?email=$emailTo&birthday=$birthday&job=$job&countries=$countries&gender=$gender&username=$username&password=$password";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = "<h1>Kích hoạt tài khoản</h1>
                            Click <a href='$url'>This link </a> to do so;
        
        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'send';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit(); 
















































// if(isset($_SESSION['position'])){
//     $checkposition=$_SESSION['position'];
// }else{
//     $checkposition=null;
// }

// $email=$_POST['email'];
// $birthday=$_POST['birthday'];
// $job=$_POST['job'];
// $countries=$_POST['countries'];
// $gender=$_POST['gender'];
// $username=$_POST['username'];
// $password=$_POST['password'];
// //trạng thái để xem đã bị xóa hay chưa 
// $active=1;
// //tạo cái code để forgot pass qua email
// $code=uniqid(true);

// //mã hóa password
// $password_hash=password_hash($password,PASSWORD_DEFAULT);

// //kiểm tra thêm tài khoản admin=1 hay là user=0
// if($checkposition==='1'){
//     $position=1;
// }else{
//     $position=0;
// }

// //sql xu li email
//     $sql_email="select * from acount where email='$email'";
//     $query_email=mysqli_query($conn,$sql_email);

// //sql xu li username
//     $sql_username="select * from acount where username='$username'";
//     $query_username=mysqli_query($conn,$sql_username);
// //

//     if(!empty($email) && !empty($birthday) && !empty($job) && !empty($countries) && !empty($gender)&& !empty($username) && !empty($password)){
//         //kiem tra trung email
//         if($row=mysqli_fetch_assoc($query_email)){
//             if($email===$row['email']){
//                 echo "email_err";
//                 exit();
//             }
//         }
//         if($row_username=mysqli_fetch_assoc($query_username)){
//             if($username===$row_username['username']){
//                 echo "user_err";
//                 exit();
//             }
//         }
//         $sql_insert = "INSERT INTO acount(email,avatar,birthday,job,countries,gender,username,password,code,position,active) 
//         values ('$email','','$birthday','$job','$countries','$gender','$username','$password_hash','$code','$position','$active')";
//          mysqli_query($conn, $sql_insert);

//         echo "true";
//     }else{
//        echo "false";
//     }

?>