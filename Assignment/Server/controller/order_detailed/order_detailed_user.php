<?php
require '../../model/OrderDetailed.php';
$order = new orderDetailed();



if (isset($_GET['user'])){
    $user = $_GET['user'];
    $list_order_detailed = $order->getDataOrderDetailed($user);
}
date_default_timezone_set("Asia/Ho_Chi_Minh");
$date = date("Y-m-d");
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
    <link rel="stylesheet" href="./order_detailed.css">
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
                <h1><i class="fa-solid fa-ghost"></i> Order Detailed <i class="fa-solid fa-ghost"></i></h1>
            </div>
            <hr>
            <div class="hangHoa">
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Kind of room</th>
                            <th>Room</th>
                            <th>User name</th>
                            <th>Number phone</th>
                            <th>start time</th>
                            <th>End time</th>
                            <th>Amount</th>
                            <th>Total money</th>
                            <th>Trả phòng</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                foreach ($list_order_detailed as $item) {
                    ?>
                        <tr>
                            <td><?=$item['id_order_detailed']?></td>
                            <td><?=$item['kind_of_room']?></td>
                            <td><?=$item['name_room']?></td>
                            <td><?=$item['name_user']?></td>
                            <td><?=$item['phone_number_user']?></td>
                            <td><?=$item['start_time']?></td>
                            <td><?=$item['end_time']?></td>
                            <td><?=$item['amount']?> người</td>
                            <td><?=$item['total_money']?> VND</td>
                            <td>
                                <?php
                            if ($date >= $item['end_time'] && $item['order_status'] == 'Đang Sử Dụng'){
                                ?>
                                <a
                                    href="update.php?room_id=<?=$item['room_id']?>&order_id=<?=$item['id_order_detailed']?>&user=<?=$item['name_user']?>"><button class="update">Trả phòng</button></a>
                                <?php
                            }else {
                                echo '<input disabled type="submit" name="traphong" value="Trả phòng" >                                         ';
                            }
                            ?>
                            </td>
                            <td><?=$item['order_status']?></td>
                        </tr>
                        <?php
                }
                ?>
                    </tbody>
                </table>
                <a href="order_detailed.php">
                    <button style="cursor: pointer">Quay lại</button></a>
            </div>
        </div>
    </div>
</body>

</html>

</html>