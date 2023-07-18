<?php
class Image {
    public function upload($tmpName, $name) {
        $upaloadDir= 'uploads/';
        $uploadPath= $upaloadDir . $name;
        move_uploaded_file($tmpName, $uploadPath);

        return $uploadPath;
    }
}