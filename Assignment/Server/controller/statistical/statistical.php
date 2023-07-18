<?php
    require('../../model/connect.php');
    $sql = "SELECT kindroom.*, COUNT(roombooked.kind_of_room_id) AS 'number' FROM roombooked INNER JOIN kindroom ON roombooked.kind_of_room_id = kindroom.kind_of_room_id  GROUP BY roombooked.kind_of_room_id";
    $show = $connect->query($sql);
    $show->execute();
    $data = $show->fetchAll();

    // echo "<pre/>";
    // var_dump($data);
    // die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thong Ke</title>
    <script src="https://kit.fontawesome.com/290fc3f375.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="../quanTri.css">
    <link rel="stylesheet" href="../kindRoom/kindRoom.css">
    <link rel="stylesheet" href="thongKe.css">
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
            <h1><i class="fa-solid fa-hippo"></i> Thống Kê <i class="fa-solid fa-hippo"></i></h1>
        </div>
        <hr>
        <div class="content-1">
            <div class="one">
                <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['kind_of_room', 'number'],
                        <?php
                            foreach ($data as $item) {
                                echo "['$item[kind_of_room]', $item[number]],";
                            }
                        ?>
                    ]);

                    var options = {
                        title: 'Thống Kê Loại Phòng Được Đặt!!!',
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                    }
                </script>
                <div id="piechart_3d" style="width: 800px; height: 600px;"></div>
            </div>
            <div class="two">
                <?php
                    $sum = 0;
                    foreach ($data as $item) {
                        $sum = $sum + $item['price'];
                        $x = $item['number'] * $item['price'];
                ?>
                <div class="thong-ke">
                    <h4>
                        Tổng Số <?php echo $item['kind_of_room']; ?> Được Đặt Là : <?php echo $item['number'] . " Phòng"; ?><br>
                        Tổng Số Tiền Từ <?php echo $item['kind_of_room']; ?> Là : <?php echo $x ."VNĐ"; ?> <br>
                    </h4>
                </div>
                <?php
                    }
                ?>
                <h3>Tổng Số Tiền Thu Được Là :<?php echo $sum . "VNĐ" ?></h3>
            </div>
        </div>
    </div>
</div>
</body>
</html>