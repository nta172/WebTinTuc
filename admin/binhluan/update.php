<?php

require_once '../../DB/dbConnect.php';

if (isset($_POST['id_binhluan'])) {

    $id = $_POST['id_binhluan'];

    $trangthai = 1;

    $qr = mysqli_query($conn, "UPDATE `binh_luan`
                            SET `trangthai` = '$trangthai'
                            WHERE `id_binhluan` = $id");
    if ($qr) {
        echo 'Bình luận đã được phê duyệt!';
    } else {
        echo 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
    }
}
?>
