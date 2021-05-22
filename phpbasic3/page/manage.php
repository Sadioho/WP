<?php
if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username'])) {
    header('location:index.php');
} elseif (!empty($_SESSION['username']) && $_SESSION['position'] === '0') {
    header('location:index.php');
}

$sql_select = "select * from acount";
$query_select = mysqli_query($conn, $sql_select);



?>



<h1 class="text-center text-success">Danh Sách Nhân Viên</h1>


<a href="#" class="btn btn-success mb-4" data-toggle="modal" data-target="#addModal"><i class="fas fa-user-plus"></i> Add user</a>

<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Date Of Birth</th>
            <th scope="col">Address</th>
            <th scope="col">Gender</th>
            <th scope="col">Job</th>
            <th scope="col">Position</th>
            <th scope="col">Active</th>
            <th scope="col">Function</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;

        while ($row_select = mysqli_fetch_assoc($query_select)) {
            $i++;
        ?>
            <tr>
                <th scope="row"><?php echo $row_select['id'] ?></th>
                <td><?php echo $row_select['username'] ?></td>
                <td><?php echo $row_select['email'] ?></td>
                <td><?php echo $row_select['birthday'] ?></td>
                <td><?php echo $row_select['countries'] ?></td>
                <td><?php echo $row_select['gender'] ?></td>
                <td><?php echo $row_select['job'] ?></td>
                <td><?php
                    if ($row_select['position'] === '1') {
                        echo "<span class='badge badge-success'>Admin</span>";
                    } else {
                        echo "<span class='badge badge-info'>User</span>";
                    }

                    ?>

                </td>
                <td><?php if ($row_select['active'] === '0') {
                        echo "<span class='badge badge-danger'>Not Active</span>";
                    } else {
                        echo "<span class='badge badge-success'>Active</span>";
                    } ?></td>
                <td class="
                text-center">
                    <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-warning editBtn" id="<?php echo $row_select['id'] ?>"><i class="fas fa-edit"></i></a>
                    <a href="#" title="Delete" class="btn btn-danger delBtn" id="<?php echo $row_select['id'] ?>">
                        <i class="fas fa-minus-circle"></i></a>

                </td>

            </tr>

        <?php   } ?>
    </tbody>

</table>
<p>Tổng số : <?php echo $i; ?> người</p>



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
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
                            <p class="text-danger" id="username_err"></p>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <p class="text-danger" id="pass_err"></p>

                        </div>
                    </div>
                    <p class="text-success" id="success"></p>
                    <p class="text-danger" id="fail"></p>

                    <button type="button" class="btn btn-success col-sm-12" name="register" id="register">Register</button>
                </form>

            </div>




        </div>
    </div>
</div>


<!-- modal edit -->

<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class=" col-sm-12 d-flex flex-wrap" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="hidden" id="id">
                            <input type="email" name="email" id="email1" class="form-control" placeholder="Enter Email">
                            <p class="text-danger" id="email_err1"></p>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">BirthDay</label>
                            <input type="date" name="birthday" max="2003-01-01" id="birthday1" class="form-control">
                            <p class="text-danger" id="birthday_err1"></p>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Job</label>
                            <input type="text" name="job" id="job1" class="form-control" placeholder="Enter Job">
                            <p class="text-danger" id="job_err1"></p>

                        </div>

                        <div class="mb-3 ">
                            <label class="form-label">Countries</label>
                            <select class="form-select" aria-label="Default select example" name="countries" id="countries1">

                                <option value="0">Countries</option>
                                <option value="USA">USA</option>
                                <option value="China">China</option>
                                <option value="England">England</option>


                            </select>
                            <p class="text-danger" id="countries_err1"></p>

                        </div>
                    </div>
                    <div class="col-sm-6 ">

                        <div class="mb-3">
                            <label class="form-label">Gender</label>

                            <div class="form-check">
                                <input class="form-check-input Male radio1" type="radio" name="radio" value="Male">
                                <label class="form-check-label">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input Female radio1" type="radio" name="radio" value="Female">
                                <label class="form-check-label">
                                    Female
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input Bisexuality radio1" type="radio" name="radio" value="Bisexuality">
                                <label class="form-check-label">
                                    Bisexuality
                                </label>
                            </div>


                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input readonly type="text" name="username" id="username1" class="form-control" placeholder="Enter Username">


                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" id="password1" class="form-control" readonly>


                        </div>

                    </div>
                    <div class="col-sm-12">
                        <p class="text-success" id="success1"></p>
                        <p class="text-danger" id="fail1"></p>
                    </div>


                    <button type="button" class="btn btn-success col-sm-6" name="edit" id="edit">Edit</button>
                    <button type="button" class="btn btn-secondary col-sm-6" data-dismiss="modal">Close</button>
                </form>

            </div>

        </div>
    </div>
</div>




