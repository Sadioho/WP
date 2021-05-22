
<!doctype html>
<html class="no-js" lang="vi">
<head>
<meta charset="utf-8">
<title>SMTP Validate Email v1.0</title>
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h3>Nhập thông tin</h3>
        </div>
        <form action="./" method="post">
            <div class="form-group">
                <label>Danh sách Email</label>
                <textarea class="form-control" name="email-list" rows="10" required><?php if (isset($_POST['email-list'])) echo $_POST['email-list']; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Lọc Danh Sách</button>
        </form>
        <div class="page-header">
            <h3>Kết quả</h3>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="10" onclick="this.select();">
                <?php
                    $invalid_emails = [];
                    if (isset($_POST['submit'])) {
                        $email_list = strtolower($_POST['email-list']);
                        $email_list = explode("\n", str_replace("\r", "", $email_list));
                        require('inc/smtp-validate-email.php');
                        $from = 'a-happy-camper@campspot.net';
                        foreach ($email_list as $item) {
                            $validator = new SMTP_Validate_Email($item, $from);
                            $smtp_results = $validator->validate();
                            if ($smtp_results[$item]) {
                                echo $item . "\n";
                            } else {
                                array_push($invalid_emails, $item);
                            }
                        }
                    }
                ?>
            </textarea>
        </div>
        <div class="page-header">
            <h3>Không hợp lệ</h3>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="10" onclick="this.select();">
                <?php
                    foreach ($invalid_emails as $item) {
                        echo $item . "\n";
                    }
                ?>
            </textarea>
        </div>
        <hr>
        <footer>
            <p>© <?php echo date('Y'); ?> SMTP Validate Email v1.0</p>
        </footer>
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>  