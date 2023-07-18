<?php
    require('../../model/imageRoom.php');

    $id = (int)$_GET['id'];

    $id_ImageRoom = [
        'room_image_id' => $id,
    ];

    $roomImage = new imageRoom();
    $roomImage->delete($id_ImageRoom);
    if($connect) {
        header('location:image.php');
    }
?>