<script>
    //kiem tra text
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
        const re = /^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/;
        if (re.test(email)) {
            return true;
        } else {
            return false;
        }

    }

    $(document).ready(function() {


        $('.close').on('click', function() {
            location.reload();
        })
        //dang ki
        $('#register').on('click', function() {
            var email = $('#email').val();
            var birthday = $('#birthday').val();
            var job = $('#job').val();
            var countries = $('#countries').val();
            var gender = $('.radio:checked').val();
            var username = $('#username').val();
            var password = $('#password').val();

            $("#email_err").html("");
            $("#birthday_err").html("");
            $("#job_err").html("");
            $("#countries_err").html("");
            $("#username_err").html("");
            $("#pass_err").html("");
            $("#success").html("");
            $("#fail").html("");




            if (email == "" || birthday == "" || job == "" || countries == "0" || username == "" || password == "") {
                if (email == "") {
                    $("#email_err").html('Vui lòng nhập email!');

                }


                if (birthday == "") {
                    $("#birthday_err").html("Vui lòng chọn ngày sinh");

                }


                if (job == "") {
                    $("#job_err").html("Vui lòng điền công việc");


                }

                if (countries == "0") {
                    $("#countries_err").html("Vui lòng chọn quốc tịch");

                }

                if (username == "") {
                    $("#username_err").html("Vui lòng điền username");

                }
                if (password == "") {
                    $("#pass_err").html("Vui lòng điền mật khẩu");

                }
                return false;

            } else {
                if (IsEmail(email) == false) {
                    $("#email_err").html('Vui lòng nhập đúng email!');
                    return false;

                }
                //form
                if (password.length < 5) {
                    $("#pass_err").html("Mật khẩu dài hơn 6 ký tự!");
                    return false;
                }

                if (IsText(username) == true) {
                    $("#username_err").html("Không chứa ký tự đặc biệt !");
                    return false;

                }
                if (IsText(password) == true) {
                    $("#pass_err").html("Không chứa ký tự đặc biệt !");
                    return false;

                }

                $.ajax({
                    url: "register_admin.php",
                    method: "POST",
                    data: {
                        email: email,
                        birthday: birthday,
                        job: job,
                        countries: countries,
                        gender: gender,
                        username: username,
                        password: password,

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
                        if (response == "ok") {
                            $("#success").html('Đăng ký thành công!');
                            //    setTimeout(function(){ location.reload();},3000);
                        } else {
                            $("#fail").html('Đăng ký thất bại!');

                        }


                    }
                })



            }




        })
        //delete
        $("body").on("click", ".delBtn", function(e) {
            e.preventDefault();
            var tr = $(this).closest('tr');
            del_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            if (response == "true") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500,

                                })
                            }
                            if (response == "false") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',

                                })
                            }

                            setTimeout(function() {
                                location.reload();
                            }, 1500);

                        }
                    })
                }
            })
        })



        //edit
        $("body").on("click", ".editBtn", function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: "edit.php",
                type: "POST",
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = JSON.parse(response);
                    // console.log(data.id);
                    $("#id").val(data.id);
                    $("#email1").val(data.email);
                    $("#birthday1").val(data.birthday);
                    $("#job1").val(data.job);
                    $("#countries1").val(data.countries);

                    if (data.gender == "Male") $(".Male").prop('checked', true);
                    if (data.gender == "Female") $(".Female").prop('checked', true);
                    if (data.gender == "Bisexuality") $(".Bisexuality").prop('checked', true);

                    $("#username1").val(data.username);
                    $("#password1").val(data.password);

                }
            })
        });

        $('#edit').on('click', function(events) {
            events.preventDefault();
            console.log('haha');
            var email1 = $('#email1').val();
            var birthday1 = $('#birthday1').val();
            var job1 = $('#job1').val();
            var countries1 = $('#countries1').val();
            var gender1 = $('.radio1:checked').val();
            var id1 = $("#id").val();



            $("#email_err1").html("");
            $("#birthday_err1").html("");
            $("#job_err1").html("");
            $("#countries_err1").html("");
            $("#success1").html("");
            $("#fail1").html("");

            if (email1 == "" || birthday1 == "" || job1 == "" || countries1 == "0") {
                if (email1 == "") {
                    $("#email_err1").html('Vui lòng nhập email!');

                }

                if (birthday1 == "") {
                    $("#birthday_err1").html("Vui lòng chọn ngày sinh");

                }


                if (job1 == "") {
                    $("#job_err1").html("Vui lòng điền công việc");


                }

                if (countries1 == "0") {
                    $("#countries_err1").html("Vui lòng chọn quốc tịch");

                }

                return false;

            } 
            if (IsEmail(email1) == false) {
                $("#email_err1").html('Vui lòng nhập đúng email!');
                return false;

            }

            if (IsText(job1) == true) {
                $("#job_err1").html("Không chứa ký tự đặc biệt!");
                return false;
            }


            $.ajax({
            url: "update.php",
                method: "POST",
                data: {
                    id:id1,
                    email: email1,
                    birthday: birthday1,
                    job: job1,
                    countries: countries1,
                    gender: gender1
                },
                success: function(response) {
                    // console.log("Trong db");
                    console.log(response);
                    if (response == "email_err") {
                        $("#email_err1").html('Email trùng!');
                    }
                   
                    if(response=="true"){
                        Swal.fire({
                                toast: true,
                                background:'#000',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                icon: 'success',
                                title: 'Save in successfully',
                            })
                        setTimeout(function(){
                            location.reload();
                        },1500);
                       
                    }
                    if(response=="false"){
                        Swal.fire({
                                toast: true,
                                background:'#000',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                icon: 'error',
                                title: 'Sửa thất bại',
                            })
                    }

                }


        })


        });


    })
</script>
</div>