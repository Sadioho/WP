<?php
session_start();
include 'fb_config.php';
if (isset($_SESSION['username']) && $_SESSION['position'] === '1') {
    header('location:index.php');
}
if (isset($_SESSION['username']) && $_SESSION['position'] === '0') {
    header('location:index.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">SHOPEE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php?page_layout=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Detail</a>
                    </li>
                </ul>

            </div>


        </nav>
        <h1 class="text-center">Đăng nhập</h1>
        <div class="row">

            <form class="col-sm-6 m-auto" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <p class="text-success" id="success"></p>
                <p class="text-danger" id="error"></p>
                <button type="button" name="btn_signin" id="btn_signin" class="btn btn-primary">Đăng nhập</button>
                <a href="#" data-toggle="modal" data-target="#addModal" class='btn btn-success'>Đăng Ký</a>
                <a href="#" data-toggle="modal" data-target="#forgot_Modal">Forgot PassWord?</a>
                <a href="<?= $loginUrl ?>" class="mt-3 col-sm-12 btn btn-primary"><i class="fab fa-facebook"></i> Đăng nhập bằng Facebook</a>
                <a href="#" class="mt-3 col-sm-12 btn btn-danger"><i class="fab fa-google "></i> Đăng nhập bằng Tài khoản Google</a>
            </form>

        </div>
    </div>

    <!-- dang ky  -->

    <!-- The Modal -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Users</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class=" col-sm-12 d-flex flex-wrap" method="POST" enctype="multipart/form-data">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                                <p class="text-danger" id="email_err"></p>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">BirthDay</label>
                                <input type="date" name="birthday" max="2003-01-01" id="birthday" class="form-control">
                                <p class="text-danger" id="birthday_err"></p>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Job</label>
                                <input type="text" name="job" id="job" class="form-control" placeholder="Enter Job">
                                <p class="text-danger" id="job_err"></p>

                            </div>

                            <div class="mb-3 ">
                                <label class="form-label">Countries</label>
                                <select class="form-select" aria-label="Default select example" name="countries" id="countries">
                                    <option value="0">Countries</option>
                                    <option value="USA">USA</option>
                                    <option value="China">China</option>
                                    <option value="England">England</option>
                                </select>
                                <p class="text-danger" id="countries_err"></p>

                            </div>
                        </div>
                        <div class="col-sm-6 ">

                            <div class="mb-3">
                                <label class="form-label">Gender</label>

                                <div class="form-check">
                                    <input class="form-check-input radio" type="radio" name="radio" value="Male" checked>
                                    <label class="form-check-label">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio" type="radio" name="radio" value="Female">
                                    <label class="form-check-label">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio" type="radio" name="radio" value="Bisexuality">
                                    <label class="form-check-label">
                                        Bisexuality
                                    </label>
                                </div>


                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username1" id="username1" class="form-control" placeholder="Enter Username">
                                <p class="text-danger" id="username_err"></p>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password1" id="password1" class="form-control">
                                <p class="text-danger" id="pass_err"></p>

                            </div>
                           
                        </div>
                        <div class="col-sm-12 mb-3">
                                <label>Captcha</label>
                                <input id="captcha" class="input" name="captcha" type="text" />
                                <img class="captcha_code" src="captcha_code.php" alt="" />
                                <p class="text-danger" id="err_captcha"></p>
                                <button class="btnRefresh btn btn-success"  name="submit">Refresh</button>
                            </div>
                           
                        <p class="text-success" id="checkemail"></p>
                        <button type="button" class="btn btn-success col-sm-12" name="register" id="register">Register</button>
                    </form>

                </div>




            </div>
        </div>
    </div>




    <!--forgot  -->

    <div class="modal" id="forgot_Modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Nhập email</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" id="forgotPass">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email_forgot" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                                <label>Captcha</label>
                                <input id="captcha_forgot" class="input" name="captcha" type="text" required/>
                                <img class="captcha_code" src="captcha_code.php" alt="" />
                                <button class="btnRefresh btn btn-success"  >Refresh</button>
                            </div>
                            <p class="text-danger" id="mess_succ"></p>
                        <button type="submit" class="btn btn-success col-sm-12" name="forgot" id="forgot">Gữi</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

 

    <script>
        $(document).ready(function() {

            

            $("#btn_signin").on("click", function() {

                var username = $("#username").val();
                var password = $("#password").val();
                var error = $("#error");
                var success = $("#success");
                //resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
                error.html("");
                success.html("");
                //Kiem tra neu username rong thi bao loi
                if (username == "") {
                    error.html("Ten dang nhap khong duoc de trong!");
                    return false;
                }
                if (password == "") {
                    error.html("Mat khau khong duoc de trong!");
                    return false;
                }
                // Chạy ajax gửi thông tin username và password về server check_dang_nhap.php
                // để kiểm tra thông tin đăng nhập hợp lệ hay chưa
                $.ajax({
                    url: "check_dang_nhap.php",
                    method: "POST",
                    data: {
                        username: username,
                        password: password,
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response == "1") {
                            success.html("Dang nhap thanh cong ");
                            //chuyển trang
                            window.location = "index.php";
                        } else {
                            error.html("Dang nhap that bai");

                        }
                    }
                })

            })
        
//  
 function IsEmail(email) {
    var regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,3}))$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }
    //
            //dang ki
            $('#register').on('click', function() {
                var email = $('#email').val();
                var birthday = $('#birthday').val();
                var job = $('#job').val();
                var countries = $('#countries').val();
                var gender = $('.radio:checked').val();
                var username = $('#username1').val();
                var password = $('#password1').val();

                var captcha=$("#captcha").val();

                $("#email_err").html("");
                $("#birthday_err").html("");
                $("#job_err").html("");
                $("#countries_err").html("");
                $("#username_err").html("");
                $("#pass_err").html("");
                $("#success").html("");
                $("#fail").html("");
                $("#err_captcha").html("");




                if (captcha==""|| email == "" || birthday == "" || job == "" || countries == "" || username == "" || password == "") {
                    if (email == "") {
                        $("#email_err").html('Vui lòng nhập email!');

                    } else if (IsEmail(email) == false) {
                        $("#email_err").html('Vui lòng nhập đúng email!');

                    }


                    if (birthday == "") {
                        $("#birthday_err").html("Vui lòng chọn ngày sinh");

                    }


                    if (job == "") {
                        $("#job_err").html("Vui lòng điền công việc");


                    }

                    if (countries == "") {
                        $("#countries_err").html("Vui lòng chọn quốc tịch");

                    }

                    if (username == "") {
                        $("#username_err").html("Vui lòng điền username");

                    }
                    if (password == "") {
                        $("#pass_err").html("Vui lòng điền mật khẩu");

                    }
                    if(captcha==''){
                        $("#err_captcha").html("Vui lòng nhập captcha!");
                    }
                    return false;

                } else {
                    //form

                    $.ajax({
                        url: "active_account.php",
                        method: "POST",
                        data: {
                            email: email,
                            birthday: birthday,
                            job: job,
                            countries: countries,
                            gender: gender,
                            username: username,
                            password: password,
                            captcha:captcha,


                        },
                        success: function(response) {
                            // console.log("Trong db");
                            console.log(response);
                            if (response == "email_err") {
                                $("#email_err").html('Email trùng!');

                            }
                            if (response == "user_err") {
                                $("#username_err").html('Username trùng!');
                            }
                            if (response == "send") {
                                $("#checkemail").html('Kiểm tra email của bạn!');

                            }
                            if(response=="err_cap"){
                                $("#err_captcha").html("Captcha Không hợp lệ!");
                            }



                        }
                    })



                }




            })
            // forgot 
            $("#forgotPass").submit(function(e) {
                e.preventDefault();
                var email = $("#email_forgot").val();
                var captcha=$("#captcha_forgot").val();
                console.log(captcha);

                $.ajax({
                    url: 'recovery_email.php',
                    method: 'post',
                    data: {
                        email: email,
                        captcha:captcha,
                    },
                    success: function(response) {
                        console.log(response);
                        $("#mess_succ").html(response);

                    }
                })
            })

    //refresh captcha
    $('.btnRefresh').click(function(event){
                event.preventDefault();
                $(".captcha_code").attr('src','captcha_code.php');
                console.log("hahaha");
                return false;
            })	


        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>