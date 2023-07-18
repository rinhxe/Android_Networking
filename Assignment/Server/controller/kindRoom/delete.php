<?php
    require('../../model/kindRoom.php');

    $id = (int)$_GET['id'];

    $id_kindRoom = [
        'kind_of_room_id' => $id,
    ];

    $kindRoom = new KindRoom();
    $kindRoom->delete($id_kindRoom);

    if($connect) {
        header('location:kindRoom.php');
    }
?>