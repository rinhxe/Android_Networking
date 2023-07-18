<?php

require('connect.php');

class Comment
{
    public function delete($maCmt)
    {
        $id = $maCmt['comment_id'];
        $sql = "DELETE FROM `comment` WHERE `comment`.`comment_id` = {$id}";
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }

    public function update($idCmt)
    {
        $sql = "UPDATE `comment` SET `status` = 'Đã Duyệt' WHERE `comment`.`comment_id` = {$idCmt}";
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }
}