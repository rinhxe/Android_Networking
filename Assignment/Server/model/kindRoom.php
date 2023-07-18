<?php

require('connect.php');

class KindRoom
{
    public function add($data)
    {
        $title = $data['kind_of_room'];
        $price = $data['price'];
        $describe = $data['describe'];
        $image = $data['image'];

        $sql = "INSERT INTO `kindroom` (`kind_of_room_id`, `kind_of_room`, `price`, `describe`, `image`, `quantity_max`) 
        VALUES (NULL, '{$title}', '{$price}', '{$describe}', '{$image}', '2')";

        $conn = $GLOBALS['connect'];
        $conn->exec($sql);

        return $conn->lastInsertId();
    }
    public function update($id_kindRoom, $kind_of_room)
    {
        $id = $id_kindRoom['kind_of_room_id'];

        $title = $kind_of_room['kind_of_room'];
        $price = $kind_of_room['price'];
        $describe = $kind_of_room['describe'];
        $image = $kind_of_room['image'];

        $sql = "UPDATE `kindroom` SET `kind_of_room` = '{$title}', `price` = '{$price}', `describe` = '{$describe}', `image` = '{$image}' 
        WHERE `kindroom`.`kind_of_room_id` = {$id}";
        
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }
    public function delete($id_kindRoom)
    {
        $id = $id_kindRoom['kind_of_room_id'];
        $sql = "DELETE FROM `kindroom` 
        WHERE `kindroom`.`kind_of_room_id` = {$id}";
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }

    public function show_kindRoom()
    {
        $sql = "SELECT * FROM `kindroom`";
        $result = $GLOBALS['connect']->query($sql);
        $list = $result->fetchAll();
        return $list;
    }
}