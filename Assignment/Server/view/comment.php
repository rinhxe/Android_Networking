<?php
    require('./model/comment.php');

    if(isset($_POST['btn_submit'])) {
        if(isset($_SESSION['user_id']) && !empty($_POST['cmt2'])) {
            $title = $_POST['cmt2'];
            $id_room = $_GET['kind_of_room_id'];
            $today = date("Y/m/d");
            $maKH = $_SESSION['user_id'];
    
            $sql = "INSERT INTO `comment` (`comment_id`, `kind_of_room_id`, `user_id`, `content_comment`, `date_created_comment`, `status`) 
            VALUES (NULL, '{$id_room}', '{$maKH}', '{$title}', '{$today}', 'Chưa Duyệt')";
            $result = $connect->query($sql);
            
            echo "<script>alert('Cam on da binh luan ve san pham.')</script>";
        } else {
            echo "<script>alert('Hay Dang Nhap De Comment.')</script>";
        }
    }
    
?>
<form action=""method="POST">
    <div class="sub-produc">
        <textarea placeholder="Bình Luận Ở Đây!" id="cmt1" name="cmt2" rows="5" cols="150"></textarea><br>
        <input class="d1" type="submit" name="btn_submit" id="" value = "Gửi Bình Luận">
    </div>
</form>