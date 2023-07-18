<?php
    require('./model/connect.php');
    $sql = "SELECT * FROM `kindroom`";
    $show = $connect->query($sql);
    $show->execute();
    $list = $show->fetchAll();
?>
<main>
    <div class="banner_search">
        <form action="" method="POST">
            <input class="search" type="text" name="noidung" placeholder="Seach Enter...">
            <button class="submit" name="submit">Submit</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $timkiem = $_POST['noidung'];
            if ($timkiem == '') {
                echo " Vui lòng nhập vào thanh tìm kiếm!";
            } else {
                $sqlroom = "SELECT * FROM kindroom WHERE kind_of_room LIKE '%$timkiem%'  ";
                $roomtk = $connect->query($sqlroom);
                $count = $roomtk->fetchAll();
                if ($count <= 1) {
                    echo "Không tìm thấy kết quả với từ khóa:" . $timkiem . "<br>";
                } else {
                    echo "Tìm thấy kết quả với từ khóa: " . $timkiem . "<br>"
        ?>
        <main>
            <div class="room">
                <div class="content">
                    <?php
                    foreach ($count as $item) {
                    ?>
                        <div class="content_item">
                            <form action="" method="POST">
                                <a href="./chitiet.php?kind_of_room_id=<?php echo $item['kind_of_room_id'] ?>">
                                    <div class="content_item_img">
                                        <img src="./controller/kindRoom/<?php echo $item['image'] ?>" width="100%" height="260px">
                                    </div>
                                    <p class="loaiphong"><?php echo $item['kind_of_room'] ?></p>
                                    <span class="price"><?php echo $item['price'] ?> VNĐ</span>
                                    <button class="book_room">ĐẶT PHÒNG</button>
                                </a>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </main>
        <?php
                }
            }
        }
        ?>
    </div>
    <div class="room">
        <h2>Kind Of Room</h2>
            <div class="content">
                <?php
                foreach ($list as $item) {
                ?>
                    <div class="content_item">
                        <a href="./chitiet.php?kind_of_room_id=<?php echo $item['kind_of_room_id'] ?>">
                            <div class="content_item_img">
                                <img src="./controller/kindRoom/<?php echo $item['image'] ?>" width="100%" height="260px">
                            </div>
                            <strong><?php echo $item['kind_of_room'] ?></strong> <br>
                            <span class="price"><?php echo $item['price'] ?> VNĐ</span> <br>
                            <button class="book_room">ĐẶT PHÒNG</button>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
    </div>
</main>