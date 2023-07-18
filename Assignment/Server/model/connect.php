<?php
    $hostName = 'localhost';
    $db_name = 'du_an_1';
    $username = 'root';
    $password = '';

    try {
        $connect = new PDO ("mysql:host=$hostName;dbname=$db_name", $username, $password);
        $connect ->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "Da ket noi1";
    } catch (PDOException $th) {
        echo $th -> getMessage();
    }
   
?>