<?php
require 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['username'])) {
    header('location:index.php?page=home');
}


$fail = "";
$success = "";

if (isset($_POST["forgotpassword"])) {
    $emailTo = $_POST["email"];
    $sql = "select * from acount where email='$emailTo'";
    $query_select = mysqli_query($mysqli, $sql);
    if ($row_select = mysqli_fetch_assoc($query_select)) {
        $code = $row_select['code'];

        $success = "Kiểm tra email của bạn! ";
        // echo $code;
    } else {
        // $fail = "Email không tồn tại!";
    }
    mysqli_close($mysqli);
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

        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = "<h1>Tou requested a password reset</h1>
                            Click <a href='$url'>This link </a> to do so;
        
        ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Reset Password Email';
        $success = "Kiểm tra email của bạn! ";

    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // $success = "Kiểm tra email của bạn! ";
        $fail = "Email không tồn tại!";

    }
    // exit();
}



//Instantiation and passing `true` enables exceptions


?>



<form class=" col-sm-12 d-flex flex-wrap border p-2" novalidate method="POST" enctype="multipart/form-data">
    <h3 class="text-center col-sm-12 mb-4">Quên Mật Khẩu</h3>
    <div class="col-sm-12">
        <div class="col-sm-12 mb-3">
            <label class="form-label">Nhập email của bạn</label>
            <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
            <p class="text-danger"></p>
        </div>

    </div>
    <p class="text-success"><?php echo $success; ?></p>
    <p class="text-danger"><?php echo $fail; ?></p>
    <button type="submit" class="btn btn-success m-auto col-sm-6" name="forgotpassword">Gữi</button>
</form>