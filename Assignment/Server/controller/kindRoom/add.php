<?php
require('../../model/kindRoom.php');
require('../../model/imageRoom.php');
require('../../library/Image.php');

if (isset($_POST['btn_submit'])) {

    $title = $_POST['title'];
    $price = $_POST['price'];
    $describe = $_POST['describe'];

    if ($title == "") {
        $err = "phải nhập hết các cột";
    } else {

        // upload thumnail
        $uploadThumnail = new Image();
        $uploadPathThumnail = $uploadThumnail->upload($_FILES['anh']['tmp_name'], $_FILES['anh']['name']);

        // upload Image
        $imageNames = [];
        foreach ($_FILES['images']['name'] as $key => $name) {
            if(!empty($_FILES['images']['tmp_name'][$key]) && !empty($name)) {
                $uploadImage = new Image();
                $uploadPathImage = $uploadImage->upload($_FILES['images']['tmp_name'][$key], $name);
                $imageNames[] = $uploadPathImage;
            }
        }

        $data = [
            'kind_of_room' => $title,
            'price' => $price,
            'describe' => $describe,
            'image' => $uploadPathThumnail,
        ];

        $kindRoom = new KindRoom();
        $roomId = $kindRoom->add($data);

        // Img Room
        foreach($imageNames as $imagePath) {
            $imageRoomData = [
                'kind_of_room_id' => $roomId,
                'image_room' => $imagePath,
            ];
            $imageRoom = new imageRoom();
            $imageRoom->add($imageRoomData);
        }

        if ($connect) {
            header('location:kindRoom.php');
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
    <link rel="stylesheet" href="../quanTri.css">
    <link rel="stylesheet" href="./kindRoom.css">
    <script src="https://kit.fontawesome.com/290fc3f375.js" crossorigin="anonymous"></script>
    <title>Add</title>
</head>

<body>
    <div class="admin">
        <div class="category">
            <div class="logo">
                <a href="../quanTri.php"><img src="../../view/img/logo.png" alt=""></a>
            </div>
            <hr>
            <div class="category-1">
                <div class="test-1">
                    <a href="../kindRoom/kindRoom.php">
                        <i class="fa-regular fa-face-grin-wide"></i><p class="kind">Kind Of Room</p>
                    </a>
                </div> <br>
                <div class="test-1">
                    <a href="../room/room.php">
                        <i class="fa-solid fa-face-grin-stars"></i><p>Room</p>
                    </a>
                </div> <br>
                <div class="test-1">
                    <a href="../roomImage/image.php">
                        <i class="fa-regular fa-face-dizzy"></i><p>Room Image</p>
                    </a>
                </div> <br>
                <div class="test-1">
                    <a href="../user/user.php">
                        <i class="fa-solid fa-face-laugh-squint"></i><p>User</p>
                    </a>
                </div> <br>
                <div class="test-1">
                    <a href="../bookedRoom/bookedroom.php">
                        <i class="fa-regular fa-face-grin-squint-tears"></i><p>Booked Room</p>
                    </a>
                </div> <br>
                <div class="test-1">
                    <a href="../comment/cmt.php">
                    <i class="fa-solid fa-face-grin-wink"></i><p>Comment</p>
                    </a>
                </div> <br>
                <div class="test-1">
                    <a href="../order_detailed/order_detailed.php">
                    <i class="fa-regular fa-face-grin-tongue-wink"></i><p>Order Detailed</p>
                    </a> 
                </div> <br>
                <div class="test-1">
                    <a href="../statistical/statistical.php">
                    <i class="fa-solid fa-face-kiss-wink-heart"></i><p>Statistical</p>
                    </a>
                </div> <br>
            </div>
            <div class="logout">
                <a href="../dangXuat.php">
                    <p><i class="fa-solid fa-right-from-bracket"></i> LogOut</p>
                </a>
            </div>
        </div>
        <div class="content">
            <h1>Kind Of Room</h1>
            <hr>
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label class="tin" for="">Kind Of Room</label> 
                    <input class="the" type="text" name="title" id="">
                </div>
                <div>
                    <label class="tin" for="">Price</label>
                    <input class="the" type="text" name="price" id="">
                </div>
                <div>
                    <label class="tin" for="">Describe</label><br>
                    <textarea name="describe" id="" cols="192" rows="7" placeholder="Describe Room"></textarea>
                </div>
                <div>
                    <label class="tin" for="">Thumbnail</label>
                    <input class="the" type="file" name="anh" id="">
                </div>
                <!-- nhieu anh  -->
                <div>
                    <label class="tin" for="">Image Room</label><br>
                    <input class="the" type="file" name="images[]" id=""><br>
                    <input class="the" type="file" name="images[]" id=""><br>
                    <input class="the" type="file" name="images[]" id="">
                </div>
                <!--  -->
                    <input class="nut" type="submit" name="btn_submit" id="" value="Thêm">
                </div>
            </form>
        </div>
    </div>
</body>

</html>