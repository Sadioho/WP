
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        
    </head>
    <body>
        <form method="POST" >
        <div  class="mb-3">
            <label>Captcha</label>
            <input id="captcha" class="input" name="captcha" type="text" />
            <img id="captcha_code" src="captcha_code.php" alt="" />
            <p id="err_captcha"></p>
            <button class="btnRefresh" name="submit">Refresh Captcha</button>
        </div>
        
        <div>
            <button class="btnAction" name="submit">Send</button>
        </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

        $('.btnAction').click(function(e){
            e.preventDefault();
            if($('#captcha').val() == '')
            {
                $("#err_captcha").html("Bạn phải nhập mã Captcha!");
                return false;  
            }else{
                var captcha= $('#captcha').val();
                console.log(captcha);
            }
            
            $.ajax({
                url: 'checkcap.php',
                method: 'post',
                data:{captcha:captcha},
                success: function(response) {
                    console.log(response);
                    $("#err_captcha").html(response);
                    
                }
            })
            })
            
            $('.btnRefresh').click(function(){
                $("#captcha_code").attr('src','captcha_code.php');
                return false;
            })	


        })
    </script>
    </body>
</html>
