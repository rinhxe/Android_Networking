<?php
    require('../../model/kindRoom.php');
    require('../../model/imageRoom.php');
    require('../../library/Image.php');

    $id = (int)$_GET['id'];
    // lay du lieu cu
    $sql = "SELECT * FROM `kindroom` WHERE kind_of_room_id = {$id}";
    $result = $GLOBALS['connect']->query($sql);
    $listKindRoom = $result->fetch();

    if(isset($_POST['btn_submit'])) {

        $title = $_POST['title'];
        $price = $_POST['price'];
        $describe = $_POST['describe'];
    
        // upload thumnail
        $uploadThumnail = new Image();
        $uploadPathThumnail = $uploadThumnail->upload($_FILES['anh']['tmp_name'], $_FILES['anh']['name']);

        // upload Image
        $imageNames = [];
        foreach ($_FILES['images']['name'] as $key => $name) {
            // $uploadPathImage= $upaloadDir . $name;
            // move_uploaded_file($_FILES['images']['tmp_name'][$key], $uploadPathImage);
            if(!empty($_FILES['images']['tmp_name'][$key]) && !empty($name)) {
                $uploadImage = new Image();
                $uploadPathImage = $uploadImage->upload($_FILES['images']['tmp_name'][$key], $_FILES['images']['name'][$key]);
                $imageNames[] = $uploadPathImage;
            }
        }

        if($title == "") {
            $err = "phải nhập hết các cột";
        }
        $id_kindRoom = [
            'kind_of_room_id' => $id,
        ];
        $kind_of_room = [
            'kind_of_room' => $title,
            'price' => $price,
            'describe' => $describe,
            'image' => $uploadPathThumnail,
        ];

        $kindRoom = new KindRoom();
        $kindRoom->update($id_kindRoom, $kind_of_room);

        // Img Room
        // $Id = [
        //     'room_image_id' => $id,
        // ];

        foreach($imageNames as $imagePath) {
            $imageRoomData[] = [
                'image_room' => $imagePath,
                'kind_of_room_id' => $id
            ];
        }
        $imageRoom = new imageRoom();
        $imageRoom->update($id, $imageRoomData);

        if($connect) {
            header('location:kindRoom.php');
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
    <link rel="stylesheet" href="add.css">
    <script src="https://kit.fontawesome.com/290fc3f375.js" crossorigin="anonymous"></script>
    <title>Update</title>
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
                    <label class="tin" for="">Kind Of Room</label> <br>
                    <input class="the" type="text" name="title" required value="<?php echo $listKindRoom['kind_of_room']?>">
                </div>
                <div>
                    <label class="tin" for="">Price</label>
                    <input class="the" type="text" name="price" required value="<?php echo $listKindRoom['price']?>">
                </div>
                <div>
                    <label class="tin" for="">Describe</label> <br>
                    <textarea class="the" name="describe" id="" cols="192" rows="7" required value="<?php echo $listKindRoom['describe']?>"></textarea>
                </div>
                <div>
                    <label class="tin" for="">Thumbnail</label>
                    <input class="the" type="file" name="anh" required value="<?php echo $listKindRoom['image']?>">
                    <img src="<?php echo $listKindRoom['image']?>" width="200px" height="200px">
                </div>
                <div>
                    <label for="">Image Room</label><br>
                    <input type="file" name="images[]" id=""><br>
                    <input type="file" name="images[]" id=""><br>
                    <input type="file" name="images[]" id="">
                </div>
                <div>
                    <input class="nut" name= "btn_submit" type="submit" value="Updata">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
