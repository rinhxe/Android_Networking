<?php
    require('../model/connect.php');
    
    session_start();
    if(isset($_SESSION['name_user']) && isset($_SESSION['user_id']) ){
        $username = $_SESSION['name_user'];
        $userID = $_SESSION['user_id'];
        
        $sql_user = "SELECT * FROM `user` WHERE user_id = $userID";
        $result = $connect->query($sql_user);
        $result->execute();
        $user_infor = $result->fetch();
        
        $sql_imageroom = "SELECT kindroom.kind_of_room,kindroom.image,roombooked.total_money,kindroom.describe,roombooked.start_time,roombooked.end_time,roombooked.amount,roombooked.status 
        FROM kindroom INNER JOIN roombooked ON kindroom.kind_of_room_id = roombooked.kind_of_room_id WHERE roombooked.user_id = $userID ORDER BY roombooked.created_time DESC";
        $result = $connect->query($sql_imageroom);
        $result->execute();
        $room_infor = $result->fetchAll();
    }
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="./css/lichsudatphong.css">
<link rel="stylesheet" href="./css/style.css">

<div class="invoice">
    <div class="invoice-company text-inverse f-w-600">
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
                if(!isset($_SESSION['name_user'])) {
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
        <?php
            if(!empty($user_infor)) {
        ?>
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <small>From</small>
            <address class="m-t-5 m-b-5">
                <strong class="text-inverse">Big Hotel.</strong><br>
                Street Trinh Van Bo<br>
                City, Ha Noi<br>
                Phone: (+94) 0123456789 <br>
                Fax: (+94) 456-7890
            </address>
        </div>
        <div class="invoice-to">
            <small>to</small>
            <address class="m-t-5 m-b-5">
                <strong class="text-inverse"><?php echo $user_infor['name_user'] ?></strong><br>
                Phone:(+94) <?php echo $user_infor['phone_number_user'] ?><br>
                E-mail: <?php echo $user_infor['mail_user'] ?>
            </address>
        </div>
        <div class="invoice-date">
            <div class="date text-inverse m-t-5">November 30,2022</div>
            <div class="text-inverse">
                Services Product
            </div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
        <?php
            if(!empty($room_infor)){
        ?>
            <?php 
                foreach ($room_infor as $item) {
            ?>
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th class="text-one" width="10%" >TÊN PHÒNG</th>
                            <th class="text-right" width="50%" >MÔ TẢ</th>
                            <th class="text-center" width="20%" >ẢNH PHÒNG</th>
                            <th class="text-center" width="10%" >SỐ LƯỢNG </th>
                            <th class="text-center" width="10%" >STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="text-one"><?php echo $item['kind_of_room'] ?></span><br></td>
                            <td class="text-right"><?php echo $item['describe'] ?></td>
                            <td class="text-center"><span><img src="../controller/kindRoom/<?php echo $item['image'] ?>" width="80%" height="70%" class="cangiua"></span></td>
                            <td class="text-center"><?php echo $item['amount'] ?></td>
                            <td class="text-center"><?php echo $item['status'] ?></td>
                        </tr>
                    </tbody>
                </table>
        </div>
        <div class="invoice-price">
                <div class="invoice-price-left">
                    <div class="invoice-price-row">
                        <div class="sub-price">
                            <small>NGÀY ĐẾN</small>
                            <span class="text-inverse"><?php echo $item['start_time'] ?></span>
                        </div>
                        <div class="sub-price">
                            <i class="fas fa-arrows-alt-h"></i>
                        </div>
                        <div class="sub-price">
                            <small>NGÀY ĐI</small>
                            <span class="text-inverse"><?php echo $item['end_time'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="invoice-price-right">
                    <small>TOTAL</small> 
                    <span class="f-w-600">$<?php echo $item['total_money'] ?></span>
                </div>
            </div>
        </div>
            <?php 
                }
            ?>
        <?php 
            }
        ?>
    <div class="invoice-footer">
        <footer>
            <div class="footer">
                <p class="text">
                    All material herein © 2005–2022 Agoda Company Pte. Ltd. All Rights Reserved. <br> <br>
                    Agoda is part of Booking Holdings Inc., the world leader in online travel & related
                    services.
                </p>
                <p class="icon-footer">
                    <img src="./img/ft1.png" alt="">
                    <img src="./img/ft2.png" alt="">
                    <img src="./img/ft3.png" alt="">
                    <img src="./img/ft4.png" alt="">
                    <img src="./img/ft5.png" alt="">
                    <img src="./img/ft6.png" alt="">
                </p>
            </div>
        </footer>
    </div>
    <?php 
        } else {
    ?>
    <h2>Bạn chưa đăng nhập</h2>
    <?php
        }
    ?>
</div>
