<?php
    require('../../model/connect.php');
    require('../../model/bookedRoom.php');
    require('../../model/room.php');
    $bookedRoom = new BookedRoom();

    if (isset($_POST['search_detailed'])){
        $data_search = $_POST['search_detailed'];
        $data_search == '' ? $list = $bookedRoom->getDataBookedRoom() : $list = $bookedRoom->searchBookedRoom($data_search);
    } else{
        $list = $bookedRoom->getDataBookedRoom();
    }
    date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quan Tri Kind Of Room</title>
    <script src="https://kit.fontawesome.com/290fc3f375.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../quanTri.css">
    <link rel="stylesheet" href="../kindRoom/kindRoom.css">
    <link rel="stylesheet" href="./bRoom.css">
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
            <div>
                <h1><i class="fa-solid fa-bug"></i> Booked Room <i class="fa-solid fa-bug"></i></h1>
            </div>
            <hr>
            <div class="hangHoa">
                <form action="" method="post" enctype="multipart/form-data" class="search">
                    <input type="text" name="search_detailed" placeholder="phone number...">
                    <input type="submit" value="Tìm kiếm">
                </form>
                <table>
                    <thead>
                        <tr>
                            <th class="id">id</th>
                            <th>Kind of room</th>
                            <th>User name</th>
                            <th>Number phone</th>
                            <th>start time</th>
                            <th>End time</th>
                            <th>Amount</th>
                            <th>Total money</th>
                            <th>Trạng thái</th>
                            <th>Xếp phòng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                       
                            foreach ($list as $item) {
                            ?>
                        <tr>
                            <td class="id"><?=$item['rombooked_id']?></td>
                            <td><?=$item['kind_of_room']?></td>
                            <td><?=$item['name_user']?></td>
                            <td><?=$item['phone_number_user']?></td>
                            <td><?=$item['start_time']?></td>
                            <td><?=$item['end_time']?></td>
                            <td><?=$item['amount']?> người</td>
                            <td><?=$item['total_money']?></td>
                            <td><?=$item['status']?></td>
                            <td>
                                <form
                                    action="../order_detailed/add.php?rombooked_id=<?=$item['rombooked_id']?>&amount=<?=$item['amount']?>&amount_max=<?=$item['quantity_max']?>"
                                    method="post" enctype="multipart/form-data">
                                    <select name="room_order">
                                        <?php
                                            $list_room = $bookedRoom->getDataRoom($item['kind_of_room_id']);
                                            foreach ($list_room as $value_room) {
                                        ?>
                                        <option value="<?=$value_room['room_id']?>"><?=$value_room['name_room']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <button type="submit">OK</button>
                                    <?php
                                        echo '<a href="huyBookedRoom.php?id='.$item['rombooked_id'].'">
                                        <input type="button" value="Hủy"></a>';
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

</html>