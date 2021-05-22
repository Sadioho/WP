<?php
include 'connection.php';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['username'])) {
    header('location:index.php?page=home');
}

$email_err = "";
$birthday_err = "";
$job_err = "";
$countries_err = "";
$radio_err = "";
$username_err = "";
$password_err = "";
$success = "";
$fail = "";
$gender="";

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $job = $_POST['job'];
    $countries = $_POST['countries'];
    $radio = $_POST['radio'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['radio'];
    $position = 0;
    $active = 1;
    $code = uniqid(true);



    //sql xu li email
    $sql_email = "select * from acount where email='$email'";
    $query_email = mysqli_query($mysqli, $sql_email);

    //sql xu li username
    $sql_username = "select * from acount where username='$username'";
    $query_username = mysqli_query($mysqli, $sql_username);
    //

    if (empty($email) || empty($birthday) || empty($job) || empty($countries) || empty($username) || empty($password)) {
        if (empty($email)) {
            $email_err = "Không được để trống email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Email không hợp lệ !";
        }


        if (empty($birthday)) {
            $birthday_err = "Không được để trống birthday";
        }
        if (empty($job)) {
            $job_err = "Không được để trống job";
        }
        if (empty($countries)) {
            $countries_err = "Không được để trống countries";
        }
        if (empty($radio)) {
            $radio_err = "Không được để trống radio";
        }
        if (empty($username)) {
            $username_err = "Không được để trống username";
        }
        if (empty($password)) {
            $password_err = "Không được để trống password";
        } 
    } else {
        if (strlen($password) < 5) {
            $password_err = "Password phải lớn hơn 6 ký tự!";
        }
        //kiem tra trung email
        if ($row = mysqli_fetch_assoc($query_email)) {
            if ($email === $row['email']) {
                $email_err = "Email đã tồn tại!";
            }
        }
        if ($row_username = mysqli_fetch_assoc($query_username)) {
            if ($username === $row_username['username']) {
                $username_err = "Username đã tồn tại!";
            }
        }

        if (empty($email_err) && empty($username_err) && empty($password_err)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);


            $sql_insert = "INSERT INTO acount(email,avatar,birthday,job,countries,gender,username,password,code,position,active) 
        values ('$email','','$birthday','$job','$countries','$gender','$username','$password_hash','$code','$position','$active')";
            mysqli_query($mysqli, $sql_insert);
            $success = "Đăng ký thành công!";
        }
    }
}

?>








<form class=" col-sm-6 m-auto d-flex flex-wrap border p-2" novalidate method="POST" enctype="multipart/form-data">
    <h3 class="text-center col-sm-12 mb-4">Đăng ký</h3>
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
            <p class="text-danger"><?php echo $email_err ?></p>

        </div>
        <div class="mb-3">
            <label class="form-label">BirthDay</label>
            <input type="date" name="birthday" max="2003-01-01" class="form-control" value="<?php if (isset($_POST['birthday'])) {
                                                                                                echo $_POST['birthday'];
                                                                                            } ?>">
            <p class="text-danger"><?php echo $birthday_err ?></p>

        </div>
        <div class="mb-3">
            <label class="form-label">Job</label>
            <input type="text" name="job" class="form-control" placeholder="Enter Job" value="<?php if (isset($_POST['job'])) {
                                                                                                    echo $_POST['job'];
                                                                                                } ?>">
            <p class="text-danger"><?php echo $job_err ?></p>

        </div>

        <div class="mb-3 ">
            <label class="form-label">Countries</label>
            <label class="form-label">countries</label>
            <input type="text" name="countries" class="form-control" placeholder="Enter countries" value="<?php if (isset($_POST['countries'])) {
                                                                                                                echo $_POST['countries'];
                                                                                                            } ?>">
            <p class="text-danger"><?php echo $countries_err ?></p>

        </div>
    </div>
    <div class=" col-sm-6 ">

        <div class=" mb-3">
            <label class="form-label">Gender</label>

            <div class="form-check">
                <input class="form-check-input " type="radio" name="radio" value="Male" checked>
                <label class="form-check-label">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input " type="radio" name="radio" value="Female" <?php
                                                                                            if ($gender === 'Female') {
                                                                                                echo "checked";
                                                                                            }
                                                                                            ?>>
                <label class="form-check-label">
                    Female
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input " type="radio" name="radio" value="Bisexuality"  <?php
                                                                                            if ($gender === 'Bisexuality') {
                                                                                                echo "checked";
                                                                                            }
                                                                                            ?>>
                <label class="form-check-label">
                    Bisexuality
                </label>
            </div>


        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php if (isset($_POST['username'])) {
                                                                                                            echo $_POST['username'];
                                                                                                        } ?>">
            <p class="text-danger"><?php echo $username_err ?></p>

        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?php if (isset($_POST['password'])) {
                                                                                                                echo $_POST['password'];
                                                                                                            } ?>">
            <p class="text-danger"><?php echo $password_err ?></p>

        </div>

    </div>
    <p class="text-success"><?php echo $success ?></p>
    <button type="submit" class="btn btn-success m-auto col-sm-6 " name="register">Register</button>
</form>