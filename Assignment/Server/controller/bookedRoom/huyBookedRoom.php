<?php
require('../../model/connect.php');
 if (isset($_GET['id'])){
     $rombooked_id = $_GET['id'];
     $sql = "UPDATE `roombooked` SET `status` = 'Đã hết phòng' WHERE rombooked_id = '$rombooked_id'";
     $result = $GLOBALS['connect']->query($sql);
 }
 ?>
<script>
    alert('Hủy thành công')
    window.location = "../bookedRoom/bookedroom.php";
</script>
