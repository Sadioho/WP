<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'db.php';
if (empty($_SESSION['username'])) {
    header('location:index.php');
}



$id = $_SESSION['id'];
$sql_detail = "select * from acount where id='$id'";
$query_detail = mysqli_query($conn, $sql_detail);
$row = mysqli_fetch_assoc($query_detail);

?>

<?php if(isset($_SESSION['fb'])){ ?>
    

    <div class="col-sm-6 m-auto">
        <h1 class="text-center text-success">Chi tiết</h1>
        <div class="card m-auto" style="width: 20rem;">
            <img class="card-img-top" src="<?php echo $_SESSION['user_image']; ?>" alt="Card image cap">

            <div class="card-body">
                <h5 class="card-title">Username : <?php echo $_SESSION['username']; ?> </h5>
                <p class="text-info">Email: <span class="text-dark"> <?php echo $_SESSION['user_email']; ?></span> </p>
                <p class="text-info">BirthDay: <span class="text-dark"> <?php echo $_SESSION['user_birthday']; ?></span> </p>
                <p class="text-info">Job: <span class="text-dark"></span> </p>
                <p class="text-info">Countries: <span class="text-dark"> <?php echo $_SESSION['user_location']; ?></span> </p>
                <p class="text-info">Gender: <span class="text-dark"> <?php echo $_SESSION['user_gender']; ?></span> </p>





            </div>
        </div>
    </div>

<?php } else {?>


<div class="col-sm-9 m-auto">
    <h1 class="text-center text-success">Chi tiết</h1>
    <div class="card m-auto" style="width: 20rem;">
        <img class="card-img-top" src=" ./img/<?php echo $row['avatar'] ?>" alt="Card image cap">

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" id="upload-box">
                <div class="form-group">
                    <label>Cập nhật ảnh đại diện</label>
                    <input type="file" id='file' name="image" class="form-control-file">
                    <button type="submit" id="upload" class='mt-1 btn btn-success'>Cập nhật</button>
                </div>
                <p class="text-success" id="succ"></p>
                <!-- <p class="text-danger" id="fail"></p> -->
            </form>
            <h5 class="card-title">Username : <?php echo $row['username']; ?> </h5>
            <form action="" method="POST">
                    <input type="hidden" id="id" value="<?php echo $row['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?php echo $row['email']; ?>">
                    <p class="text-danger" id="email_err"></p>

                </div>
                <div class="mb-3">
                    <label class="form-label">Birthday</label>
                    <input type="date" name="birthday" id="birthday" class="form-control" value="<?php echo $row['birthday']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Job</label>
                    <input type="text" name="job" id="job" class="form-control" placeholder="Enter job" value="<?php echo $row['job']; ?>">
                    <p class="text-danger" id="job_err"></p>

                </div>
                <div class="mb-3">
                    <label class="form-label">Countries</label>
                    <select class="form-select" aria-label="Default select example" name="countries" id="countries">
                        <option value="0">Countries</option>
                        <option value="USA" <?php if ($row['countries'] === "USA") {
                                                echo "selected";
                                            } ?>>USA</option>
                        <option value="China" <?php if ($row['countries'] === "China") {
                                                    echo "selected";
                                                } ?>>China</option>
                        <option value="England" <?php if ($row['countries'] === "England") {
                                                    echo "selected";
                                                } ?>>England</option>
                    </select>
                    <p class="text-danger" id="countries_err"></p>

                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>

                    <div class="form-check">
                        <input class="form-check-input radio" type="radio" name="radio" value="Male" id="flexRadioDefault1" checked>
                        <label class="form-check-label">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input radio" type="radio" name="radio" value="Female"  <?php
                                                                                                                                if ($row['gender'] === 'Female') {
                                                                                                                                    echo "checked";
                                                                                                                                }
                                                                                                                                ?>>
                        <label class="form-check-label">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input radio" type="radio" name="radio" value="Bisexuality"  <?php if ($row['gender'] === 'Bisexuality') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                        <label class="form-check-label">
                            Bisexuality
                        </label>
                    </div>
                </div>
                <button type="submit" id="edit_profile" class='mt-1 btn btn-success'>Lưu</button>

            </form>

        </div>
    </div>
</div>


<?php }?>


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


        $("#upload-box").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'upload.php',
                method: 'post',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response=="1"){
                        Swal.fire({
                                toast: true,
                                background:'#000',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                icon: 'success',
                                title: 'Update in successfully',
                            })
                        setTimeout(function(){
                            location.reload();
                        },1500);
                        
                    }else{
                        $("#succ").html(response);

                    }
                    

                }
            })
        });



        $("#edit_profile").on('click', function(event) {
            event.preventDefault();
            var id = $('#id').val();
            var email = $('#email').val();
            var birthday = $('#birthday').val();
            var job = $('#job').val();
            var countries = $('#countries').val();
            var gender = $('.radio:checked').val();

            $("#email_err").html("");
            $("#job_err").html("");
            $("#countries_err").html("");
            $("#success").html("");
            $("#fail").html("");

            if (email == "" || job == "" || countries == "0") {
                if (email == "") {
                    $("#email_err").html("Không được để trống!");
                }
                if (job == "") {
                    $("#job_err").html("Không được để trống");

                }
                if (countries == "0") {
                    $("#countries_err").html("Chọn quốc gia");

                }
                return false;

            }else{

            if (IsEmail(email) == false) {
                $("#email_err").html("Điền cho đúng email thằng lol !");
                return false;
            }

            if (IsText(job) == true) {
                $("#job_err").html("Khoông chứa ký tự đặc biệt!");
                return false;
            }
        }


        $.ajax({
            url: "update.php",
                method: "POST",
                data: {
                    id:id,
                    email: email,
                    birthday: birthday,
                    job: job,
                    countries: countries,
                    gender: gender,
                },
                success: function(response) {
                    // console.log("Trong db");
                    console.log(response);
                    if (response == "email_err") {
                        $("#email_err").html('Email trùng!');
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
                       
                    }
                    if(response=="false"){
                        Swal.fire({
                                toast: true,
                                background:'#000',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                icon: 'error',
                                title: 'Save in successfully',
                            })
                    }

                }


        })


           

        })













    })
</script>