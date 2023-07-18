<?php
    session_start();
    if(isset($_SESSION['name_user'])) {
        unset($_SESSION['name_user']);
    }
    unset($_SESSION['user_id']);
    header('location:../index.php');
?>