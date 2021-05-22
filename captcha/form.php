<?php
if (isset($_POST["submit"])) {
    $name;

    $captcha;
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
    }
   
    if (isset($_POST["g-recaptcha-response"])) {
        $captcha = $_POST["g-recaptcha-response"];
    }
    if (!$captcha) {
        echo "<h2 style='margin: auto;text-align: center;font-family: sans-serif;color: #00363b;'>Xác nhận Google reCAPTCHA v2 trước nhé :)</h2>";
    } else {
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeJZ3kaAAAAAH5l02s6nqoqKEssDY3lnwBUMsYh&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response.success == false) {
            echo "<h2>Your account has been logged as a spammer, you cannot continue!</h2>";
        } else {
            echo "<h2 style='margin: auto;text-align: center;font-family: sans-serif;color: #00363b;'>" . $name . " không phải Robot đâu nhé :)</h2>";
        }
    }
}

?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<form action="" method="POST" >
  <legend>Form title</legend>
  <div class="form-group">
    <input type="text" name="name" class="form-control" >
  </div>
  <div class="g-recaptcha" data-sitekey="6LeJZ3kaAAAAAH5l02s6nqoqKEssDY3lnwBUMsYh"></div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
