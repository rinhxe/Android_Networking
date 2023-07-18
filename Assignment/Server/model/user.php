<?php

require('connect.php');

class user
{
    public function add($data)
    {
        $phone = $data['phone_number_user'];
        $name = $data['name_user'];
        $pass = $data['password_user'];
        $email = $data['mail_user'];

        $sql = "INSERT INTO `user` (`user_id`, `name_user`, `phone_number_user`, `password_user`, `status`, `id_role`, `mail_user`) 
        VALUES (NULL, '{$name}', '{$phone}', '{$pass}', '1', '2', '{$email}')";

        //Call global variable
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }

    public function addAdmin($data)
    {
        $phone = $data['phone_number_user'];
        $name = $data['name_user'];
        $pass = $data['password_user'];
        $email = $data['mail_user'];

        $sql = "INSERT INTO `user` (`user_id`, `name_user`, `phone_number_user`, `password_user`, `status`, `id_role`, `mail_user`) 
        VALUES (NULL, '{$name}', '{$phone}', '{$pass}', '1', '1', '{$email}')";

        //Call global variable
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }

    public function update($data, $idUser)
    {

        $phone = $data['phone_number_user'];
        $name = $data['name_user'];
        $pass = md5($data['password_user']);
        $email = $data['mail_user'];

        $sql = "UPDATE `user` SET `name_user` = '{$name}', `phone_number_user` = '{$phone}', `password_user` = '{$pass}', `mail_user` = '{$email}' 
        WHERE `user`.`user_id` = '{$idUser}'";

        //Call global variable
        $result = $GLOBALS['connect']->query($sql);

        return $result;
    }
}
