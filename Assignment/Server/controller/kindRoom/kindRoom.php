<?php
    require('../../model/connect.php');
    $sql = "SELECT count(*) FROM `kindroom`";
    $show = $connect->query($sql);
    $show->execute();
    // so ban ghi trong database
    $totalPage = $show->fetchColumn();

    $limit = 6;
    $page = ceil($totalPage / $limit);

    if(isset($_GET['page'])) {
        $paging = $_GET['page'];  
    } else {
        $paging = 1;
    }

    // lay ban ghi tiep theo
    $offset = $limit * ($paging - 1);

    $sql_limit = "SELECT * FROM `kindroom` limit $limit offset $offset";
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
    <title>Quan Tri Kind Of Room</title>
    <script src="https://kit.fontawesome.com/290fc3f375.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../quanTri.css">
    <link rel="stylesheet" href="./kindRoom.css">
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
            <div class="header-1">
                <h1><i class="fa-solid fa-spider"></i> Kind Of Room <i class="fa-solid fa-spider"></i></h1>
            </div>
            <hr>
            <div class="hangHoa">
                <button class="nut-add">
                    <a href="add.php">ADD</a>
                </button>
                <table>
                    <thead>
                        <tr>
                        <th>Kind Of Room ID</th>
                            <th>Kind Of Room</th>
                            <th>Price</th>
                            <th>Describe</th>
                            <th>Image</th>
                            <th>Delete and Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list_limit as $item) {
                        ?>
                            <tr>
                                <td><?php echo $item['kind_of_room_id'] ?></td>
                                <td><?php echo $item['kind_of_room'] ?></td>
                                <td><?php echo $item['price'] ?></td>
                                <td><?php echo $item['describe'] ?></td>
                                <td><img src="<?php echo $item['image'] ?>" width="100px" height="100px"></td>
                                <td>
                                    <a onclick="return confirm('Do you want delete?')" href="delete.php?id=<?php echo $item['kind_of_room_id'] ?>"><button class="delete">Delete</button></a>
                                    <a href="update.php?id=<?php echo $item['kind_of_room_id'] ?>"><button class="update">Update</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="page">
                    <?php
                        for($i = 1; $i <= $page; $i++) {
                    ?>
                        <ul><a href="kindRoom.php?page=<?php echo $i;?>"><?php echo $i; ?></a></ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>