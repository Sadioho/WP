<?php
include 'connection.php';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['username'])) {
    header('location:index.php?page=home');
}




$fail = "";
$success = "";
$username_err = "";
$password_err = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['email_username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);


    $sql_login = "select * from acount where username='$username' or email='$username'";
    $query_login = mysqli_query($mysqli, $sql_login);







    if (empty($username) || empty($password)) {
        if (empty($username)) {
            $username_err = "Không được để trống username !";
        }
        if (empty($password)) {
            $password_err = "Không được để trống password!";
        }
    }


    if (!empty($username) && !empty($password)) {




        if ($row_login = mysqli_fetch_assoc($query_login)) {
            $checkpass = password_verify($password, $row_login['password']);
            

            if ($checkpass == 0) {
                $password_err = "Mật khẩu sai!";
            }
            if (($username === $row_login['username'] || $username === $row_login['email']) && $checkpass == 1 && empty($password_err) && $row_login['active'] === '1') {


                $_SESSION['username'] = $row_login['username'];
                $_SESSION['position'] = $row_login['position'];
                $_SESSION['id'] = $row_login['id'];

                header('location:index.php?page=home');

                $success = "Đăng nhập thành công";
            } else {
                $fail = "Đăng nhập không thành công!";
            }
        } else {
            $username_err = "Tên đăng nhập không tồn tại!";
        }
    }
}


?>









<form class=" col-sm-6 m-auto d-flex flex-wrap border p-2" novalidate method="POST" enctype="multipart/form-data">
    <h3 class="text-center col-sm-12 mb-4">Đăng Nhập</h3>

    <div class="col-sm-12">
        <div class="col-sm-12 mb-3">
            <label class="form-label">Username or Email</label>
            <input type="text" name="email_username" class="form-control" placeholder="Enter Email" value="<?php if (isset($_POST['email_username'])) {
                                                                                                                echo $_POST['email_username'];
                                                                                                            } ?>">
            <p class="text-danger"><?php echo $username_err; ?></p>

        </div>
        <div class="col-sm-12 mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?php if (isset($_POST['password'])) {
                                                                                                                echo $_POST['password'];
                                                                                                            } ?>">
            <p class="text-danger"> <?php echo $password_err; ?></p>

        </div>

    </div>
    <p class="text-success"><?php echo $success; ?></p>
    <p class="text-danger"><?php echo $fail; ?></p>
    <button type="submit" class="btn btn-success m-auto col-sm-6" name="login">Đăng nhập</button>
    <a class=" text-center col-sm-12" href="index.php?page=forgotpass">Quên mật khẩu?</a>
</form>