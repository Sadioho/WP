<form method="post" class="m-auto" id="changepass">
    <h1 class="text-center text-danger ">Change Pass</h1>
    <div class="form-group mt-5">
        <label>Current Password</label>
        <input type="password" name="currentpass" id="currentpass" class="form-control" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password" required>
    </div>
    <div class="form-group">
        <label>Repeat New Password</label>
        <input type="password" name="repeatnewpass" id="repeatnewpass" class="form-control" placeholder="Repeat New Password" required>
    </div>
    <p class="text-danger" id="fail"></p>
    <p class="text-info" id="succ"></p>
    <button type="submit" name="uppass" class="btn btn-success">Đổi mật khẩu</button>
</form>



<script>
    $(document).ready(function() {
        $("#changepass").submit(function(e) {
            e.preventDefault();
            var currentpass= $("#currentpass").val();
            var newpass=$("#newpass").val();
            var repeatnewpass=$("#repeatnewpass").val();
            $("#fail").html("");
            $("#succ").html("");
            if(repeatnewpass!=newpass){
                $("#fail").html("Mật khẩu không trùng !");
                return false;
            }

            $.ajax({
                url: 'changepass.php',
                method: 'post',
                data:{
                    currentpass : currentpass ,
                    newpass : newpass ,
                },
                success: function(response) {
                  $("#succ").html(response);
                }
            })
        })


    })
</script>