<?php
    session_start();
    require('../model/connect.php');
    require('../model/room.php');
    require('../model/kindRoom.php');

    $sql = "SELECT count(*) FROM `room`";
    $show = $connect->query($sql);
    $show->execute();
    // so ban ghi trong database
    $totalPage = $show->fetchColumn();

    $limit = 6;
    $page = ceil($totalPage / $limit);

    if(!empty($_GET['page'])) {
        $paging = $_GET['page'];  
    } else {
        $paging = 1;
    }

    // lay ban ghi tiep theo
    $offset = $limit * ($paging - 1);

    $sql_limit = "SELECT kindroom.kind_of_room_id,kindroom.kind_of_room, room.name_room, kindroom.price, kindroom.describe, kindroom.image  
    FROM `room` INNER JOIN `kindroom` ON room.kind_of_room_id = kindroom.kind_of_room_id limit $limit offset $offset";
    $show_limit = $connect->query($sql_limit);
    $show_limit->execute();
    $list_limit = $show_limit->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/deitails.css">
    <script src="https://kit.fontawesome.com/290fc3f375.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/room.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <a href="../index.php"><img src="../view/img/logo.png" alt=""></a>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php">home</a></li>
                    <li><a href="./htroom.php">room</a></li>
                    <li><a href="./lichsudatphong.php">Hotel Booking History</a></li>
                </ul>
            </nav>

            <?php
            if (!isset($_SESSION['name_user'])) {
            ?>
                <div class="sign-in__sign-out">
                    <a href="../view/dangnhap.php"><button>Login</button></a>
                    <a href="../view/dangky.php"><button>Sign up</button></a>
                </div>
            <?php
            } else {
            ?>
                <div class="sign-in__sign-out">
                    <a href="./htuser.php"><i class="fas fa-user"></i></a>
                    <a href="./dangxuat.php"><button>Logout</button></a>
                </div>
            <?php
            }
            ?>
        </header>
        <div class="room">
            <h2>Room</h2>
            <div class="content_room">
                <?php
                foreach ($list_limit as $item) {
                ?>
                    <div class="content_item_room">
                        <a href="../chitiet.php?kind_of_room_id=<?php echo $item['kind_of_room_id'] ?>">
                            <strong><?php echo $item['kind_of_room'] ?></strong><br>
                            <p><?php echo $item['name_room'] ?></p>
                            <div class="img_room">
                                <img src="../controller/kindRoom/<?php echo $item['image'] ?>" width="100%" height="250px">
                            </div>
                            <p><?php echo $item['price'] ?><span>VND</span></p>
                            <p><?php echo $item['describe'] ?></p>
                        </a>

                    </div>
                <?php
                }
                ?>
            </div>
            <div class="page">
                <?php
                    for($i = 1; $i <= $page; $i++) {
                ?>
                    <ul><a href="htroom.php?page=<?php echo $i;?>"><?php echo $i; ?></a></ul>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
<footer>
    <div class="footer">
        <p class="text">
            All material herein © 2005–2022 Agoda Company Pte. Ltd. All Rights Reserved. <br> <br>
            Agoda is part of Booking Holdings Inc., the world leader in online travel & related services.
        </p>
        <p class="icon-footer">
            <img src="../view/img/ft1.png" alt="">
            <img src="../view/img/ft2.png" alt="">
            <img src="../view/img/ft3.png" alt="">
            <img src="../view/img/ft4.png" alt="">
            <img src="../view/img/ft5.png" alt="">
            <img src="../view/img/ft6.png" alt="">
        </p>
    </div>
</footer>
</body>

</html>