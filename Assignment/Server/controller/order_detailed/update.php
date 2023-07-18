<?php
require '../../model/OrderDetailed.php';
$order = new orderDetailed();
if (isset($_GET['room_id']) && isset($_GET['user'])){
    $user = $_GET['user'];
    $room_id = $_GET['room_id'];
    $order_id = $_GET['order_id'];
    $order->updateStatusRoom($room_id, 'Có thể sử dụng');
    $order->updateStatusOrderDetailed($order_id);
    header("location: order_detailed_user.php?user=$user");
}
