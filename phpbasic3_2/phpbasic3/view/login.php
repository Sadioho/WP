<?php
include 'fb_config.php';

if (!isset($_SESSION)) {
    session_start();
}
?>



<h1 class="text-center">Đăng nhập</h1>
<div class="row">
    <form class="col-sm-4 m-auto" method="POST" novalidate>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username">
            <p class="text-danger" id="user_err"></p>

        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <p class="text-danger" id="pass_err"></p>

        </div>
        <p class="text-success" id="success"></p>
        <p class="text-danger" id="error"></p>
        <button type="submit" name="btn_signin" id="btn_signin" class="btn btn-primary">Đăng nhập</button>
        <a href="#" data-toggle="modal" data-target="#addModal" class='btn btn-success'>Đăng Ký</a>
        <a href="#" data-toggle="modal" data-target="#forgot_Modal">Forgot PassWord?</a>
        <a href="<?= $loginUrl ?>" class="mt-3 col-sm-12 btn btn-primary"><i class="fab fa-facebook"></i> Đăng nhập bằng Facebook</a>
        <a href="#" class="mt-3 col-sm-12 btn btn-danger"><i class="fab fa-google "></i> Đăng nhập bằng Tài khoản Google</a>
    </form>
</div>

<!-- modal forgot password -->

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
                <form method="POST" id="forgotPass" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email_forgot" class="form-control" placeholder="Enter Email">
                        <p class="text-danger" id="email_err"></p>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label>Captcha</label>
                        <input id="captcha_forgot" class="input" name="captcha" type="text" />
                        <img class="captcha_code" src="./controllers/captcha_code.php" alt="" />
                        <button class="btnRefresh btn btn-success">Refresh</button>
                        <p class="text-danger" id="err_captcha"></p>
                    </div>
                    <p class="text-danger" id="mess_succ"></p>
                    <button type="submit" class="btn btn-success col-sm-12" name="forgot" id="forgot">Gữi</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- end modal forgot password -->

<!-- register start -->
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
                            <p class="text-danger" id="e_err"></p>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">BirthDay</label>
                            <input type="date" name="birthday" max="2003-01-01" id="birthday" class="form-control">
                            <p class="text-danger" id="b_err"></p>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Job</label>
                            <input type="text" name="job" id="job" class="form-control" placeholder="Enter Job">
                            <p class="text-danger" id="j_err"></p>

                        </div>

                        <div class="mb-3 ">
                            <label class="form-label">Countries</label>
                            <select class="form-select" aria-label="Default select example" name="countries" id="countries">
                                <option value="0">Countries</option>
                                <option value="USA">USA</option>
                                <option value="China">China</option>
                                <option value="England">England</option>
                            </select>
                            <p class="text-danger" id="c_err"></p>

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
                            <input type="text" name="username_register" id="username_register" class="form-control" placeholder="Enter Username">
                            <p class="text-danger" id="u_err"></p>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password_register" id="password_register" class="form-control">
                            <p class="text-danger" id="p_err"></p>

                        </div>

                    </div>
                    <div class="col-sm-12 mb-3">
                        <label>Captcha</label>
                        <input id="captcha_register" class="input" name="captcha_register" type="text" />
                        <img class="captcha_code" src="./controllers/captcha_code.php" alt="" />
                        <p class="text-danger" id="ca_err"></p>
                        <button class="btnRefresh btn btn-success" name="submit">Refresh</button>
                    </div>

                    <p class="text-success" id="checkemail"></p>
                    <button type="submit" class="btn btn-success col-sm-12" name="register" id="register">Register</button>
                </form>

            </div>




        </div>
    </div>
</div>


<!-- register end -->

