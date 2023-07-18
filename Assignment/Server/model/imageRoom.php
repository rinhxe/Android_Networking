<?php

require('connect.php');

class imageRoom
{
    public function add($imageRoomData)
    {
        $imgs = $imageRoomData['image_room'];
        $idRoom = $imageRoomData['kind_of_room_id'];

        $sql = "INSERT INTO `roomimage`(`room_image_id`, `kind_of_room_id`, `image_room`)
        VALUES (NULL,'{$idRoom}','{$imgs}')";

        //Call global variable
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }

    public function update($kindOfRoomId, $imageRoomData) 
    {
        // $id = $Id['room_image_id'];
        // $imgs = $imageRoomData['image_room'];
        
        // $sql = "UPDATE `roomimage` SET  `image_room` = '{$imgs}' 
        // WHERE `roomimage`.`kind_of_room_id` = {$id}";

        // $result = $GLOBALS['connect']->query($sql);
        // return $result;

        $this->deleteByKindOfRoomId($kindOfRoomId);
        foreach ($imageRoomData as $item) {
            $this->add($item);
        }
    }

    public function delete($id_ImageRoom)
    {
        $id = $id_ImageRoom['room_image_id'];
        $sql = "DELETE FROM `roomimage` WHERE 
        `roomimage`.`room_image_id` = {$id}";
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }

    public function deleteByKindOfRoomId($kindOfRoomId) {
        $sql = "DELETE FROM `roomimage` WHERE 
        `roomimage`.`kind_of_room_id` = {$kindOfRoomId}";
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }
}