<?php
if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username'])) {
    header('location:index.php');
}


?>



<form method="post" class="m-auto col-xl-6" novalidate id="changepass">
    <h1 class="text-center text-danger ">Change Pass</h1>
    <div class="form-group mt-5">
        <label>Current Password</label>
        <input type="password" name="currentpass" id="currentpass" class="form-control" placeholder="Password">
        <p class="text-danger" id="currentpasserr"></p>

    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password">
        <p class="text-danger" id="newpasserr"></p>

    </div>
    <div class="form-group">
        <label>Repeat New Password</label>
        <input type="password" name="repeatnewpass" id="repeatnewpass" class="form-control" placeholder="Repeat New Password">
        <p class="text-danger" id="repeatnewpasserr"></p>

    </div>
    <p class="text-danger" id="fail"></p>
    <p class="text-info" id="succ"></p>
    <button type="submit" name="uppass" class="btn btn-success">Đổi mật khẩu</button>
</form>



<script>
    function IsText(string) {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        if (format.test(string)) {
            return true;
        } else {
            return false;
        }
    }

    $(document).ready(function() {
        $("#changepass").submit(function(e) {
            e.preventDefault();
            var currentpass = $("#currentpass").val();
            var newpass = $("#newpass").val();
            var repeatnewpass = $("#repeatnewpass").val();

            $('#currentpasserr').html("");
            $('#newpasserr').html("");
            $('#repeatnewpasserr').html("");


            if (currentpass == "" || newpass == "" || repeatnewpass == "") {
                if (currentpass == "") {
                    $('#currentpasserr').html("Không để trống");
                }
                if (newpass == "") {
                    $('#newpasserr').html("Không để trống");
                }
                if (repeatnewpass == "") {
                    $('#repeatnewpasserr').html("Không để trống");
                }



                return false;
            }

            if (currentpass.length < 5) {
                $('#currentpasserr').html("Pass lớn hơn 6");
                return false;

            }
            if (newpass.length < 5) {
                $('#newpasserr').html("Pass lớn hơn 6");
                return false;

            }
            if (repeatnewpass.length < 5) {
                $('#repeatnewpasserr').html("Pass lớn hơn 6");
                return false;

            }

            if (IsText(currentpass) == true) {
                $('#currentpasserr').html("Không chứa ký tự đặc biệt");
                return false;

            }
            if (IsText(newpass) == true) {
                $('#newpasserr').html("Không chứa ký tự đặc biệt");
                return false;

            }
            if (IsText(repeatnewpass) == true) {
                $('#repeatnewpasserr').html("Không chứa ký tự đặc biệt");
                return false;

            }

            if (newpass != repeatnewpass) {
                $('#repeatnewpasserr').html("Không khớp");
                return false;
            }

            $("#fail").html("");
            $("#succ").html("");


            $.ajax({
                url: 'changepass.php',
                method: 'post',
                data: {
                    currentpass: currentpass,
                    newpass: newpass,
                },
                success: function(response) {
                    // console.log(response);
                    if (response == "true") {
                        Swal.fire({
                                toast: true,
                                background:'#000',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                icon: 'success',
                                title: 'Save Password in successfully',
                            })
                        $("#succ").html("Thay đổi password thành công !");

                    }

                    if (response == "false") {
                        $("#currentpasserr").html("Mật khẩu không đúng");
                    }


                    if (response == "false2") {
                        $("#fail").html("Chọn mật khẩu khác mật khẩu trùng với mật khẩu cũ rồi!");
                    }
                }
            })
        })


    })
</script>