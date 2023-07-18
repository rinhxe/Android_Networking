<?php
    require('../model/user.php');

    if(isset($_POST['btn_submit'])) {
        $mail = $_POST["mail"];

        // lay mail trong database va so sanh
        $sql = "SELECT * FROM `user` WhERE `mail_user` = '{$mail}'";
        $show = $connect->query($sql);
        $show->execute();
        $mailUser = $show->fetch();
        // echo "<pre/>";
        // var_dump($list_mail);
        // die;

        if($mailUser) {
            // echo "<pre/>";
            // var_dump($mailUser);
            header('location:./user.php?user_id='.$mailUser['user_id']);
        } else {
            echo "Email Ban Nhap Khong Dung";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/e123c1a84c.js"crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST" class="form-login">
            <a href="../index.php"><i class="fas fa-times"></i></a>
        
            <h1 class="form-heading">Nhập Email Để Tiếp Tục</h1>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-input" name="mail" placeholder="Email" required>
            </div>
            <input type="submit" value="Submit" name="btn_submit" class="form-submit">
        </form>
    </div>
</body>
</html>