<?php

require('connect.php');

class orderDetailed
{
    public  function add($room_id, $roombooked_id, $amount , $status)
    {
        $sql = "INSERT INTO `order_detailed`(`room_id` , `rombooked_id` , `amount` , `order_status`) VALUES ('$room_id' , '$roombooked_id' , '$amount' , '$status')";
        $GLOBALS['connect']->query($sql);
    }

    public function updateStatusRoombook($roombooked_id){
        $sql = "UPDATE `roombooked` SET `status` = 'Đã Duyệt' WHERE rombooked_id = '$roombooked_id'";
        $GLOBALS['connect']->query($sql);
    }

    public function updateAmountRoombook($roombooked_id , $amount , $amount_max){
        $quantity = $amount - $amount_max;
        $sql = "UPDATE `roombooked` SET `amount` = '$quantity' WHERE rombooked_id = '$roombooked_id'";
        $GLOBALS['connect']->query($sql);
    }

    public function updateStatusRoom($room_id, $status){
        $sql = "UPDATE `room` SET `status`='$status' WHERE room_id = '$room_id'";
        $GLOBALS['connect']->query($sql);
    }

    public function getDataOrderDetailed($user)
    {
        $sql = "SELECT r.name_room , r.room_id , od.id_order_detailed , od.order_status , kr.kind_of_room , od.amount , us.name_user,
        us.phone_number_user , rb.start_time , rb.end_time , rb.total_money , rb.status  FROM (((order_detailed od left JOIN
        roombooked rb ON od.rombooked_id = rb.rombooked_id) left JOIN user us ON us.user_id = rb.user_id) left JOIN
        kindroom kr ON kr.kind_of_room_id = rb.kind_of_room_id) left JOIN room r ON r.room_id = od.room_id where us.name_user = '$user' ORDER BY od.id_order_detailed DESC";
        $result = $GLOBALS['connect']->query($sql);
        $list = $result->fetchAll();
        return $list;
    }

    public function showorderDetailed()
    {
        $sql = "SELECT DISTINCT roombooked.user_id, user.phone_number_user , user.name_user FROM user INNER JOIN roombooked ON user.user_id = roombooked.user_id";
        $result = $GLOBALS['connect']->query($sql);
        $list = $result->fetchAll();
        return $list;
    }

    public function updateStatusOrderDetailed($order_id)
    {
        $sql = "UPDATE `order_detailed` SET `order_status` = 'Đã Trả Phòng' WHERE id_order_detailed  = '$order_id'";
        $GLOBALS['connect']->query($sql);
    }

    public function searchOrderDetailed($data_search){
        $sql = "SELECT DISTINCT roombooked.user_id, roombooked.rombooked_id , user.phone_number_user , user.name_user FROM user 
        INNER JOIN roombooked ON user.user_id = roombooked.user_id where user.phone_number_user like '$data_search'";
        $result = $GLOBALS['connect']->query($sql);
        $list = $result->fetchAll();
        return $list;
    }

}