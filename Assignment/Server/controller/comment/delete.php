<?php
    require('../../model/comment.php');

    $id = (int)$_GET['id'];

    $maCmt = [
        'comment_id' => $id,
    ];

    $binhLuan = new Comment();
    $binhLuan->delete($maCmt);

    if($connect) {
        header('location:cmt.php');
    }
?>