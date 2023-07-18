<?php
    require('../../model/comment.php');

    $idCmt = $_GET['comment_id'];

    $binhLuan = new Comment();
    $binhLuan->update($idCmt);

    if($connect) {
        header('location:cmt.php');
    }
?>