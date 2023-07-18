<?php
require '../../model/OrderDetailed.php';
if (isset($_POST['room_order']) && isset($_GET['rombooked_id'])){
    $room_id = $_POST['room_order'];
    $roombooked_id = $_GET['rombooked_id'];
    $amount = $_GET['amount'];
    $amount_max = $_GET['amount_max'];
    $order = new orderDetailed();
    if ($amount > $amount_max ){
        $order->add($room_id,$roombooked_id,$amount_max,'Đang Sử Dụng');
        $order->updateAmountRoombook($roombooked_id, $amount , $amount_max);
    } else{
        $sql = "select `amount` from `roombooked` where `rombooked_id` = '$roombooked_id'";
        $result = $GLOBALS['connect']->query($sql);
        $amount = $result->fetch();
        $order->updateStatusRoombook($roombooked_id);
        $order->add($room_id,$roombooked_id,$amount['amount'],'Đang Sử Dụng');
    }

    $order->updateStatusRoom($room_id,'Bảo trì');
}
?>
<script>
alert('thêm thành công')
window.location = "../bookedRoom/bookedroom.php";
</script>