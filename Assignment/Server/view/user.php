<?php
    require('../model/user.php');

    $idUser = $_GET['user_id'];
    $sql = "SELECT * FROM `user` WHERE user_id = '{$idUser}'";
    $show = $connect->query($sql);
    $show->execute();
    $mailUser = $show->fetch();
    // echo "<pre/>";
    // var_dump($mailUser);
    // die;

    if(isset($_POST['btn_submit'])) {
        $phone = $_POST['phone'];
        $name = $_POST['user'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];

        if($pass == "") {
            echo "phai nhap het cac cot";
        } else {
            $data = [
                'name_user' => $name,
                'phone_number_user' => $phone,
                'password_user' => $pass,
                'mail_user' => $email,
            ];
            $user = new user();
            $user->update($data, $idUser);

            if($connect) {
                header('location:../index.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Tài Khoản</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/e123c1a84c.js"crossorigin="anonymous"></script>
    <style>
        label {
            font-size: 18px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST" class="form-login">
            <a href="../index.php"><i class="fas fa-times"></i></a>
            <h1 class="form-heading">Cập Nhật Tài Khoản</h1>
            <div class="form-group">
                <label>Tên đăng nhập :</label><input type="text" class="form-input" name="user" required value="<?php echo $mailUser['name_user']?>">
            </div>
            <div class="form-group">
                <label>Email :</label><input type="email" class="form-input" name="email" required value="<?php echo $mailUser['mail_user']?>">
            </div>
            <div class="form-group">
                <label>Số điện thoại :</label><input type="phone" class="form-input" name="phone" required value="<?php echo $mailUser['phone_number_user']?>">
            </div>
            <div class="form-group">
                <label>Mật Khẩu :</label><input type="text" class="form-input" name="pass">
            </div>
            <input type="submit" value="Cập Nhật" name="btn_submit" class="form-submit">
        </form>
    </div>
</body>
</html>