<script>
    function IsText(string) {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        if (format.test(string)) {
            return true;
        } else {
            return false;
        }
    }
    //kiem tra dinh dang email 
    function IsEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (re.test(email)) {
            return true;
        } else {
            return false;
        }

    }
    $(document).ready(function() {
        //kiem tra text
        //refresh captcha
        $('.btnRefresh').click(function(event) {
            event.preventDefault();
            $(".captcha_code").attr('src', './controllers/captcha_code.php');
            console.log("Bạn đang click refesh pass");
            return false;
        })

        //forgot password
        $("#forgot").on('click', function(e) {
            e.preventDefault();
            var email = $("#email_forgot").val();
            var captcha = $("#captcha_forgot").val();

            var email_err = $('#email_err');
            var err_captcha = $('#err_captcha');
            var mess_succ = $('#mess_succ');

            email_err.html("");
            err_captcha.html("");
            mess_succ.html("");

            if (email == '' || captcha == '') {
                if (email == '') {
                    email_err.html("Không được để trống!");
                }
                if (captcha == '') {
                    err_captcha.html("Không được để trống!");
                }
                return false;
            }

            if (IsEmail(email) == false) {
                email_err.html("Nhập cho đúng email đi bạn ơi !");
                return false;
            }
            $.ajax({
                url: 'recovery_email.php',
                method: 'post',
                data: {
                    email: email,
                    captcha: captcha,
                },
                success: function(response) {
                    console.log(response);
                    $("#mess_succ").html(response);

                }
            })
        })

        //dang nhap
        $("#btn_signin").on("click", function(e) {
            e.preventDefault();
            // console.log('login');
            var username = $("#username").val();
            var password = $("#password").val();

            var pass_err = $("#pass_err");
            var user_err = $("#user_err");

            var error = $("#error");
            var success = $("#success");

            error.html("");
            success.html("");
            user_err.html("");
            pass_err.html("");

            if (username == '' || password == '') {
                if (username == '') {
                    user_err.html("Không được để trống!");
                }
                if (password == '') {
                    pass_err.html("Không được để trống!");
                }
                return false;
            }

            if (password.length < 5) {
                pass_err.html("Mật khẩu dài hơn 6 ký tự!");
                return false;
            }

            $.ajax({
                url: "check_login.php",
                method: "POST",
                data: {
                    username: username,
                    password: password,
                },
                success: function(response) {
                    if (response == 1) {
                        success.html("dang nhap thanh cong");
                        Swal.fire({

                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 500
                        })
                        setTimeout(function() {
                            window.location = "index.php";
                        }, 500)

                    } else {
                        error.html("dang nhap that bai");
                    }

                }
            })
        });

        //register
        $('#register').on('click', function(e) {
            e.preventDefault();

            var email = $("#email").val();
            var birthday = $("#birthday").val();
            var job = $("#job").val();
            var countries = $("#countries").val();
            var gender = $('.radio:checked').val();
            var username_register = $("#username_register").val();
            var password_register = $("#password_register").val();
            var captcha_register = $("#captcha_register").val();

            // err
            var e_err = $("#e_err");
            var b_err = $("#b_err");
            var j_err = $("#j_err");
            var c_err = $("#c_err");
            var u_err = $("#u_err");
            var p_err = $("#p_err");
            var ca_err = $("#ca_err");

            e_err.html("");
            b_err.html("");
            j_err.html("");
            c_err.html("");
            u_err.html("");
            p_err.html("");
            ca_err.html("");



            //check null

            if (email == '' || birthday == '' || job == '' || countries == '0' || username_register == '' || password_register == '' || captcha_register == '') {
                if (email == '') {
                    e_err.html("Không được để trống!");
                }
                if (birthday == '') {
                    b_err.html("Không được để trống!");

                }
                if (job == '') {
                    j_err.html("Không được để trống!");

                }
                if (countries == '0') {
                    c_err.html("Không được để trống!");

                }
                if (username_register == '') {
                    u_err.html("Không được để trống!");

                }
                if (password_register == '') {
                    p_err.html("Không được để trống!");

                }

                if (captcha_register == '') {
                    ca_err.html("Không được để trống!");

                }
                return false;
            }

            if (IsEmail(email) == false) {
                e_err.html("Nhập cho đúng email đi bạn ơi !");
                return false;

            }

            if (password_register.length < 5) {
                p_err.html("Mật khẩu dài hơn 6 ký tự!");
                return false;


            }
            if (IsText(username_register) == true) {
                u_err.html("Không chứa ký tự đặc biệt !");
                return false;

            }
            if (IsText(password_register) == true) {
                p_err.html("Không chứa ký tự đặc biệt !");
                return false;

            }


            $.ajax({
                url: "active_account.php",
                method: "POST",
                data: {
                    email: email,
                    birthday: birthday,
                    job: job,
                    countries: countries,
                    gender: gender,
                    username: username_register,
                    password: password_register,
                    captcha: captcha_register,
                },
                success: function(response) {
                    // console.log("Trong db");
                    console.log(response);
                    if (response == "email_err") {
                        e_err.html('Email trùng!');

                    }
                    if (response == "user_err") {
                        p_err.html('Username trùng!');
                    }
                    if (response == "send") {
                        $("#checkemail").html('Kiểm tra email của bạn!');
                        $(".captcha_code").attr('src', './controllers/captcha_code.php');
                        return false;
                    }
                    if (response == "err_cap") {
                        ca_err.html("Captcha Không hợp lệ!");
                    }



                }
            })













        })




    })
</script>