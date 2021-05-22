<?php
include 'connection.php';

if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['username'] == '') {
    header('location:index.php?page=login');
}


$success="";
$fail="";

$new_pass_err="";
$repeat_pass_err="";
$pass_err="";

if (isset($_POST['changepass'])) {
    $password=$_POST['password'];
    $newpassword=$_POST['newpassword'];
    $repeatnewpass=$_POST['repeatnewpass'];


    $id=$_SESSION['id'];

    $sql_pass="select * from acount where id='$id'";
    $query_pass=mysqli_query($mysqli,$sql_pass);
    $row_pass=mysqli_fetch_assoc($query_pass);

    $checkpass=password_verify($password,$row_pass['password']);


    
    if (empty($password) || empty($newpassword) || empty($repeatnewpass) ) {
        if (empty($password)) {
            $pass_err = "Không được để trống mật khẩu!";
        } 
        if (empty($newpassword)) {
            $new_pass_err = "Vui lòng nhập mật khẩu mới!";
        }
        if (empty($repeatnewpass)) {
            $repeat_pass_err = "Vui lòng nhập lại đúng mật khẩu!";
        }
        
    } else {
        if (strlen($password) < 5) {
            $pass_err = "Password phải lớn hơn 6 ký tự!";
        }elseif($checkpass!=1){
            $pass_err = "Password không đúng!";
        }
        if (strlen($newpassword) < 5) {
            $new_pass_err = "Password phải lớn hơn 6 ký tự!";
        }
        if (strlen($repeatnewpass) < 5) {
            $repeat_pass_err = "Password phải lớn hơn 6 ký tự!";
        }
        if($newpassword!=$repeatnewpass){
            $repeat_pass_err = "Mật khẩu không khớp !";

        }

        if(empty($pass_err) && empty($new_pass_err) && empty($repeat_pass_err) ){
            $hash_pass_new=password_hash($newpassword,PASSWORD_DEFAULT);
            $sql_up_pass="update acount set password='$hash_pass_new' where id ='$id'";
            $query_up=mysqli_query($mysqli,$sql_up_pass);
            $success="Đổi mật khẩu thành công !";
        }  
    }


}




?>


<form method="post" novalidate class="m-auto col-sm-12 col-xl-4 border p-5">
    <h1 class="text-center text-danger ">Change Pass</h1>
    <div class="form-group mt-5">
        <label>Current Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if (isset($_POST['password'])) {
                                                                                                                echo $_POST['password'];
                                                                                                            } ?>" >
        <p class="text-danger"><?php echo $pass_err ?></p>

    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="newpassword" class="form-control" placeholder="New Password" value="<?php if (isset($_POST['newpassword'])) {
                                                                                                                echo $_POST['newpassword'];
                                                                                                            } ?>">
        <p class="text-danger"><?php echo $new_pass_err ?></p>

    </div>
    <div class="form-group">
        <label>Repeat New Password</label>
        <input type="password" name="repeatnewpass" class="form-control" placeholder="Repeat New Password" value="<?php if(isset($_POST['repeatnewpass'])){
            echo $_POST['repeatnewpass'];
        } ?>" >
        <p class="text-danger"><?php echo $repeat_pass_err ?></p>

    </div>
    <p class="text-danger" ><?php echo $fail ?></p>
    <p class="text-info" ><?php echo $success ?></p>
    <button type="submit" name="changepass" class="btn btn-success">Đổi mật khẩu</button>
</form>