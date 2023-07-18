<?php
    require('../../model/room.php');

    $id = (int)$_GET['id'];

    $roomId = [
        'room_id' => $id,
    ];

    $room = new Room();
    $room->update_status($roomId);
    if($connect) {
        header('location:room.php');
    }
?>